<?php

class DoctorViewSession extends Controller {
    public function index() {
        $doctorID = $_SESSION['user_id'];
        $session = new DoctorSessionModel;

        // Call the autoUpdate function to auto update the session status when expired
        $this->autoUpdate();

        // Call the inserthistory function to insert old sessions into session history (change session status to 1)
        $update = $this->inserthistory();
    
        // Get all sessions for the doctor
        $sessionData = $session->getsession($doctorID);
    
        // Initialize an array to hold consolidated session data
        $consolidatedSessions = [];
    
        if (is_array($sessionData)){
            // Iterate over each session to get assistant session data
            foreach ($sessionData as $sessionItem) {
                if($sessionItem->completeStatus == 1) {
                    continue;
                }
    
                $appointment = new AppointmentModel();
                $appointmentData = $appointment->getAppointmentBySession($sessionItem->sessionID);
                $eachappointmentCount = 0; 
                if (is_array($appointmentData)) {
                    foreach ($appointmentData as $appointmentItem) {
                        // Check if the appointment status is 'available'
                        if ($appointmentItem->status == 'available') {
                            $eachappointmentCount++;
                        }
                    }
                } else {
                    // Log or handle the case where $appointmentData is not an array
                    error_log("getAppointmentBySession did not return an array for sessionID: " . $sessionItem->sessionID);
                }
                
                $assisSession = new AssistantSessionModel;
                $assisSessionData = $assisSession->getAssistantsession($sessionItem->sessionID);
        
                // Prepare assistant data for this session
                $sessionAssistants = [];
        
                // Check if assistant session data is found
                if ($assisSessionData) {
                    foreach ($assisSessionData as $assisSessionItem) {
                        $assistant = new AssisModel;
                        $assistantData = $assistant->getAssistant($assisSessionItem->assistantID);
        
                        if ($assistantData) {
                            $sessionAssistants[] = $assistantData;
                        }
                    }
                }
                // Consolidate session data
                $consolidatedSessions[] = [
                    'session' => $sessionItem,
                    'assistants' => $sessionAssistants,
                    'appointmentCount' => $eachappointmentCount
                ];
            }
        }
    
        // Pass the consolidated session data to the view
        $this->view('vetDoctor/doctorviewsession', ['sessions' => $consolidatedSessions]);
    }

    public function inserthistory() {
        $doctorID = $_SESSION['user_id'];

        // echo "<script>window.alert('" . $doctorID . "');</script>";
        // $sessionhistory = new sessionHistoryModel();
        $session = new DoctorSessionModel();

        // get the current date
        $currentDate = new DateTime();
        // Calculate yesterday's date
        $yesterday = $currentDate->modify('-1 day')->format('Y-m-d');

        // Fetch old sessions 
        $alldata = $session->getsession($doctorID);
       
        if (is_array($alldata)) {
            // Insert old sessions into session history
            foreach ($alldata as $oldSession) {
                if ($oldSession->selectedDate <= $yesterday) {
                    $data = [
                        'completeStatus' => 1,
                    ];
                    $updateresult = $session->updatecompleteStatus($oldSession->sessionID, $data);
                }   
            }   
        }
    }

    public function session() {
        // Decode the sessionID and assistantIDs
        $sessionID = urldecode($_GET['sessionID']);
        $assistantIDs = urldecode($_GET['assistantIDs']);

        // Convert the assistantIDs string back to an array
        $assistantIDsArray = explode(',', $assistantIDs);
        // show($assistantIDsArray);
        // show($sessionID);

        // Initialize an array to hold consolidated session data
        $consolidatedSessions = [];

        // $consolidatedSessions[] = [
        //     'session' => $sessionItem,
        //     'assistants' => $sessionAssistants
        // ];

        $session = new DoctorSessionModel();

        // Fetch the session details using the sessionID
        $sessionDetails = $session->getsessionBySession($sessionID);
        // print_r($sessionDetails[0]->sessionID);

        // Fetch the assistant details using the sessionID
        $assisSession = new AssistantSessionModel;
        $assisSessionData = $assisSession->getAssistantsession($sessionID);

        // Prepare assistant data for this session
        $sessionAssistants = [];

        // Check if assistant session data is found
        if ($assisSessionData) {
            foreach ($assisSessionData as $assisSessionItem) {
                $assistant = new AssisModel;
                $assistantData = $assistant->getAssistant($assisSessionItem->assistantID);

                if ($assistantData) {
                    // print_r($assistantData->fullName);
                    $sessionAssistants[] = $assistantData;
                }
            }
        }

        // Consolidate session data
        $consolidatedSessions[] = [
            'session' => $sessionDetails[0],
            'assistants' => $sessionAssistants
        ];

        // Fetch the appointment details using the sessionID
        $appointment = new AppointmentModel();
        $appointmentDetails = $appointment->getAppointmentBySession($sessionID);

        // Prepare appointment data for this session
        $sessionAppointments = [];

        // Check if appointment data is found
        if ($appointmentDetails) {
            foreach ($appointmentDetails as $appointmentItem) {
                $pet = new Pet;
                $petData = $pet->findPetDetailsByID($appointmentItem->petID);

                $petOwner = new PetOwner;
                $petOwnerData = $petOwner->getUserDetailsByID($appointmentItem->petOwnerID);

                // Structure the data
                $sessionAppointments[] = [
                    'appointment' => $appointmentItem,
                    'pet' => $petData,
                    'petOwner' => $petOwnerData,
                ];
            }
            // show($sessionAppointments);
        }

        $this->view('vetDoctor/doctorsessionview', ['sessionsDetails' => $consolidatedSessions, 'appointmentsDetails' => $sessionAppointments]);
    }

    public function updateAppointment() {
        // Get the raw POST data
        $data = json_decode(file_get_contents('php://input'), true);
        
        $appointmentID = $data['appointmentID'];
        $status = $data['status'];
    
        // Validate the input
        if (isset($appointmentID) && isset($status)) {
            // Update the appointment status in the database
            $appointment = new AppointmentModel();
            $result = $appointment->updateAppointmentStatus($appointmentID, $status);
    
            if (!($result)) {
                // Return a success response
                echo json_encode(['success' => true, 'message' => 'Appointment status updated successfully.']);
            } else {
                // Return an error response
                echo json_encode(['success' => false, 'message' => 'Failed to update appointment status.']);
            }
        } else {
            // Return an error response for invalid input
            echo json_encode(['success' => false, 'message' => 'Invalid input.']);
        }
    } 

    public function autoUpdate() {
        $doctorID = $_SESSION['user_id'];
    
        // Get the current date and time
        $currentDateTime = new DateTime();
        $currentDate = $currentDateTime->format('Y-m-d');
        $currentTime = $currentDateTime->format('H:i:s');
    
        // Fetch all the appointments by doctorID
        $session = new DoctorSessionModel();
    
        // Fetch all sessions 
        $alldata = $session->getsession($doctorID);
       
        if (is_array($alldata)){
            // Insert old sessions into session history
            foreach ($alldata as $oldSession) {
                if ($oldSession->selectedDate <= $currentDate) {
                    $appointment = new AppointmentModel();
                    $appointmentDetails = $appointment->getAppointmentBySession($oldSession->sessionID);
                    
                    // Check if $appointmentDetails is valid
                    if (is_array($appointmentDetails) || is_object($appointmentDetails)) {
                        foreach ($appointmentDetails as $appointmentItem) {
                            // Add 2 hours to visitTime
                            $newVisitTime = date('H:i:s', strtotime($appointmentItem->visitTime) + 2 * 60 * 60);
        
                            // Check if the session time is less than the current time
                            if ($newVisitTime <= $currentTime) {
                                // Update the appointment status to 'cancelled'
                                $data = 'cancelled';
                                $updateresult = $appointment->updateAppointmentStatus($appointmentItem->appointmentID, $data);
                            }     
                        }
                    } else {
                        // Handle the case where no appointments are found
                        // You can log this or handle it as needed
                        error_log("No appointments found for session ID: " . $oldSession->sessionID);
                    }
                } 
            }   
        }
    }
}