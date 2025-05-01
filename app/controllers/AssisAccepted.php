<?php

class AssisAccepted extends Controller {
    public function index() {
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

        // Get user_id

        $assis_id = $_SESSION['assis_id'];

        $assisSession = new AssistantSessionModel();
        $assisSessionData = $assisSession->getSessionByAssistant($assis_id);

        $consolidatedData = [];

        if(is_array($assisSessionData)) {
            foreach ($assisSessionData as $assisSessionItem) {
                if ($assisSessionItem->action == 'accept') {
                    $session = new DoctorSessionModel();
                    $sessionData = $session->getsessionBySession($assisSessionItem->sessionID);
    
                    foreach ($sessionData as $sessionItem) {
                        $endTime = new DateTime($sessionItem->endTime); 
                        $currentTime = new DateTime(); 
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

        }

        $this->view('assistant/assisaccepted', ['consolidatedData' => $consolidatedData]);
    }

    public function reject() {
        $notification = new Notification();
    
        if (isset($_GET['sessionID']) && isset($_GET['assistantID']) && isset($_GET['selectedDate'])) {
            $sessionID = $_GET['sessionID'];
            $assistantID = $_GET['assistantID'];
            $selectedDate = $_GET['selectedDate'];

    
            $currentDate = new DateTime();
            $currentDate->modify('-1 day'); 
            $selectedDateObj = new DateTime($selectedDate); 
    
            if ($selectedDateObj >= $currentDate) {
                $assistantSessionModel = new AssistantSessionModel();
                $data = [
                    'action' => 'reject'
                ];
    
                $success = $assistantSessionModel->updateWithCompositeKey($sessionID, $assistantID, $data);
    
                if ($success) {
                    $notification->show("Session rejected successfully!", 'success');
                } else {
                    $notification->show("Failed to reject the session.", 'error');
                }
            } else {
                $notification->show("Reject session is only allowed up to one day before the session date.", 'error');
            }
        } else {
            $notification->show("Invalid request.", 'error');
        }
    }
    
}
