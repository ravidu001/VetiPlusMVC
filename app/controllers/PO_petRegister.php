<?php

function sanitizeInput($input) {
    return htmlspecialchars(trim($input));
}

class PO_petRegister extends Controller {

    // public $petOwnerID;

    public $speciesBreeds;  // a Species_Breeds object
    public $speciesList;

    public function index () {
        $this->view('petowner/petRegister');
    }

    public function __construct() {
        // isset($_SESSION['petOwnerID'])
        //     ? $this->petOwnerID = $_SESSION['petOwnerID']
        //     : redirect('Login');
        !isset($_SESSION['petOwnerID']) && redirect('Login');

        $this->speciesBreeds = new Species_Breeds;
        $this->speciesList = $this->speciesBreeds->getSpeciesList();   
    }

    public function breedList ($species) {
        $result = $this->speciesBreeds->getBreedsList($species);
        
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }

    // the following 3 are used to validate the form inputs and add error messages
    private $errors = [];
    private $validInputs = true;
    private function addError($msg) {
        $this->errors[] = $msg;
        $this->validInputs = false;
    }
    /**
     * Receives the form data from the pet owner registration form, checks and passes it to the model to be inserted.
     * Returns JSON object back to view page with success or failure message
     */
    public function petRegister () {
        $sanitized = array_map('sanitizeInput', $_POST);

        $name = $sanitized['name']; 
        $DOB = $sanitized['DOB'];
        $gender = $sanitized['gender'];

        $species = $sanitized['species'];
        $breed = $sanitized['breed'];

        if(empty($name)) $this->addError("Empty name value provided!");
        elseif (strlen($name) < 3) $this->addError("Name should be at least 3 characters.");
    
        $today = new DateTime("now");
        $dobDate = DateTime::createFromFormat('Y-m-d', $DOB);
        if ($dobDate && $dobDate > $today) $this->addError("Invalid date of birth.");
    
        if($gender != 'male' && $gender != 'female') $this->addError("Gender is not selected!");

        if(empty($species) || $species == "ph") $this->addError("No species selected!");
        if(empty($breed) || $breed == "ph") $this->addError("No breed selected!");
        
        header('Content-Type: application/json');


        if($this->validInputs) {
            $newPet = new Pet;
            $newPet->setPetOwnerID();
            $insertSuccess = true;
            // $insertSuccess = $newPet->register($sanitized);
            
            if ($insertSuccess) {
                echo json_encode(["status" => "success",
                                "popUpTitle" => "Success! 😺",
                                "popUpMsg" => "Registration successful! 😺",
                                "popUpIcon" => ROOT."/assets/images/petOwner/popUpIcons/success.png",
                                "nextPage" => "PO_home"
                            ]);
                exit();
            } else {
                echo json_encode(["status" => "failure",
                                "popUpTitle" => "Failure! 🙀",
                                "popUpMsg" => "Registration unsuccessful. 🙀\nPlease try again later.",
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
}
