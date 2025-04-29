<?php

class AssisRequest extends Controller {
    public function index() {
        // Check if the user is logged in
        if (!isset($_SESSION['assis_id'])) {
            header('Location: ' . ROOT . '/login');
            $notification = new Notification();
            $_SESSION['notification'] = [
                'message' => 'You are not authorized to access this page.',
                'type' => 'error',
            ];
            exit;
        }

        // if ($_SESSION['type'] != 'Vet Assistant') {
        //     header('Location: ' . ROOT . '/login');
        //     $notification = new Notification();
        //     $_SESSION['notification'] = [
        //         'message' => 'You are not authorized to access this page.',
        //         'type' => 'error',
        //     ];
        //     exit;
        // }

        // change the action into expired if assiant not select any option(accept or reject) before the session
        $this->autoExpiredRequest();

        // Get user_id
        $assis_id = $_SESSION['assis_id'];
        // print_r($assis_id);

        // Get all the assistants' sessions
        $assisSession = new AssistantSessionModel();
        $assisSessionData = $assisSession->getSessionByAssistant($assis_id);
        // show($assisSessionData);

        $consolidatedData = [];

        if(is_array($assisSessionData)){
            foreach ($assisSessionData as $assisSessionItem) {
                if ($assisSessionItem->action == 'pending') {
                    $session = new DoctorSessionModel();
                    $sessionData = $session->getsessionBySession($assisSessionItem->sessionID);
    
                    foreach ($sessionData as $sessionItem) {
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

        $this->view('assistant/assisrequest', ['consolidatedData' => $consolidatedData]);
    }

    public function accept() {
        // Create an instance of the Notification controller
        $notification = new Notification();

        if (isset($_GET['sessionID']) && isset($_GET['assistantID'])) {
            $sessionID = $_GET['sessionID'];
            $assistantID = $_GET['assistantID'];

            // show($assistantID);

            // Update the assistant session
            $assistantSessionModel = new AssistantSessionModel();
            $data = [
                'action' => 'accept'
            ];
            
            // Call a method that can handle updating with composite keys
            $success = $assistantSessionModel->updateWithCompositeKey($sessionID, $assistantID, $data);

            // Prepare the message based on the success of the operation
            if ($success) {
                $notification->show("Session accepted successfully!", 'success');
            } else {
                $notification->show("Failed to accept the session.", 'error');
            }
        } else {
            $notification->show("Invalid request.", 'error');
        }
    }

    public function reject() {
        // Create an instance of the Notification controller
        $notification = new Notification();

        if (isset($_GET['sessionID']) && isset($_GET['assistantID'])) {
            $sessionID = $_GET['sessionID'];
            $assistantID = $_GET['assistantID'];

            // show($assistantID);

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
            $notification->show("Invalid request.", 'error');
        }
    }

    public function autoExpiredRequest() {
        // Get user_id
        $assis_id = $_SESSION['assis_id'];
        // print_r($assis_id);

        // Get all the assistants' sessions
        $assisSession = new AssistantSessionModel();
        $assisSessionData = $assisSession->getSessionByAssistant($assis_id);
        // show($assisSessionData);
        if(is_array($assisSessionData)){
            foreach ($assisSessionData as $assisSessionItem) {
                if ($assisSessionItem->action == 'pending') {
                    $session = new DoctorSessionModel();
                    $sessionData = $session->getsessionBySession($assisSessionItem->sessionID);
                    
                    foreach($sessionData as $sessionItem)
                    $startTime = new DateTime($sessionItem->startTime); // Create a DateTime object for the session start time
                    $startTime->modify('-2 hours'); // Deduct 2 hours from the start time
                    $currentTime = new DateTime(); // Get the current time
                    
                    if ($sessionItem->selectedDate == date('Y-m-d')) {
                        if ($startTime <= $currentTime) {
                            $data = [
                                'action' => 'expired'
                            ];
                            $assisSession->updateWithCompositeKey($assisSessionItem->sessionID, $assis_id, $data);
                        }   
                    } elseif ($sessionItem->selectedDate < date('Y-m-d') ){
                        $data = [
                            'action' => 'expired'
                        ];
                        $assisSession->updateWithCompositeKey($assisSessionItem->sessionID, $assis_id, $data);
                    }
                }
            }
        }
    }


}
