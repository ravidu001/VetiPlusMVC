<?php

function sanitizeInput($input) {
    return htmlspecialchars(trim($input));
}

class PO_petBreeding extends Controller {

    public $petOwnerID;

    public $petOwnerDetails;
    public $forBreedingObj;

    public $petList;

    public function __construct() {
        !isset($_SESSION['petOwnerID']) && redirect('Login');
        $this->petOwnerID = $_SESSION['petOwnerID'];

        $this->forBreedingObj = new ForBreeding;

        $petOwner = new PetOwner;
        $this->petOwnerDetails = $petOwner->getDetails_forOtherListings($this->petOwnerID)[0];

        $petObj = new Pet;
        $petObj->setPetOwnerID();
        $this->petList = $petObj->getAllPetsUnderUser();
    }

    public function index() {
        $this->view('petowner/petBreeding');
    }

    public function forBreeding_addNew () {
        $sanitized = array_map('sanitizeInput', $_POST);
        // if (in_array('', $sanitized, true)) {
        //     echo json_encode([
        //         "status" => "inputFail",
        //         "message" => "Please fill all the required fields!"
        //     ]);
        //     exit();
        // }

        $fullInsertData = array_merge($sanitized, (array) $this->petOwnerDetails);
        $fullInsertData['petOwnerID'] = $this->petOwnerID;

        $insertSuccess = $this->forBreedingObj->addNew($fullInsertData);
        if ($insertSuccess) {
            echo json_encode(["status" => "success",
                            "popUpTitle" => "Success! 😺",
                            "popUpMsg" => "Successfully listed for breeding!",
                            "popUpIcon" => ROOT."/assets/images/petOwner/popUpIcons/success.png",
                            "nextPage" => "PO_petBreeding"
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
    public function forBreeding_edit () {
        $sanitized = array_map('sanitizeInput', $_POST);
        if (in_array('', $sanitized, true)) {
            echo json_encode([
                "status" => "inputFail",
                "message" => "Please fill all the required fields!"
            ]);
            exit();
        }
        $itemID = $sanitized['breedingListID'];
        unset($sanitized['breedingListID']);

        $updateSuccess = $this->forBreedingObj->edit($itemID, $sanitized);
        if ($updateSuccess) {
            echo json_encode(["status" => "success",
                            "popUpTitle" => "Success! 😺",
                            "popUpMsg" => "Successfully edited breeding details!",
                            "popUpIcon" => ROOT."/assets/images/petOwner/popUpIcons/success.png",
                            "nextPage" => "PO_petBreeding"
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
    public function forBreeding_delist () {
        $sanitized = array_map('sanitizeInput', $_POST);
        $itemID = $sanitized['someID'];

        $delistSuccess = $this->forBreedingObj->delist($itemID);
        if ($delistSuccess) {
            echo json_encode(["status" => "success",
                            "popUpTitle" => "Success! 😺",
                            "popUpMsg" => "Successfully removed from breeding list!",
                            "popUpIcon" => ROOT."/assets/images/petOwner/popUpIcons/success.png",
                            "nextPage" => "PO_petBreeding"
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

    public function forBreeding_getList () {
        $result = $this->forBreedingObj->getList_byOthers($this->petOwnerID)  ?: ["fetchedCount" => 0];
        
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }
    public function forBreeding_getMyList () {
        $result = $this->forBreedingObj->getList_byPetOwner($this->petOwnerID)  ?: ["fetchedCount" => 0];
        
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }
    public function getPetDetailsToFill () {
        $petID = $_GET['petID'];

        $result = $this->forBreedingObj->getPetDetails($petID)[0];
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }
}
