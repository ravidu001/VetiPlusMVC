<?php

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

    public function changeProfilePicture () {
        $profilePicture = $_FILES['profilePicture'];
        $targetDir = $_SERVER['DOCUMENT_ROOT'].'/VetiPlusMVC/public/assets/images/petOwner/profilePictures/po_user/';

        $originalName = $profilePicture['name'];
        $tempPath = $profilePicture['tmp_name'];

        // Get file extension and generate new file name
        $fileExt = pathinfo($originalName, PATHINFO_EXTENSION);
        $newFileName = "petOwner_" . $this->petOwnerID . "." . $fileExt;

        // Move uploaded file to the target directory
        $destination = $targetDir . $newFileName;
        $uploadDone = move_uploaded_file($tempPath, $destination);

        if ($uploadDone) {
            // $petOwner = new PetOwner;
            // $petOwner->setPetOwnerID();

            $updateDone = $this->petOwner->uploadProfilePicture(['profilePicture' => $newFileName]);
            if ($updateDone) {
                echo json_encode(["status" => "success",
                                "title" => "Success! 😺",
                                "message" => "Uploaded profile picture successfully!",
                                "icon" => ROOT."/assets/images/petOwner/popUpIcons/success.png"
                            ]);
                exit();
            } else {
                echo json_encode(["status" => "failure",
                                "title" => "Failure! 🙀",
                                "message" => "Couldn't update profile picture. 🙀\nPlease try again later.",
                                "icon" => ROOT."/assets/images/petOwner/popUpIcons/fail.png"
                            ]);
                exit();
            }
        } else {
            echo json_encode(["status" => "failure",
                            "title" => "Failure! 🙀",
                            "message" => "Couldn't upload profile picture. 🙀\nPlease try again later.",
                            "icon" => ROOT."/assets/images/petOwner/popUpIcons/fail.png"
                        ]);
            exit();
        }
    }

    public function editUserDetails () {

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
                "message" => "Password changed successfully!"
            ]);
        } else {
            echo json_encode([
                "status" => "failure",
                "message" => "Failed to change password. Please try again."
            ]);
        }
    }

    public function logout () {
        unset($_SESSION['petOwnerID']);
        redirect('Landing');
    }
}
