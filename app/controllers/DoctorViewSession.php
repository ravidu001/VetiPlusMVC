<?php

class DoctorViewSession extends Controller {
    public function index() {
        $doctorID = $_SESSION['user_id'];
        $session = new DoctorSessionModel;

        $update = $this->inserthistory();
    
        // Get all sessions for the doctor
        $sessionData = $session->getsession($doctorID);
    
        // Initialize an array to hold consolidated session data
        $consolidatedSessions = [];
    
        // Iterate over each session to get assistant session data
        foreach ($sessionData as $sessionItem) {
            if($sessionItem->completeStatus == 1) {
                continue;
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
                'assistants' => $sessionAssistants
            ];
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

        $this->view('vetDoctor/doctorsessionview', ['sessionsDetails' => $consolidatedSessions]);
    }
}