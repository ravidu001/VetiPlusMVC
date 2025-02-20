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
        // an assoc array containing petOwner table details
        $this->po_details = $this->petOwner->getUserDetails();
    }
    
    public function index() {
        $this->view('petowner/userProfile');
    }

    public function changeProfilePicture () {
        $profilePicture = $_FILES['profilePicture'];
        $targetDir = ROOT.'/assets/images/petOwner/profilePictures/po_user/';

        $originalName = $profilePicture['name'];
        $tempPath = $profilePicture['tmp_name'];

        // Get file extension and generate new file name
        $fileExt = pathinfo($originalName, PATHINFO_EXTENSION);
        $newFileName = "petOwner_" . $this->petOwnerID . "." . $fileExt;

        // Move uploaded file to the target directory
        $destination = $targetDir . $newFileName;
        $uploadDone = move_uploaded_file($tempPath, $destination);

        if ($uploadDone) {
            $petOwner = new PetOwner;
            $updateDone = $petOwner->uploadProfilePicture($this->petOwnerID, ['profilePicture' => $newFileName]);
            if ($updateDone) {
                echo json_encode(["status" => "success",
                                "title" => "Success! 😺",
                                "message" => "Uploaded petOwner's profile picture successfully!",
                                "icon" => ROOT."/assets/images/petOwner/success.png"
                            ]);
                exit();
            } else {
                echo json_encode(["status" => "failure",
                                "title" => "Failure! 🙀",
                                "message" => "Couldn't update petOwner's profile picture. 🙀\nPlease try again later.",
                                "icon" => ROOT."/assets/images/petOwner/fail.png"
                            ]);
                exit();
            }
        } else {
            echo json_encode(["status" => "failure",
                            "title" => "Failure! 🙀",
                            "message" => "Couldn't upload petOwner's profile picture. 🙀\nPlease try again later.",
                            "icon" => ROOT."/assets/images/petOwner/fail.png"
                        ]);
            exit();
        }
    }

    public function logout () {
        unset($_SESSION['petOwnerID']);
        redirect('Landing');
    }
}
