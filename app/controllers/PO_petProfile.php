<?php

function sanitizeInput($input) {
    return htmlspecialchars(trim($input));
}

/**
 * This class and thereby its view page will only be accessed through a URL petcard in PO_home (dashboard)
 */
class PO_petProfile extends Controller {

    private $petOwnerID;
    private $petID;

    public $pet;
    public $pet_details;

    public $petAppts;

    public function __construct() {

        !isset($_SESSION['petOwnerID']) && redirect('Login');
        $this->petOwnerID = $_SESSION['petOwnerID'];

        if (isset($_GET['petID'])) {
            $this->petID = $_GET['petID'];
            $_SESSION['petID'] = $this->petID;
        } elseif (isset($_SESSION['petID'])) {
            $this->petID = $_SESSION['petID'];
        } else {
            redirect('PO_home');
        }

        $this->pet = new Pet;
        $this->pet->setPetOwnerID();

        $this->pet_details = $this->pet->getOnePet($this->petID);

        $this->petAppts = new PO_PetAppts;
    }

    public function index() {
        $this->view('petowner/petProfile');
    }

    // the following 3 are used to validate the form inputs and add error messages
    private $errors = [];
    private $validInputs = true;

    private function addError($msg) {
        $this->errors[] = $msg;
        $this->validInputs = false;
    }

    public function editPetDetails () {
        $sanitized = array_map('sanitizeInput', $_POST);

        $name = $sanitized['name']; 
        $DOB = $sanitized['DOB'];

        $this->errors = [];
        $this->validInputs = true;

        if(empty($name)) $this->addError("Empty name value provided!");
        elseif (strlen($name) < 3) $this->addError("Name should be at least 3 characters.");
    
        $today = new DateTime("now");
        $dobDate = DateTime::createFromFormat('Y-m-d', $DOB);
        if ($dobDate && $dobDate > $today) $this->addError("Invalid date of birth.");
        
        header('Content-Type: application/json');

        if($this->validInputs) {
            $updateDone = $this->pet->editProfileDetails($this->petID, $sanitized);
            
            if ($updateDone) {
                echo json_encode(["status" => "success",
                                "popupTitle" => "Success! 😺",
                                "popUpMsg" => "Updated pet's details successfully!",
                                "popUpIcon" => ROOT."/assets/images/petOwner/popUpIcons/success.png",
                                "nextPage" => "PO_petProfile"
                            ]);
                exit();
            } else {
                echo json_encode(["status" => "failure",
                                "popupTitle" => "Failure! 🙀",
                                "popUpMsg" => "Couldn't update pet's details. 🙀\nPlease try again later.",
                                "popUpIcon" => ROOT."/assets/images/petOwner/popUpIcons/fail.png"
                            ]);
                exit();
            }
        }
        else {
            echo json_encode([
                "status" => "inputFail",
                "popUpMsg" => implode(';', $this->errors)
            ]);
            exit();
        }
    }

    public function changePetProfilePicture () {
        $profilePicture = $_FILES['profilePicture'];
        $targetDir = $_SERVER['DOCUMENT_ROOT'].'/VetiPlusMVC/public/assets/images/petOwner/profilePictures/pet/';

        $originalName = $profilePicture['name'];
        $tempPath = $profilePicture['tmp_name'];

        // Get file extension and generate new file name
        $fileExt = pathinfo($originalName, PATHINFO_EXTENSION);
        $newFileName = "pet_" . $this->petID . "." . $fileExt;

        // Move uploaded file to the target directory
        $destination = $targetDir . $newFileName;
        $uploadDone = move_uploaded_file($tempPath, $destination);

        if ($uploadDone) {
            $updateDone = $this->pet->uploadProfilePicture($this->petID, ['profilePicture' => $newFileName]);
            if ($updateDone) {
                echo json_encode(["status" => "success",
                                "popupTitle" => "Success! 😺",
                                "popUpMsg" => "Uploaded pet's profile picture successfully!",
                                "popUpIcon" => ROOT."/assets/images/petOwner/popUpIcons/success.png",
                                "nextPage" => "PO_petProfile"
                            ]);
                exit();
            } else {
                echo json_encode(["status" => "failure",
                                "popupTitle" => "Failure! 🙀",
                                "popUpMsg" => "Couldn't update pet's profile picture. 🙀\nPlease try again later.",
                                "popUpIcon" => ROOT."/assets/images/petOwner/popUpIcons/fail.png"
                            ]);
                exit();
            }
        } else {
            echo json_encode(["status" => "failure",
                            "popupTitle" => "Failure! 🙀",
                            "popUpMsg" => "Couldn't upload pet's profile picture. 🙀\nPlease try again later.",
                            "popUpIcon" => ROOT."/assets/images/petOwner/popUpIcons/fail.png"
                        ]);
            exit();
        }
    }

    public function deletePet () {
        $deleteDone = $this->pet->deletePet($this->petID);
        if ($deleteDone) {
            echo json_encode(["status" => "success",
                            "popupTitle" => "Success! 😿",
                            "popUpMsg" => "Deleted pet's profile successfully! But we're sorry to see your pet go. 😿",
                            "popUpIcon" => ROOT."/assets/images/petOwner/popUpIcons/success.png",
                            "nextPage" => "PO_home"
                        ]);
            exit();
        } else {
            echo json_encode(["status" => "failure",
                            "popupTitle" => "Failure! 🙀",
                            "popUpMsg" => "Couldn't delete pet's profile. 🙀\nPlease try again later.",
                            "popUpIcon" => ROOT."/assets/images/petOwner/popUpIcons/fail.png"
                        ]);
            exit();
        }
    }

    public function getPetApptHistory () {
        $options = ['petOwnerID' => $this->petOwnerID,
                    'petID' => $this->petID,
                    'type' => 'all'
                ];
        $result = $this->petAppts->getPetApptHistory($options) ?: ['fetchedCount' => 0];

        header('Content-Type: application/json');
        echo json_encode($result);
        exit();
    }

    public function getPetApptUpcoming () {
        $options = ['petOwnerID' => $this->petOwnerID,
                    'petID' => $this->petID,
                    'type' => 'all'
                ];
        $result = $this->petAppts->getPetApptUpcoming($options) ?: ['fetchedCount' => 0];

        header('Content-Type: application/json');
        echo json_encode($result);
        exit();
    }

    public function postFeedback () {
        $sanitized = array_map('sanitizeInput', $_POST);

        $comment = $sanitized['comment'];
        $rating = $sanitized['rating'];

        $this->errors = [];
        $this->validInputs = true;

        empty($comment) && $this->addError("Please provide a comment!");

        if ($rating < 1 || $rating > 5 || !is_numeric($rating)) {
            $this->addError("Please provide a valid rating between 1 and 5.");
        }
        
        $type = $sanitized['type'];
        if ($type == 'vet') {
            $table = 'vetfeedback';
            $sanitized['doctorID'] = $sanitized['providerID'];
            $sanitized['appointmentID'] = $sanitized['apptID']; 
        }
        else if ($type == 'salon') {
            $table = 'salonfeedback';
            $sanitized['salonID'] = $sanitized['providerID'];
            $sanitized['groomingID'] = $sanitized['apptID']; 
        }
        unset($sanitized['providerID'], $sanitized['apptID'], $sanitized['type']);

        header('Content-Type: application/json');

        if($this->validInputs) {
            $feedbackObj = new PO_Feedback;
            // $postDone = $feedbackObj->postFeedback($table, $sanitized);
            $postDone = true;
            
            if ($postDone) {
                echo json_encode(["status" => "success",
                                "popupTitle" => "Success! 😺",
                                "popUpMsg" => "Posted feedback successfully!",
                                "popUpIcon" => ROOT."/assets/images/petOwner/popUpIcons/success.png",
                                "nextPage" => "PO_petProfile"
                            ]);
                exit();
            } else {
                echo json_encode(["status" => "failure",
                                "popupTitle" => "Failure! 🙀",
                                "popUpMsg" => "Couldn't post feedback. 🙀\nPlease try again later.",
                                "popUpIcon" => ROOT."/assets/images/petOwner/popUpIcons/fail.png"
                            ]);
                exit();
            }
        }
        else {
            echo json_encode([
                "status" => "inputFail",
                "msg" => implode(';', $this->errors)
            ]);
            exit();
        }
    }
}
