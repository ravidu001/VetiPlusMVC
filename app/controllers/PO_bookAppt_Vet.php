<?php

class PO_bookAppt_Vet extends Controller {

    public $petObj;
    public $petList;

    public $petOwnerID;

    public $petAppts;

    public $vetSessionsObj;
    public $activeDocList;

    public $doctorID;
    public $sessionID;

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
        $this->petList = $this->petObj->getAllPetsUnderUser();

        $this->petAppts = new PO_PetAppts;

        $this->vetSessionsObj = new PO_VetSession;
        $this->activeDocList = $this->vetSessionsObj->getActiveList_vet();

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

    public function bookAppt () {
        $data = $_POST;             // im not checking each since its only data from select boxes
        $data['petOwnerID'] = $this->petOwnerID;

        $bookingSuccess = $this->petAppts->makeBooking('vet', $data);

        header('Content-Type: application/json');
        if ($bookingSuccess) {
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
}
