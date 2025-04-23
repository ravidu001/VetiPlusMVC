<?php

class PO_bookAppt_Vet extends Controller {
    // since custom queries need to be executed using query():
    use Database;

    public $petObj;
    public $petList;

    public $petOwnerID;

    public $petAppts;

    public $availableSessions;
    public $activeDocList;

    public $sessionID;
    public $doctorID;

    // public $thisSession;

    public function __construct() {
        !isset($_SESSION['petOwnerID']) && redirect('Login');
        $this->petOwnerID = $_SESSION['petOwnerID'];
        
        if (isset($_GET['sessionID']) || isset($_GET['doctorID'])) {
            $_SESSION['sessionID'] = $_GET['sessionID'];
            $_SESSION['doctorID'] = $_GET['doctorID'];
            $this->sessionID = $_SESSION['sessionID'];
            $this->doctorID = $_SESSION['doctorID'];
        } 
        else if (isset($_SESSION['sessionID']) || isset($_SESSION['doctorID'])) {
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

        $this->availableSessions = new PO_AvailableSessions;
        $this->activeDocList = $this->availableSessions->getActiveList_vet();

    }

    public function index() {
        $this->view('petowner/bookAppt_vet');
    }

    public function getSpecificSession () {
        $result = $this->availableSessions->getSpecificSession_vet($this->doctorID, $this->sessionID);

        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }

    public function getBookedSessionSlots () {
        $result = $this->availableSessions->checkBookedApptSlots_vet($this->sessionID) ?: ["fetchedCount" => 0];

        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }

    public function bookAppt () {
        $data = $_POST;
        $data['petOwnerID'] = $this->petOwnerID;

        $bookingSuccess = $this->petAppts->makeBooking('vet', )

        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }


}
