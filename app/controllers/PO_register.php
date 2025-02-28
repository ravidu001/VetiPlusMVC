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
        $DOB = $sanitized['DOB'];
        $contactNumber = $sanitized['contactNumber'];
        $NIC = $sanitized['NIC'];
        $gender = $sanitized['gender'];
    
        $houseNo = $sanitized['houseNo'];
        $streetName = $sanitized['streetName'];
        $city = $sanitized['city'];

        if(empty($fullName)) $this->addError("Empty name value provided!");
        elseif (strlen($fullName) < 5) $this->addError("Name should be at least 5 characters.");
    
        $today = new DateTime("now");
        $tenYearsAgo = (clone $today)->modify('-10 years')->format('Y-m-d');
        $dobDate = DateTime::createFromFormat('Y-m-d', $DOB);
    
        if ($dobDate && $dobDate > new DateTime($tenYearsAgo)) $this->addError("Invalid date of birth: you should be 10 years at least.");
    
        $contactRegex = '/07\\d\\d\\d\\d\\d\\d\\d\\d/i';
        if(empty($contactNumber)) $this->addError("No contact number provided!");
        elseif (!preg_match($contactRegex, $contactNumber)) $this->addError("Contact number does not follow Sri Lankan phone pattern!\n10 numbers starting with 07.");
    
        $nicRegex = '/(?:[4-9][0-9]{8}[vVxX])|(?:[12][0-9]{11})/';
        if(empty($NIC)) $this->addError("No NIC number provided!");
        elseif (!preg_match($nicRegex, $NIC)) $this->addError("NIC number does not follow Sri Lankan NIC number pattern.");
    
        if($gender != 'male' && $gender != 'female') $this->addError("Gender is not selected!");
    
        if(empty($houseNo)) $this->addError("No house number or apartment number provided for Address!");
        if(empty($streetName)) $this->addError("No street name provided for Address!");
        if(empty($city)) $this->addError("No city provided for Address!");
    
        $lastLogin = $today->format('Y-m-d H:i');
        $sanitized['lastLogin'] = $lastLogin;

        header('Content-Type: application/json');

        if($this->validInputs) {
            $newPetOwner = new PetOwner;
            $newPetOwner->setPetOwnerID();

            $insertSuccess = $newPetOwner->register($sanitized);
            
            if ($insertSuccess) {
                echo json_encode(["status" => "success",
                                "title" => "Success! 😺",
                                "message" => "Registration successful! 😺\nWelcome to VetiPlus!",
                                "icon" => ROOT."/assets/images/petOwner/success.png",
                                "nextPage" => "PO_home"
                            ]);
                exit();
            } else {
                echo json_encode(["status" => "failure",
                                "title" => "Failure! 🙀",
                                "message" => "Registration unsuccessful. 🙀\nPlease try again later.",
                                "icon" => ROOT."/assets/images/petOwner/fail.png"
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
