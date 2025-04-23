<?php

class PO_apptDashboard_Salon extends Controller {

    public $petOwnerID;

    public $petAppts;

    public $availableSessions;
    public $activeSalonList;

    public function __construct() {
        !isset($_SESSION['petOwnerID']) && redirect('Login');
        $this->petOwnerID = $_SESSION['petOwnerID'];

        $this->petAppts = new PO_PetAppts;

        $this->availableSessions = new PO_AvailableSessions;
        $this->activeSalonList = $this->availableSessions->getActiveList_salon();
    }

    public function index() {
        $this->view('petowner/apptDashboard_Salon');
    }

    public function getAppts_upcoming () {
        $options = [
            'petOwnerID' => $this->petOwnerID,
            'petID' => null,
            'type' => 'salon'
        ];
            $result = $this->petAppts->getPetApptUpcoming($options) ?: ['fetchedCount' => 0];

        header('Content-Type: application/json');
        echo json_encode($result);
        exit();
    }

    public function getAppts_history () {
        $options = [
            'petOwnerID' => $this->petOwnerID,
            'petID' => null,
            'type' => 'salon'
        ];
        $result = $this->petAppts->getPetApptHistory($options) ?: ['fetchedCount' => 0];
        
        header('Content-Type: application/json');
        echo json_encode($result);
        exit();
    }

    public function getSalons() {
        $params = [
            'salonName' => $_GET['salonName'] ?? '',
            'openHour' => $_GET['openHour'] ?? date('H:i')
        ];
        $result = $this->availableSessions->getSalons($params) ?: ['fetchedCount' => 0];
        
        header('Content-Type: application/json');
        echo json_encode($result);
        exit();
    }


    public function redirectToBookAppt () {
        if (!isset($_GET['salonID']))  redirect('PO_apptDashBoard_Salon');

        $_SESSION['salonID'] = $_GET['salonID'];
        redirect('PO_bookAppt_Salon');
    }
}
