<?php

function sanitizeInput($input) {
    return htmlspecialchars(trim($input));
}

class PO_bookAppt_Salon extends Controller {
    
    public $petObj;
    public $petList;

    public $petOwnerID;

    public $petApptsObj;

    public $salonsObj;
    public $salonSessionObj;

    public $openDateList;
    public $activeSalonList;

    public $serviceList;
    public $servicesAndOffersList;

    public $salonID;
    public $thisSalonDetails;

    public $paymentInfoObj;

    public function __construct() {
        !isset($_SESSION['petOwnerID']) && redirect('Login');
        $this->petOwnerID = $_SESSION['petOwnerID'];

        if (isset($_SESSION['salonID'])) $this->salonID = $_SESSION['salonID'];
        else redirect('PO_apptDashboard_salon');

        $this->petObj = new Pet;
        $this->petObj->setPetOwnerID();
        $this->petList = $this->petObj->getAllPetsUnderUser() ?? ['petID' => '0', 'name' => 'You have no pets!'];

        $this->petApptsObj = new PO_PetAppts;

        $this->salonsObj = new Salons;
        $this->salonSessionObj = new SalonSession;

        $servicesObj = new SalonServices;
        $this->serviceList = $servicesObj->findAllServiceId($this->salonID);

        $this->openDateList = $this->salonSessionObj->getOpenDays($this->salonID);
        $this->activeSalonList = $this->salonsObj->getActiveList_salon();
        $this->servicesAndOffersList = $this->salonsObj->getServiceOfferAll($this->salonID);
        
        $this->thisSalonDetails = $this->salonsObj->getThisSalonDetails($this->salonID);

        $this->paymentInfoObj = new PaymentInformationModel;
    }

    public function index() {
        $this->view('petowner/bookAppt_salon');
    }

    public function getAvailableSalons () {
        $params = [
            'salonName' => $_GET['salonName'] ?? '',
            'dateSelected' => $_GET['dateSelected'] ?? ''
        ];

        $result = $this->salonsObj->getSalons($params) ?: ["fetchedCount" => 0];

        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }

    public function getSlots_byDate() {
        $date = $_GET['date'];

        $result = $this->salonSessionObj->getSlots_byDate($this->salonID, $date) ?: ["fetchedCount" => 0];
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

    public function acceptPayment () {

        $paymentDone = $this->paymentInfoObj->acceptpayment();
        if ($paymentDone) {
            echo json_encode(["status" => "success",
                            "popUpTitle" => "Success! 😺",
                            "popUpMsg" => "Booking Successful! Check upcoming Appointments for confirmation!",
                            "popUpIcon" => ROOT."/assets/images/petOwner/popUpIcons/success.png",
                            "nextPage" => "PO_apptDashboard_Salon"
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
        // $data['petOwnerID'] = $this->petOwnerID;
        // $data['dateTime'] = date('Y-m-d');

        $submitting['petOwnerID'] = $this->petOwnerID;
        $submitting['dateTime'] = date('Y-m-d H:i');
        $submitting['petOwnerID'] = $this->petOwnerID;
        $submitting['salSessionID'] = $data['salSessionID'];
        $submitting['petID'] = $data['petID'];
        $submitting['service'] = $data['service'];

        $bookingDone = $this->petApptsObj->makeBooking('salon', $submitting);

        header('Content-Type: application/json');
        echo json_encode(['success' => $bookingDone]);
        exit();
    }
}
