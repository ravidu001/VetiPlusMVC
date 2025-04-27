<?php

class AssisRequestHistory extends Controller {
    public function index() {
        // Check if the user is logged in
        if (!isset($_SESSION['assis_id'])) {
            header('Location: ' . ROOT . '/login');
            exit;
        }

        // Get user_id
        $assis_id = $_SESSION['assis_id'];
        // print_r($assis_id);

        // Get all the assistants' sessions
        $assisSession = new AssistantSessionModel();
        $assisSessionData = $assisSession->getSessionByAssistant($assis_id);
        // show($assisSessionData);

        $consolidatedData = [];

        if(is_array($assisSessionData)) {
            foreach ($assisSessionData as $assisSessionItem) {
                if ($assisSessionItem->action != 'pending') {
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

        $this->view('assistant/assisrequesthistory', ['consolidatedData' => $consolidatedData]);
    }
}
