<?php

function sanitizeInput($input) {
    return htmlspecialchars(trim($input));
}

class PO_contactUs extends Controller {
    public function index() {
        $this->view('petowner/contactUs');
    }

    public function postSystemFeedback () {
        $sfm = new systemfeedbackModel;

    }
    public function postSystemComplaint () {
        $scm = new systemcomplainModel;
    }

    public function contactUs () {
        $sanitized = array_map('sanitizeInput', $_POST);

        $type = $sanitized['type'];
        unset($sanitized['type']);

        if ($type == 'feedback')
            $success = $this->postSystemFeedback($sanitized);
        else if ($type == 'complaint')
            $success = $this->postSystemComplaint($sanitized);

        if ($success) {
            echo json_encode([
                "status" => "success",
                "popUpTitle" => "Success! 😺",
                "popUpMsg" => "Thank you for contacting us!",
                "popUpIcon" => ROOT."/assets/images/petOwner/popUpIcons/success.png",
                "nextPage" => "PO_contactUs"
            ]);
            exit();
        } else {
            echo json_encode([
                "status" => "failure",
                "popUpTitle" => "Failure! 🙀",
                "popUpMsg" => "Something went wrong. 🙀\nPlease try again later.",
                "popUpIcon" => ROOT."/assets/images/petOwner/popUpIcons/fail.png"
            ]);
            exit();
        }
    }
}
