<?php

class DoctorViewSession extends Controller {
    public function index() {
        $doctorID = $_SESSION['user_id'];
        $session = new DoctorSessionModel;
    
        // Get all sessions for the doctor
        $sessionData = $session->getsession($doctorID);
    
        // Initialize an array to hold consolidated session data
        $consolidatedSessions = [];
    
        // Iterate over each session to get assistant session data
        foreach ($sessionData as $sessionItem) {
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
                'assistants' => $sessionAssistants
            ];
        }
    
        // Pass the consolidated session data to the view
        $this->view('vetDoctor/doctorviewsession', ['sessions' => $consolidatedSessions]);
    }

    public function session() {
        $this->view('vetDoctor/doctorsessionview');
    }
}