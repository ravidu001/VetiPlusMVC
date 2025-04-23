<?php

class PO_bookAppt_Salon extends Controller {
    // public $petOwner;
    public $petOwnerID;

    public $petAppts;

    public $availableSessions;
    public $activeDocList;

    public function __construct() {
        !isset($_SESSION['petOwnerID']) && redirect('Login');
        $this->petOwnerID = $_SESSION['petOwnerID'];

        

        $this->availableSessions = new PO_AvailableSessions;
        $this->activeDocList = $this->availableSessions->getActiveList_vet();
    }

    public function index() {
        $this->view('petowner/bookAppt_salon');
    }

    public function getAvailableSessions () {
        $params = [
            'docName' => $_GET['docName'] ?? '',
            'district' => $_GET['district'] ?? '',
            'selectedDate' => $_GET['selectedDate'] ?? '',
            'startTime' => $_GET['startTime'] ?? ''
        ];

        $result = $this->availableSessions->getSessions_vet($params) ?: ["fetchedCount" => 0];

        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }
    public function checkBookedApptSlots_vet () {
        $sessionID = $_GET['sessionID'];

        $result = $this->availableSessions->checkBookedApptSlots_vet($sessionID) ?: ["fetchedCount" => 0];
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }
}
