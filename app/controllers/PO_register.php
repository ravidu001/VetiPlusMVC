<?php

function sanitizeInput($input) {
    return htmlspecialchars(trim($input));
}

class PO_register extends Controller {

    public function __construct() {
        !isset($_SESSION['petOwnerID']) && redirect('Login');
    }

    public function index () {
        $this->view('petowner/register');
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
    public function petOwnerRegister () {
        $sanitized = array_map('sanitizeInput', $_POST);
        
        $fullName = $sanitized['fullName']; 
        $contactNumber = $sanitized['contactNumber'];
        $DOB = $sanitized['DOB'];
        $gender = $sanitized['gender'];

        if(empty($fullName)) $this->addError("Empty name value provided!");
        elseif (strlen($fullName) < 5) $this->addError("Name should be at least 5 characters.");
    
        $today = new DateTime("now");
        $tenYearsAgo = (clone $today)->modify('-10 years')->format('Y-m-d');
        $dobDate = DateTime::createFromFormat('Y-m-d', $DOB);
    
        if ($dobDate && $dobDate > new DateTime($tenYearsAgo)) $this->addError("Invalid date of birth: you should be 10 years at least.");
    
        $contactRegex = '/^07\\d{8}$/';
        if(empty($contactNumber)) $this->addError("No contact number provided!");
        elseif (!preg_match($contactRegex, $contactNumber))
            $this->addError("Contact number does not follow Sri Lankan phone pattern!\n10 numbers starting with 07.");
    
        if($gender != 'male' && $gender != 'female') $this->addError("Gender is not selected!");
    
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

            $insertSuccess = $newPetOwner->register($sanitized);
            
            if ($insertSuccess) {
                echo json_encode(["status" => "success",
                                "popUpTitle" => "Success! 😺",
                                "popUpMsg" => "Registration successful! 😺\nWelcome to VetiPlus!",
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
