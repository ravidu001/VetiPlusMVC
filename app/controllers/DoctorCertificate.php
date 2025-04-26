<?php

class DoctorCertificate extends Controller {
    public function index() {

        $this->view('vetDoctor/doctorcertificate');
    }

    public function certificate() {
        $this->view('vetDoctor/certificate');
    }
    // New method to fetch pet data based on Pet ID
    public function getPetData() {
        // Check if the request is an AJAX request
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['petId'])) {
            $petId = $_GET['petId'];
    
            // Assuming you have a model to interact with the database
            $petModel = new Pet(); // Replace with your actual model name
            $petData = $petModel->findPetDetailsByID($petId); // Fetch pet data by ID
    
            if ($petData) {
                // Return the pet data as JSON
                echo json_encode($petData);
            } else {
                // Return an empty JSON object if no data found
                echo json_encode([]);
            }
        } else {
            // Handle invalid requests
            http_response_code(400);
            echo json_encode(['error' => 'Invalid request']);
        }
    }
}
