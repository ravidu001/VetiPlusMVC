<?php

function sanitizeInput($input) {
    return htmlspecialchars(trim($input));
}

class PO_petAdoption extends Controller {

    public $petOwnerID;

    public $petOwnerDetails;
    public $forAdoptionObj;

    public function __construct() {
        !isset($_SESSION['petOwnerID']) && redirect('Login');
        $this->petOwnerID = $_SESSION['petOwnerID'];

        $this->forAdoptionObj = new ForAdoption;

        $petOwner = new PetOwner;
        $this->petOwnerDetails = $petOwner->getDetails_forOtherListings($this->petOwnerID)[0];
    }

    public function index() {
        $this->view('petowner/petAdoption');
    }

    public function forAdoption_addNew () {
        $sanitized = array_map('sanitizeInput', $_POST);
        if (in_array('', $sanitized, true)) {
            echo json_encode([
                "status" => "inputFail",
                "message" => "Please fill all the required fields!"
            ]);
            exit();
        }
        if (isset($sanitized['lastCheckUpDate']) && isset($sanitized['lastCheckUpTime'])) {
            $date = $sanitized['lastCheckUpDate'];
            $time = $sanitized['lastCheckUpTime'];
    
            unset($sanitized['lastCheckUpDate'], $sanitized['lastCheckUpTime']);
            $sanitized['lastCheckUpDate'] = $date . ' ' . $time;
        }

        $fullInsertData = array_merge($sanitized, (array) $this->petOwnerDetails);
        $fullInsertData['petOwnerID'] = $this->petOwnerID;

        $insertSuccess = $this->forAdoptionObj->addNew($fullInsertData);
        if ($insertSuccess) {
            echo json_encode(["status" => "success",
                            "popUpTitle" => "Success! 😺",
                            "popUpMsg" => "Successfully listed for adoption!",
                            "popUpIcon" => ROOT."/assets/images/petOwner/popUpIcons/success.png",
                            "nextPage" => "PO_petAdoption"
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
    public function forAdoption_edit () {
        $sanitized = array_map('sanitizeInput', $_POST);
        if (in_array('', $sanitized, true)) {
            echo json_encode([
                "status" => "inputFail",
                "message" => "Please fill all the required fields!"
            ]);
            exit();
        }

        $uploadDone = true;

        if ( isset($_FILES['adoptionImage'])
        && $_FILES['adoptionImage']['error'] === UPLOAD_ERR_OK
        && $_FILES['adoptionImage']['size'] > 0) {
            $profilePicture = $_FILES['adoptionImage'];
            $targetDir = $_SERVER['DOCUMENT_ROOT'].'/VetiPlusMVC/public/assets/images/petOwner/profilePictures/adoption/';
    
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
            $newFileName = "adoption_" . $sanitized['adoptionListID'] .".". $fileExt;
            $sanitized['adoptionImage'] = $newFileName;
    
            // Move uploaded file to the target directory
            $destination = $targetDir . $newFileName;
            $uploadDone = move_uploaded_file($tempPath, $destination);
        }

        if ($uploadDone) {
            $itemID = $sanitized['adoptionListID'];
            unset($sanitized['adoptionListID']);
    
            $sanitized['petOwnerID'] = $this->petOwnerID;
            $sanitized = array_filter($sanitized, function($value) {
                return !is_null($value);
            });
    
            header('Content-Type: application/json');
            $updateSuccess = $this->forAdoptionObj->edit($itemID, $sanitized);
            if ($updateSuccess) {
                echo json_encode(["status" => "success",
                                "popUpTitle" => "Success! 😺",
                                "popUpMsg" => "Successfully edited adoption details!",
                                "popUpIcon" => ROOT."/assets/images/petOwner/popUpIcons/success.png",
                                "nextPage" => "PO_petAdoption"
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

        } else {
            echo json_encode(["status" => "failure",
                        "popUpTitle" => "Failure! 🙀",
                        "popUpMsg" => "Something went wrong with uploading. 🙀\nPlease try again later.",
                        "popUpIcon" => ROOT."/assets/images/petOwner/popUpIcons/fail.png"
                    ]);
            exit();
        }
    }
    public function forAdoption_delist () {
        $sanitized = array_map('sanitizeInput', $_POST);
        $itemID = $sanitized['someID'];

        $delistSuccess = $this->forAdoptionObj->delist($itemID);
        if ($delistSuccess) {
            echo json_encode(["status" => "success",
                            "popUpTitle" => "Success! 😺",
                            "popUpMsg" => "Successfully removed from adoption!",
                            "popUpIcon" => ROOT."/assets/images/petOwner/popUpIcons/success.png",
                            "nextPage" => "PO_petAdoption"
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

    public function forAdoption_getList () {
        $result = $this->forAdoptionObj->getList_byOthers($this->petOwnerID)  ?: ["fetchedCount" => 0];
        
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }
    public function forAdoption_getMyList () {
        $result = $this->forAdoptionObj->getList_byPetOwner($this->petOwnerID)  ?: ["fetchedCount" => 0];
        
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }
}
