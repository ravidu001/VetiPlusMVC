<?php

class PO_register extends Controller {
    public function index () {
        $this->view('petowner/register');
    }

    /**
     * Receives the form data from the pet owner registration form, checks and passes it to the model to be inserted.
     * Returns json object back to view with success or failure message
     * @return void
     */
    public function petOwnerRegister () {
        $data = [
            'fullName' => htmlspecialchars(trim($_POST['fullName'] ?? '')),
            'profilePicture' => htmlspecialchars(trim($_POST['profilePicture'] ?? '')),
            'gender' => htmlspecialchars(trim($_POST['gender'] ?? '')),
            'DOB' => htmlspecialchars(trim($_POST['DOB'] ?? '')),
            'NIC' => htmlspecialchars(trim($_POST['NIC'] ?? '')),
            'houseNo' => htmlspecialchars(trim($_POST['houseNo'] ?? '')),
            'streetName' => htmlspecialchars(trim($_POST['streetName'] ?? '')),
            'city' => htmlspecialchars(trim($_POST['city'] ?? ''))
        ];
        $newPetOwner = new PetOwner;
        
        $insertSuccess = $newPetOwner->insert($data);

        header('Content-Type: application/json');
        if ($insertSuccess) {
            echo json_encode(["status" => "success",
                            "message" => "Registration successful! 😺\nWelcome to VetiPlus!"]);
            exit();
        } else {
            echo json_encode(["status" => "failure",
                            "message" => "Registration unsuccessful. 🙀\nPlease try again later."]);
            exit();
        }
    }
}
