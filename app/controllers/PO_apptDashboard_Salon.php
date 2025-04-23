<?php

class PO_apptDashboard_Salon extends Controller {
    // since custom queries need to be executed using query():
    use Database;

    public $petOwnerID;
    public $petAppts;

    public function __construct() {
        !isset($_SESSION['petOwnerID']) && redirect('Login');
        $this->petOwnerID = $_SESSION['petOwnerID'];

        // $this->petOwner = new PetOwner;
        // $this->petOwner->setPetOwnerID();

        $this->petAppts = new PO_PetAppts;
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

    public function getAppts_history () {
        $options = ['petOwnerID' => $this->petOwnerID,
                    'petID' => null,
                    'type' => 'salon'
                ];
        $result = $this->petAppts->getPetApptHistory($options) ?: ['fetchedCount' => 0];

        header('Content-Type: application/json');
        echo json_encode($result);
        exit();
    }

    public function getAppts_upcoming () {
        $options = ['petOwnerID' => $this->petOwnerID,
                    'petID' => null,
                    'type' => 'salon'
                ];
        $result = $this->petAppts->getPetApptUpcoming($options) ?: ['fetchedCount' => 0];

        header('Content-Type: application/json');
        echo json_encode($result);
        exit();
    }
}
