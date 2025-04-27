<?php

class PO_apptDashboard_Salon extends Controller {

    public $petOwnerID;

    public $petApptsObj;

    public $salonsObj;
    public $activeSalonList;
    
    public $rescheduleCount;

    public function __construct() {
        !isset($_SESSION['petOwnerID']) && redirect('Login');
        $this->petOwnerID = $_SESSION['petOwnerID'];

        $this->petApptsObj = new PO_PetAppts;

        $this->salonsObj = new Salons;
        $this->activeSalonList = $this->salonsObj->getActiveList_salon();
        
        $po = new PetOwner;
        $this->rescheduleCount = $po->getReschedulesAvailableCount($this->petOwnerID);
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
        $result = $this->petApptsObj->getPetApptUpcoming($options) ?: ['fetchedCount' => 0];

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
        $result = $this->petApptsObj->getPetApptHistory($options) ?: ['fetchedCount' => 0];
        
        header('Content-Type: application/json');
        echo json_encode($result);
        exit();
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

    public function postFeedback () {
        $inputDetails = $_POST;
        $params = [
            'rating' => $inputDetails['rating'],
            'comment' => $inputDetails['comment'],
            'groomingID ' => $inputDetails['apptID'],
            'petOwnerID' => $inputDetails['petOwnerID'],
            'salonID ' => $inputDetails['providerID']
        ];
        $feedbackObj = new PO_Feedback;
        $postSuccess = $feedbackObj->postFeedback('salon', $params);

        header('Content-Type: application/json');
        if ($postSuccess) {
            echo json_encode(["status" => "success",
                            "popUpTitle" => "Success! 😺",
                            "popUpMsg" => "Thank you for your valuable feedback!",
                            "popUpIcon" => ROOT."/assets/images/petOwner/popUpIcons/success.png",
                            "nextPage" => "PO_apptDashboard_Vet"
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

    public function redirectToBookAppt () {
        if (!isset($_GET['salonID']))  redirect('PO_apptDashBoard_Salon');

        $_SESSION['salonID'] = $_GET['salonID'];
        redirect('PO_bookAppt_Salon');
    }

    public function cancelAppt () {
        $cancellingApptID = $_POST['someID'];
        $cancelSuccess = $this->petApptsObj->cancelAppt('salon', $cancellingApptID);

        if ($cancelSuccess) {
            echo json_encode(["status" => "success",
                            "popUpTitle" => "Success! 😺",
                            "popUpMsg" => "Appointment cancelled successfully!",
                            "popUpIcon" => ROOT."/assets/images/petOwner/popUpIcons/success.png",
                            "nextPage" => "PO_apptDashboard_Vet"
                        ]);
            exit();
        } else {
            echo json_encode(["status" => "failure",
                            "popUpTitle" => "Failure! 🙀",
                            "popUpMsg" => "Something went wrong. Please try again later.",
                            "popUpIcon" => ROOT."/assets/images/petOwner/popUpIcons/fail.png"
                        ]);
            exit();
        }

    }
}
