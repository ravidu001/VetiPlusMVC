<?php

/**
 * This class and thereby its view page will only be accessed through a URL petcard in PO_home (dashboard)
 */
class PO_petProfile extends Controller {

    private $petID;
    private $petOwnerID;

    public function __construct() {
        if(!isset($_GET['petID'])) redirect('PO_home');
        else $this->petID = $_GET['petID'];

        $this->petOwnerID = $_SESSION['petOwnerID'];
    }

    public function index() {
        $this->view('petowner/petProfile');
    }

    public function changeProfilePicture () {
        $profilePicture = $_FILES['profilePicture'];
        $targetDir = ROOT.'/assets/images/petOwner/profilePictures/pet/';

        $originalName = $profilePicture['name'];
        $tempPath = $profilePicture['tmp_name'];

        // Get file extension and generate new file name
        $fileExt = pathinfo($originalName, PATHINFO_EXTENSION);
        $newFileName = "pet_" . $this->petID . "." . $fileExt;

        // Move uploaded file to the target directory
        $destination = $targetDir . $newFileName;
        $uploadDone = move_uploaded_file($tempPath, $destination);

        if ($uploadDone) {
            $pet = new Pet;
            $updateDone = $pet->uploadProfilePicture($this->petID, ['profilePicture' => $newFileName]);
            if ($updateDone) {
                echo json_encode(["status" => "success",
                                "title" => "Success! 😺",
                                "message" => "Uploaded pet's profile picture successfully!",
                                "icon" => ROOT."/assets/images/petOwner/success.png"
                            ]);
                exit();
            } else {
                echo json_encode(["status" => "failure",
                                "title" => "Failure! 🙀",
                                "message" => "Couldn't update pet's profile picture. 🙀\nPlease try again later.",
                                "icon" => ROOT."/assets/images/petOwner/fail.png"
                            ]);
                exit();
            }
        } else {
            echo json_encode(["status" => "failure",
                            "title" => "Failure! 🙀",
                            "message" => "Couldn't upload pet's profile picture. 🙀\nPlease try again later.",
                            "icon" => ROOT."/assets/images/petOwner/fail.png"
                        ]);
            exit();
        }
    }
}
