<?php

class PO_bookAppt_Salon extends Controller {
    
    public $petObj;
    public $petList;

    public $petOwnerID;

    public $petApptsObj;

    public $salonsObj;
    public $salonSessionObj;
    public $activeSalonList;

    public $salonID;

    public function __construct() {
        !isset($_SESSION['petOwnerID']) && redirect('Login');
        $this->petOwnerID = $_SESSION['petOwnerID'];

        if (isset($_SESSION['salonID'])) {
            $this->salonID = $_SESSION['salonID'];
        } 
        else {
            redirect('PO_apptDashboard_salon');
        }

        $this->petObj = new Pet;
        $this->petObj->setPetOwnerID();
        $this->petList = $this->petObj->getAllPetsUnderUser();

        $this->petApptsObj = new PO_PetAppts;

        $this->salonsObj = new Salons;
        $this->salonSessionObj = new SalonSession;

        $this->activeSalonList = $this->salonsObj->getActiveList_salon();
    }

    public function index() {
        $this->view('petowner/bookAppt_salon');
    }

    public function getAvailableSalons () {
        $params = [
            'salonName' => $_GET['salonName'] ?? '',
            'openHour' => $_GET['openHour'] ?? ''
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

    public function getSalonServices () {
        $servicesObj = new SalonServices;
        $services = $servicesObj->findAllServiceId($this->salonID);

        header('Content-Type: application/json');
        echo json_encode($services);
        exit;
    }

    public function bookAppt () {
        $data = $_POST; // im not checking each since its only data from select boxes
        $data['petOwnerID'] = $this->petOwnerID;

        $bookingSuccess = $this->petApptsObj->makeBooking('salon', $data);

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
