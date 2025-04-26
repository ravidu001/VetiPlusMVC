<?php

function sanitizeInput($input) {
    return htmlspecialchars(trim($input));
}

class PO_userProfile extends Controller {

    private $petOwnerID;

    public $petOwner;
    public $po_details; // eg usage: $this->po_details->fullName

    public function __construct() {
        isset($_SESSION['petOwnerID'])
            ? $this->petOwnerID = $_SESSION['petOwnerID']
            : redirect('Login');

        $this->petOwner = new PetOwner;
        $this->petOwner->setPetOwnerID();
        
        // an array containing petOwner table details
        $this->po_details = $this->petOwner->getUserDetails();
    }
    
    public function index() {
        $this->view('petowner/userProfile');
    }
    
    // the following 3 are used to validate the form inputs and add error messages
    private $errors = [];
    private $validInputs = true;
    private function addError($msg) {
        $this->errors[] = $msg;
        $this->validInputs = false;
    }

    public function changeProfilePicture () {
        $profilePicture = $_FILES['profilePicture'];
        $targetDir = $_SERVER['DOCUMENT_ROOT'].'/VetiPlusMVC/public/assets/images/petOwner/profilePictures/po_user/';

        $originalName = $profilePicture['name'];
        $tempPath = $profilePicture['tmp_name'];

        // Get file extension and generate new file name
        $fileExt = pathinfo($originalName, PATHINFO_EXTENSION);
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array(strtolower($fileExt), $allowedExtensions)) {
            
            echo json_encode([
                "status" => "inputFail",
                "message" => "Invalid profile picture type!"
            ]);
            exit();
        }
        $newFileName = "petOwner_" . $this->petOwnerID . "." . $fileExt;

        // Move uploaded file to the target directory
        $destination = $targetDir . $newFileName;
        $uploadDone = move_uploaded_file($tempPath, $destination);

        if ($uploadDone) {

            $updateDone = $this->petOwner->uploadProfilePicture(['profilePicture' => $newFileName]);
            if ($updateDone) {
                echo json_encode(["status" => "success",
                                "popUpTitle" => "Success! 😺",
                                "popUpMsg" => "Uploaded profile picture successfully!",
                                "popUpIcon" => ROOT."/assets/images/petOwner/popUpIcons/success.png",
                                "nextPage" => 'PO_userProfile'
                            ]);
                exit();
            } else {
                echo json_encode(["status" => "failure",
                                "popUpTitle" => "Failure! 🙀",
                                "popUpMsg" => "Couldn't update profile picture. 🙀\nPlease try again later.",
                                "popUpIcon" => ROOT."/assets/images/petOwner/popUpIcons/fail.png"
                            ]);
                exit();
            }
        } else {
            echo json_encode(["status" => "failure",
                            "popUpTitle" => "Failure! 🙀",
                            "popUpMsg" => "Couldn't upload profile picture. 🙀\nPlease try again later.",
                            "popUpIcon" => ROOT."/assets/images/petOwner/popUpIcons/fail.png"
                        ]);
            exit();
        }
    }

    public function editUserDetails () {
        $sanitized = array_map('sanitizeInput', $_POST);
        
        $fullName = $sanitized['fullName']; 
        $contactNumber = $sanitized['contactNumber'];
        $DOB = $sanitized['DOB'];

        if(empty($fullName)) $this->addError("Empty name value provided!");
        elseif (strlen($fullName) < 5) $this->addError("Name should be at least 5 characters.");
    
        $today = new DateTime("now");
        $tenYearsAgo = (clone $today)->modify('-10 years')->format('Y-m-d');
        $dobDate = DateTime::createFromFormat('Y-m-d', $DOB);
    
        if ($dobDate && $dobDate > new DateTime($tenYearsAgo))
            $this->addError("Invalid date of birth: you should be 10 years at least.");
    
        $contactRegex = '/^07\\d{8}$/';
        if(empty($contactNumber)) $this->addError("No contact number provided!");
        elseif (!preg_match($contactRegex, $contactNumber))
            $this->addError("Contact number does not follow Sri Lankan phone pattern!\n10 numbers starting with 07.");
    
        if(empty($sanitized['houseNo'])) $this->addError("No house number or apartment number provided for Address!");
        if(empty($sanitized['streetName'])) $this->addError("No street name provided for Address!");
        if(empty($sanitized['city'])) $this->addError("No city provided for Address!");
        if(empty($sanitized['district'])) $this->addError("No district provided for Address!");
    
        $lastLogin = $today->format('Y-m-d H:i');
        $sanitized['lastLogin'] = $lastLogin;

        header('Content-Type: application/json');

        if($this->validInputs) {
            $newPetOwner = new PetOwner;
            $newPetOwner->setPetOwnerID();

            $insertSuccess = $newPetOwner->editProfileDetails($this->petOwnerID, $sanitized);
            
            if ($insertSuccess) {
                echo json_encode(["status" => "success",
                                "popUpTitle" => "Success! 😺",
                                "popUpMsg" => "Details updated successfully! 😺",
                                "popUpIcon" => ROOT."/assets/images/petOwner/popUpIcons/success.png",
                                "nextPage" => "PO_userProfile"
                            ]);
                exit();
            } else {
                echo json_encode(["status" => "failure",
                                "popUpTitle" => "Failure! 🙀",
                                "popUpMsg" => "Something went wrong. 🙀\nPlease try again later.",
                                "popUpIcon" => ROOT."/assets/images/petOwner/popUpIcons/fail.png"
                            ]);
                exit();
            }
        }
        else {
            echo json_encode([
                "status" => "inputFail",
                "message" => implode(';', $this->errors)
            ]);
            exit();
        }
    }

    public function changePassword () {
        $sanitized = array_map('sanitizeInput', $_POST);

        $oldPass = $sanitized['oldPass'];
        $newPass = $sanitized['newPass'];
        $confirmPass = $sanitized['confirmPass'];

        header('Content-Type: application/json');

        if (empty($oldPass) || empty($newPass) || empty($confirmPass)) {
            echo json_encode([
                "status" => "inputFail",
                "message" => "Please fill in all fields."
            ]);
            exit();
        }

        if ($newPass !== $confirmPass) {
            echo json_encode([
                "status" => "inputFail",
                "message" => "Please confirm your password correctly."
            ]);
            exit();
        }

        $user = new User;
        $updateSuccess = $user->po_changePassword($this->petOwnerID, $oldPass, $newPass);

        if ($updateSuccess) {
            echo json_encode([
                "status" => "success",
                "popUpIcon" => ROOT."/assets/images/petOwner/popUpIcons/success.png",
                "popUpMsg" => "Password changed successfully!",
                "nextPage" => "PO_userProfile"
            ]);
        } else {
            echo json_encode([
                "status" => "failure",
                "popUpIcon" => ROOT."/assets/images/petOwner/popUpIcons/fail.png",
                "popUpMsg" => "Failed to change password. Please try again later."
            ]);
        }
    }

    public function logout () {
        unset($_SESSION['petOwnerID']);
        redirect('Landing');
    }

    public function deleteAccount () {
        $user = new User;
        $deleteDone = empty($user->deactivateUser($this->petOwnerID, 'deactive')) ? true : false;
        if ($deleteDone) {
            echo json_encode([
                "status" => "success",
                "popUpIcon" => ROOT."/assets/images/petOwner/popUpIcons/success.png",
                "popUpMsg" => "We're sorry to see you go 😓!",
                "nextPage" => "Landing"
            ]);
        } else {
            echo json_encode([
                "status" => "failure",
                "popUpIcon" => ROOT."/assets/images/petOwner/popUpIcons/fail.png",
                "popUpMsg" => "Something went wrong! PLease try again later."
            ]);
        }
    }
}
