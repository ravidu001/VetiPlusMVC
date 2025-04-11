<?php

class PO_apptDashboard_Vet extends Controller {
    // since custom queries need to be executed using query():
    use Database;

    public $petOwner;
    public function __construct() {
        !isset($_SESSION['petOwnerID']) && redirect('Login');

        $this->petOwner = new PetOwner;
        $this->petOwner->setPetOwnerID();
    }

    public function index() {
        $this->view('petowner/apptDashboard_Vet');
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
                'docName' => 'Dr Manikam',
                'docAddress' => '103/1A, Hena Mawaththe, Mount-Lavinia, Colombo',
                'apptDate' => '10/10/2025'
            ],
            [
                'petName' => 'Bingo',
                'apptDescription' => 'hello there',
                'docName' => 'Dr Manikam',
                'docAddress' => '103/1A, Hena Mawaththe',
                'apptDate' => '10/10/2025'
            ],
            [
                'petName' => 'Bingo',
                'apptDescription' => 'hello there',
                'docName' => 'Dr Manikam',
                'docAddress' => 'Mount-Lavinia, Colombo',
                'apptDate' => '10/10/2025'
            ],
            [
                'petName' => 'Bingo',
                'apptDescription' => 'hello there',
                'docName' => 'Dr Manikam',
                'docAddress' => '103/1A, Hena Mawaththe, Colombo',
                'apptDate' => '10/10/2025'
            ]
        ];
        
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }
    /**
    * Function to populate Appointment History for this user's pets 
    */
    public function getAppointmentHistory () {
        // $myQuery = "SELECT * FROM user";   
        // $result = $this->query($myQuery);

        $result = [
            [
                'petID' => 1,
                'petName' => 'Bingo',
                'apptDescription' => 'hello there',
                'docName' => 'Dr Manikam',
                'docAddress' => '103/1A, Hena Mawaththe, Mount-Lavinia, Colombo',
                'apptDate' => '10/10/2025',
                'apptRating' => 2
            ],
            [
                'petID' => 1,
                'petName' => 'Bingo',
                'apptDescription' => 'hello there',
                'docName' => 'Dr Manikam',
                'docAddress' => '103/1A, Hena Mawaththe',
                'apptDate' => '10/10/2025',
                'apptRating' => 5
            ],
            [
                'petID' => 1,
                'petName' => 'Bingo',
                'apptDescription' => 'hello there',
                'docName' => 'Dr Manikam',
                'docAddress' => 'Mount-Lavinia, Colombo',
                'apptDate' => '10/10/2025',
                'apptRating' => null
            ],
            [
                'petID' => 1,
                'petName' => 'Bingo',
                'apptDescription' => 'hello there',
                'docName' => 'Dr Manikam',
                'docAddress' => '103/1A, Hena Mawaththe, Colombo',
                'apptDate' => '10/10/2025',
                'apptRating' => 4
            ]
        ];
        
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }
}
