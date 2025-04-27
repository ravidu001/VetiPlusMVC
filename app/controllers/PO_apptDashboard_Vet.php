<?php

function sanitizeInput($input) {
    return htmlspecialchars(trim($input));
}

class PO_apptDashboard_Vet extends Controller {

    public $petOwnerID;

    public $petApptsObj;

    public $vetSessionsObj;
    public $activeDocList;

    public $rescheduleCount;

    public function __construct() {
        !isset($_SESSION['petOwnerID']) && redirect('Login');
        $this->petOwnerID = $_SESSION['petOwnerID'];

        $this->petApptsObj = new PO_PetAppts;

        $this->vetSessionsObj = new PO_VetSession;
        $this->activeDocList = $this->vetSessionsObj->getActiveList_vet();

        $po = new PetOwner;
        $this->rescheduleCount = $po->getReschedulesAvailableCount($this->petOwnerID);
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
        $result = $this->petApptsObj->getPetApptUpcoming($options) ?: ["fetchedCount" => 0];
        
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
        $result = $this->petApptsObj->getPetApptHistory($options) ?: ["fetchedCount" => 0];

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

        $result = $this->vetSessionsObj->getSessions_vet($params) ?: ["fetchedCount" => 0];

        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }

    public function getDoctorDates () {
        $doctorID = $_GET['doctorID'];

        $result = $this->vetSessionsObj->getSessionDatesByDoctor($doctorID) ?: ["fetchedCount" => 0];
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }

    public function rescheduleAppt () {
        $sanitized = array_map('sanitizeInput', $_POST);

        $rescheduleState = $this->petApptsObj->rescheduleAppt($sanitized);
        $status = ($rescheduleState['status'] == 'success');
        if ($status) {
            echo json_encode(["status" => "success",
                            "popUpTitle" => "Success! 😺",
                            "popUpMsg" => "Rescheduling successful!",
                            "popUpIcon" => ROOT."/assets/images/petOwner/popUpIcons/success.png",
                            "nextPage" => "PO_apptDashboard_Vet"
                        ]);
            exit();
        } else {
            echo json_encode(["status" => "failure",
                            "popUpTitle" => "Failure! 🙀",
                            "popUpMsg" => $rescheduleState['msg'].", Please try again later.",
                            "popUpIcon" => ROOT."/assets/images/petOwner/popUpIcons/fail.png"
                        ]);
            exit();
        }
        
    }
    public function cancelAppt () {
        $cancellingApptID = $_POST['someID'];
        $cancelSuccess = $this->petApptsObj->cancelAppt('vet', $cancellingApptID);

        if ($cancelSuccess == true) {
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
                            "popUpMsg" => "Something went wrong. Please try again later. :(",
                            "popUpIcon" => ROOT."/assets/images/petOwner/popUpIcons/fail.png"
                        ]);
            exit();
        }

    }

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
