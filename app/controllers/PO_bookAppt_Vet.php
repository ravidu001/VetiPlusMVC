<?php

class PO_bookAppt_Vet extends Controller {
    // since custom queries need to be executed using query():
    use Database;

    public $petOwnerID;

    public $petAppts;

    public $availableSessions;
    public $activeDocList;

    public $sessionID;
    public $doctorID;

    public function __construct() {
        !isset($_SESSION['petOwnerID']) && redirect('Login');
        $this->petOwnerID = $_SESSION['petOwnerID'];

        (!isset($_GET['sessionID']) || !isset($_GET['doctorID'])) && redirect('PO_apptDashboard_vet');
        $this->sessionID = $_GET['sessionID'];
        $this->doctorID = $_GET['doctorID'];

        $this->availableSessions = new PO_AvailableSessions;
        $this->activeDocList = $this->availableSessions->getActiveList_vet();
    }

    public function index() {
        $this->view('petowner/bookAppt_vet');
    }

    public function getAppts_upcoming () {
        $options = [
            'petID' => null,
            'petOwnerID' => $this->petOwnerID,
            'type' => 'vet'
        ];
        $result = $this->petAppts->getPetApptUpcoming($options) ?: ["fetchedCount" => 0];
        
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }

    public function getAppts_history () {
        $options = [
            'petID' => null,
            'petOwnerID' => $this->petOwnerID,
            'type' => 'vet'
        ];
        $result = $this->petAppts->getPetApptHistory($options) ?: ["fetchedCount" => 0];

        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
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
