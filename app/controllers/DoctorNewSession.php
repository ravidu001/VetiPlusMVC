<?php

class DoctorNewSession extends Controller {
    public function index() {
        $this->view('vetDoctor/doctornewsession');
    }

    public function createSession() {
        $doctorID = $_SESSION['user_id'];
        $session = new DoctorSessionModel();
    
        $selectedDate = $_POST['selectedDate'];
        $dateTime = DateTime::createFromFormat('D M d Y', $selectedDate);
        $formattedDate = $dateTime->format('Y-m-d'); // Convert to 'YYYY-MM-DD'
    
        // Format the start and end time to only include hours and minutes
        $startTime = new DateTime($_POST['startTime']);
        $endTime = new DateTime($_POST['endTime']);
        $formattedStartTime = $startTime->format('H:i:s'); // Format to 'HH:MM:SS'
        $formattedEndTime = $endTime->format('H:i:s'); // Format to 'HH:MM:SS'
    
        $data = [
            'selectedDate' => $formattedDate,
            'startTime' => $formattedStartTime,
            'endTime' => $formattedEndTime,
            'clinicLocation' => $_POST['clinicLocation'],
            'district' => $_POST['district'],
            'doctorID' => $doctorID,
            'note' => '',
            'publishedTime' => date('Y-m-d H:i:s'),
            'completeStatus' => 0,
        ];
    
        try {
            $insertResult = $session->insertData($data);
    
            if (empty($insertResult)) {
                $sessionID = $session->lastID();
    
                if ($this->assitantadd($sessionID, $_POST['assistantIDs'])){
                    echo json_encode([
                        'success' => true, 
                        'message' => 'Session created successfully'
                    ]);
                } else {
                    echo json_encode([
                        'success' => false, 
                        'message' => 'Failed to add assistant to the session'
                    ]);
                }
            } else {
                echo json_encode([
                    'success' => false, 
                    'message' => 'Failed to create session'
                ]);
            }
        } catch (Exception $e) {
            echo json_encode([
                'success' => false, 
                'message' => 'An unexpected error occurred: ' . $e->getMessage()
            ]);
        }
        // $this->view('vetDoctor/doctornewsession');
        exit;
    }
    
    public function assitantadd($sessionID, $assistantIDs){
        $AssisSession = new AssistantSessionModel();
        // echo $assistantIDs;
        
        // Decode JSON string to array
        $assistantIDs = json_decode($assistantIDs);
        $result = true;
    
        foreach ($assistantIDs as $assistantID) {
            $assistantID = trim($assistantID);
            $data = [
                'sessionID' => $sessionID,
                'assistantID' => $assistantID,
                'comment' => '',
                'rating' => 0,
                'status' => 0,
                'dateTime' => date('Y-m-d H:i:s'),
            ];
    
            $insertResult = $AssisSession->insertData($data);
    
            if ($insertResult) {
                $result = true;
                break;
            }
        }
    
        return $result;
    }

    // used in new session page to filter assistants by district
    public function getAssistantsByDistrict() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['district'])) {
            $district = $_GET['district'];
            $assis = new AssisModel();
            $assistants = $assis->getAssistantsByDistrict($district);

            if ($assistants) {
                echo json_encode(['success' => true, 'assistants' => $assistants]);
            } else {
                echo json_encode(['success' => false, 'message' => 'No assistants found']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid request']);
        }
    }
}