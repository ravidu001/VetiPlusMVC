<?php

class AssisAccepted extends Controller {
    public function index() {
        // Check if the user is logged in
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . ROOT . '/login');
            exit;
        }

        // Get user_id
        $assis_id = $_SESSION['user_id'];
        // print_r($assis_id);

        // Get all the assistants' sessions
        $assisSession = new AssistantSessionModel();
        $assisSessionData = $assisSession->getSessionByAssistant($assis_id);
        // show($assisSessionData);

        $consolidatedData = [];

        foreach ($assisSessionData as $assisSessionItem) {
            if ($assisSessionItem->action == 'accept') {
                $session = new DoctorSessionModel();
                $sessionData = $session->getsessionBySession($assisSessionItem->sessionID);

                foreach ($sessionData as $sessionItem) {
                    // check session is a future session
                    $endTime = new DateTime($sessionItem->endTime); // Create a DateTime object for the session start time
                    $currentTime = new DateTime(); // Get the current time
                    if ($sessionItem->selectedDate == date('Y-m-d')) {
                        if ($endTime >= $currentTime) {
                            $doctor = new DoctorModel();
                            $doctorData = $doctor->find($sessionItem->doctorID);
                            $consolidatedData[] = [
                                'doctor' => $doctorData,
                                'session' => $sessionItem,
                                'assisSession' => $assisSessionItem
                            ];
                        }   
                    } elseif ($sessionItem->selectedDate > date('Y-m-d') ){
                        $doctor = new DoctorModel();
                        $doctorData = $doctor->find($sessionItem->doctorID);
                        $consolidatedData[] = [
                            'doctor' => $doctorData,
                            'session' => $sessionItem,
                            'assisSession' => $assisSessionItem
                        ];
                    }
                }
            }
        }
        // show($consolidatedData);

        $this->view('assistant/assisaccepted', ['consolidatedData' => $consolidatedData]);
    }

    public function reject() {
        // Create an instance of the Notification controller
        $notification = new Notification();
    
        if (isset($_GET['sessionID']) && isset($_GET['assistantID']) && isset($_GET['selectedDate'])) {
            $sessionID = $_GET['sessionID'];
            $assistantID = $_GET['assistantID'];
            $selectedDate = $_GET['selectedDate'];

            show($assistantID);
    
            // Get the current date and subtract one day
            $currentDate = new DateTime();
            $currentDate->modify('-1 day'); // Subtract one day
            $selectedDateObj = new DateTime($selectedDate); // Convert selectedDate to a DateTime object
    
            // Check if the selectedDate is valid for rejection
            if ($selectedDateObj >= $currentDate) {
                // Update the assistant session
                $assistantSessionModel = new AssistantSessionModel();
                $data = [
                    'action' => 'reject'
                ];
    
                // Call a method that can handle updating with composite keys
                $success = $assistantSessionModel->updateWithCompositeKey($sessionID, $assistantID, $data);
    
                // Prepare the message based on the success of the operation
                if ($success) {
                    $notification->show("Session rejected successfully!", 'success');
                } else {
                    $notification->show("Failed to reject the session.", 'error');
                }
            } else {
                // Show an error message if the rejection is not allowed
                $notification->show("Reject session is only allowed up to one day before the session date.", 'error');
            }
        } else {
            $notification->show("Invalid request.", 'error');
        }
    }
    
}
