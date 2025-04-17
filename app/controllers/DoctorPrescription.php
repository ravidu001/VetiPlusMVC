<?php

class DoctorPrescription extends Controller {
    public function index() {
        // Check if the user is logged in
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . ROOT . '/login');
            exit();
        }
        if(!isset($_SESSION['popupShown']) || !isset($_GET['petID'])){
        $_SESSION['popupShown'] = true;
    }
        else{
            $_SESSION['popupShown'] = false;
        }
        $doctorID = $_SESSION['user_id'];
        $sessionModel = new DoctorSessionModel();
        $sessionData = $sessionModel->getsession($doctorID);
    
        // Initialize an array to hold appointment and pet data
        $appointmentsWithPets = [];
        $petsBySession = []; // New array to hold pets by session
    
        foreach ($sessionData as $sessionItem) {
            if ($sessionItem->completeStatus == 0) {
                $appointmentModel = new AppointmentModel();
                $appointmentData = $appointmentModel->getAppointmentBySessionwithEmpty($sessionItem->sessionID);
    
                foreach ($appointmentData as $appointmentItem) {
                    $petModel = new Pet();
                    $petData = $petModel->findPetDetailsByID($appointmentItem->petID);
    
                    // Store the appointment and pet data in the array
                    $appointmentsWithPets[] = [
                        'session' => $sessionItem,
                        'appointment' => $appointmentItem,
                        'pet' => $petData
                    ];
    
                    // Group pets by session
                    if (!isset($petsBySession[$sessionItem->sessionID])) {
                        $petsBySession[$sessionItem->sessionID] = [];
                    }
                    $petsBySession[$sessionItem->sessionID][] = $petData;
                }
            }
        }
    
        // Pass the combined data to the view
        $this->view('vetDoctor/doctorprescription', [
            'appointmentsWithPets' => $appointmentsWithPets,
            'petsBySession' => $petsBySession,
            'selectedPetID' => $_GET['petID'] ?? null // Pass the selected pet ID if available
        ]);
    }

    public function getpetdetails() {
        // Check if the user is logged in
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . ROOT . '/login');
            exit();
        }
    
        // Get the raw POST data
        $data = json_decode(file_get_contents('php://input'), true);
    
        // Check if data is received
        if ($data) {
            // Extract the values
            $petID = $data['petID'] ?? null;
            $sessionID = $data['sessionID'] ?? null;
            $appointmentID = $data['appointmentID'] ?? null;
    
            $petModel = new Pet();
            $petData = $petModel->findPetDetailsByID($petID);
   
            if ($petData) {
                // Set a session variable to indicate that the popup should not be shown
                $_SESSION['popupShown'] = false;

                // Return the pet data along with a success message
                echo json_encode(['status' => 'success', 'message' => 'Data received successfully', 'petData' => $petData]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Pet not found']);
            }
        } else {
            // Handle the case where no data is received
            echo json_encode(['status' => 'error', 'message' => 'No data received']);
        }
    }
}