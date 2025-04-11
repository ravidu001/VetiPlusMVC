<?php

class PO_apptDashboard_Salon extends Controller {
    // since custom queries need to be executed using query():
    use Database;

    public $petOwner;
    public function __construct() {
        !isset($_SESSION['petOwnerID']) && redirect('Login');

        $this->petOwner = new PetOwner;
        $this->petOwner->setPetOwnerID();
    }

    public function index() {
        $this->view('petowner/apptDashboard_Salon');
    }

    /**
    * Function to populate Upcoming Appointments for this user's pets 
    */
    public function getUpcomingAppointments () {
        // $myQuery = "SELECT * FROM user";   
        // $result = $this->query($myQuery);

        $result = [
            [
                'petName' => 'Bingo',
                'apptDescription' => 'hello there',
                'salonName' => 'Clean Pets Salon',
                'salonAddress' => '103/1A, Hena Mawaththe, Mount-Lavinia, Colombo',
                'apptDate' => '10/10/2025'
            ],
            [
                'petName' => 'Bingo',
                'apptDescription' => 'hello there',
                'salonName' => 'Clean Pets Salon',
                'salonAddress' => '103/1A, Hena Mawaththe',
                'apptDate' => '10/10/2025'
            ],
            [
                'petName' => 'Bingo',
                'apptDescription' => 'hello there',
                'salonName' => 'Clean Pets Salon',
                'salonAddress' => 'Mount-Lavinia, Colombo',
                'apptDate' => '10/10/2025'
            ],
            [
                'petName' => 'Bingo',
                'apptDescription' => 'hello there',
                'salonName' => 'Clean Pets Salon',
                'salonAddress' => '103/1A, Hena Mawaththe, Colombo',
                'apptDate' => '10/10/2025'
            ]
        ];
        
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }
}
