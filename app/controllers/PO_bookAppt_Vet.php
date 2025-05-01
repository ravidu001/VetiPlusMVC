<?php

function sanitizeInput($input) {
    return htmlspecialchars(trim($input));
}

class PO_bookAppt_Vet extends Controller {

    public $petObj;
    public $petList;

    public $petOwnerID;

    public $petApptsObj;

    public $vetSessionsObj;
    public $activeDocList;

    public $doctorID;
    public $sessionID;

    public $paymentInfoObj;

    public function __construct() {
        !isset($_SESSION['petOwnerID']) && redirect('Login');
        $this->petOwnerID = $_SESSION['petOwnerID'];
        
        if (isset($_SESSION['sessionID']) || isset($_SESSION['doctorID'])) {
            $this->sessionID = $_SESSION['sessionID'];
            $this->doctorID = $_SESSION['doctorID'];
        } 
        else {
            redirect('PO_apptDashboard_vet');
        }

        $this->petObj = new Pet;
        $this->petObj->setPetOwnerID();
        $this->petList = $this->petObj->getAllPetsUnderUser() ?? ['petID' => '0', 'name' => 'You have no pets!'];

        $this->petApptsObj = new PO_PetAppts;

        $this->vetSessionsObj = new PO_VetSession;
        $this->activeDocList = $this->vetSessionsObj->getActiveList_vet();

        $this->paymentInfoObj = new PaymentInformationModel;
    }

    public function index() {
        $this->view('petowner/bookAppt_vet');
    }

    public function getAvailableSessions () {
        $params = [
            'docName' => $_GET['docName'] ?? '',
            'district' => $_GET['district'] ?? '',
            'selectedDate' => $_GET['selectedDate'] ?? '',
            'startTime' => $_GET['startTime'] ?? ''
        ];

        $result = $this->vetSessionsObj->getSessions_vet($params) ?: ["fetchedCount" => 0];

        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }

    public function getSpecificSession () {
        $result = $this->vetSessionsObj->getSpecificSession_vet($this->doctorID, $this->sessionID);

        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }

    public function getAvailableSessions_specific () {
        $result = $this->vetSessionsObj->getSessions_specificVet($this->doctorID) ?: ["fetchedCount" => 0];

        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }

    public function getBookedSessionSlots () {
        $result = $this->vetSessionsObj->checkBookedApptSlots_vet($this->sessionID) ?: ["fetchedCount" => 0];

        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }

    public function getSavedCard () {
        $result = $this->paymentInfoObj->getPaymentDetails($this->petOwnerID) ?: ["fetchedCount" => 0];

        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }
    
    public function makePayment () {
        $sanitized = array_map('sanitizeInput', $_POST);

        header('Content-Type: application/json');
        if (in_array('', $sanitized, true)) {
            echo json_encode([
                "status" => "inputFail",
                "message" => "Please fill all the required fields!"
            ]);
            exit();
        }
        $paymentDetails = [
            'cardType' => $sanitized['cardType'],
            'cardNumber' => $sanitized['cardNumber'],
            'petOwnerID' => $this->petOwnerID,
            'expiredyear' => substr($sanitized['expiry'], 0, 4),
            'expiredmonth' => substr($sanitized['expiry'], 5, 2),
            'CVV' => $sanitized['CVV']
        ];

        if (isset($_POST['saveCard']) && ($_POST['saveCard'] == 'save')) {
            $cardDetails = $this->paymentInfoObj->saveCardDetails($paymentDetails);

            if (($cardDetails['success'] == false) && (!isset($cardDetails['paymentInfoID']))) {
                echo json_encode([
                    "status" => "failure",
                    "popUpTitle" => "Failure! 🙀",
                    "popUpMsg" => "Something went wrong! Please try again later.",
                    "popUpIcon" => ROOT."/assets/images/petOwner/popUpIcons/fail.png"
                ]);
                exit();
            }
        }

        $apptPayDetails = [
            'amount' => $sanitized['amount'],
            'appointmentID' => $sanitized['appointmentID'],
            'petOwnerID' => $this->petOwnerID,
            'paymentInfoID' => $cardDetails['paymentInfoID'] ?? null,
            'serviceType' => $sanitized['serviceType']
        ];
        $apptPayObj = new AppointmentPayModel;
        $paymentDone = $apptPayObj->saveAppointmentPayment($apptPayDetails);
        if ($paymentDone) {
            echo json_encode(["status" => "success",
                            "popUpTitle" => "Success! 😺",
                            "popUpMsg" => "Booking Successful!<br/> Check upcoming Appointments for confirmation!",
                            "popUpIcon" => ROOT."/assets/images/petOwner/popUpIcons/success.png",
                            "nextPage" => "PO_home"
                        ]);
            exit();
        } else {
            echo json_encode(["status" => "failure",
                            "popUpTitle" => "Failure! 🙀",
                            "popUpMsg" => "Something went wrong! Please try again later.",
                            "popUpIcon" => ROOT."/assets/images/petOwner/popUpIcons/fail.png"
                        ]);
            exit();
        }
    }

    public function acceptPayment () {

        $paymentDone = $this->paymentInfoObj->acceptpayment();
        if ($paymentDone) {
            echo json_encode(["status" => "success",
                            "popUpTitle" => "Success! 😺",
                            "popUpMsg" => "Booking Successful!<br/> Check upcoming Appointments for confirmation!",
                            "popUpIcon" => ROOT."/assets/images/petOwner/popUpIcons/success.png",
                            "nextPage" => "PO_apptDashboard_Vet"
                        ]);
            exit();
        } else {
            echo json_encode(["status" => "failure",
                            "popUpTitle" => "Failure! 🙀",
                            "popUpMsg" => "Something went wrong! Please try again later.",
                            "popUpIcon" => ROOT."/assets/images/petOwner/popUpIcons/fail.png"
                        ]);
            exit();
        }
    }

    public function bookAppt () {
        $data = $_POST;
        $data['petOwnerID'] = $this->petOwnerID;

        $bookingDone = $this->petApptsObj->makeBooking('vet', $data);

        header('Content-Type: application/json');
        echo json_encode(['success' => $bookingDone]);
        exit();
    }
}
