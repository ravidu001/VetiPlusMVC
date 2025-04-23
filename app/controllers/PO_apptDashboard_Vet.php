<?php

class PO_apptDashboard_Vet extends Controller {

    public $petOwnerID;

    public $petAppts;

    public $availableSessions;
    public $activeDocList;

    public function __construct() {
        !isset($_SESSION['petOwnerID']) && redirect('Login');
        $this->petOwnerID = $_SESSION['petOwnerID'];

        $this->petAppts = new PO_PetAppts;

        $this->availableSessions = new PO_AvailableSessions;
        $this->activeDocList = $this->availableSessions->getActiveList_vet();
    }

    public function index() {
        $this->view('petowner/apptDashboard_Vet');
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

    public function rescheduleAppt () {}
    public function cancelAppt () {}

    public function postFeedback () {
        $inputDetails = $_POST;
        $params = [
            'rating' => $inputDetails['rating'],
            'comment' => $inputDetails['comment'],
            'appointmentID' => $inputDetails['apptID'],
            'petOwnerID' => $inputDetails['petOwnerID'],
            'doctorID' => $inputDetails['providerID']
        ];
        $feedbackObj = new PO_Feedback;
        $postSuccess = $feedbackObj->postFeedback('vet', $params);

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
        if (!isset($_GET['sessionID']) || !isset($_GET['doctorID']))
            redirect('PO_apptDashBoard_Vet');

        $_SESSION['sessionID'] = $_GET['sessionID'];
        $_SESSION['doctorID'] = $_GET['doctorID'];
        redirect('PO_bookAppt_Vet');
    }
}
