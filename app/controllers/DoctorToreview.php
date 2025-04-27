<?php
class DoctorToreview extends Controller {
    public function index() {
        // Initialize data arrays for pending and completed reviews
        $data['pendingReviews'] = [];
        $data['completedReviews'] = [];
        
        // Get current doctor ID from session
        $doctorID = $_SESSION['user_id'];
        
        // Get all sessions for this doctor
        $sessionModel = new DoctorSessionModel();
        $sessions = $sessionModel->getsession($doctorID);
        
        // Process each session
        if (is_array($sessions) || is_object($sessions)) {
            foreach ($sessions as $session) {
                // Only consider completed sessions
                if ($session->completeStatus == 1) {
                    $assistantSessionModel = new AssistantSessionModel();
                    $assistantSessions = $assistantSessionModel->getAssistantsession($session->sessionID);
                    
                    // Check if we got valid results (array/object) before trying to iterate
                    if (is_array($assistantSessions) || is_object($assistantSessions)) {
                        // Process each assistant session
                        foreach ($assistantSessions as $assistantSession) {
                            // Get assistant details
                            $assistantModel = new AssisModel();
                            $assistant = $assistantModel->getAssistant($assistantSession->assistantID);
                           
                            if (!$assistant) {
                                continue; // Skip if assistant not found
                            }
                            
                            // Create review data array
                            $reviewData = [
                                'sessionID' => $session->sessionID,
                                'assistantSessionID' => $assistantSession->sessionID ?? 0,
                                'assistantID' => $assistantSession->assistantID ?? 0,
                                'assistantName' => $assistant->fullName,
                                'assistantProfileImage' => $assistant->profilePicture ?? 'https://randomuser.me/api/portraits/women/50.jpg',
                                'sessionDate' => date('M d, Y', strtotime($session->selectedDate)),
                                'location' => $session->clinicLocation . ', ' . $session->district,
                                'time' => date('g:i A', strtotime($session->startTime)) . ' - ' . date('g:i A', strtotime($session->endTime)),
                            ];
                            
                            // Add to pending or completed reviews based on status
                            if ($assistantSession->status == 0) {
                                // Status 0 means pending review
                                $data['pendingReviews'][] = $reviewData;
                            } else {
                                // Add review details for completed reviews
                                $reviewData['comment'] = $assistantSession->comment ?? '';
                                $reviewData['rating'] = $assistantSession->rating ?? 0;
                                $reviewData['reviewDate'] = $assistantSession->dateTime ?? '';
                                
                                $data['completedReviews'][] = $reviewData;
                            }
                        }
                    }
                }
            }
        }
        
        // Load the view with the processed data
        $this->view('vetDoctor/doctortoreview', $data);
    }
    
    public function submitReview() {
        // Process form submission for reviews
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $notification = new Notification();
            if (!isset($_POST['rate']) || empty($_POST['rate'])) {
                // Handle case where no rating is provided
                $notification->show('Please rate the assistant.', 'error');
                exit();
            }
            if (!isset($_POST['feedback']) || empty($_POST['feedback'])) {
                // Handle case where no feedback is provided
                $notification->show('Please provide feedback.', 'error');
                exit();
            }
            $sessionID = $_POST['sessionID'] ?? 0;
            $assistantID = $_POST['assistantID'] ?? 0;
            $rating = $_POST['rate'] ?? 0;
            $comment = $_POST['feedback'] ?? '';
            
            // Update the assistant session
            $assistantSessionModel = new AssistantSessionModel();
            $data = [
                'status' => 1, // Mark as reviewed
                'comment' => $comment,
                'rating' => $rating,
                'feedbackDateTime' => date('Y-m-d H:i:s')
            ];
            
            try {
                // Call a method that can handle updating with composite keys
                $success = $assistantSessionModel->updateWithCompositeKey($sessionID, $assistantID, $data);
                
                // Return JSON response with redirect URL for AJAX
                echo json_encode([
                    'success' => $success,
                    'redirectUrl' => ROOT . "/DoctorToreview"
                ]);
            } catch (Exception $e) {
                // Handle errors
                echo json_encode([
                    'success' => false,
                    'message' => 'Database error: ' . $e->getMessage()
                ]);
            }
            exit();
        }
    }
    
    public function deleteReview() {
        // Process review deletion
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $sessionID = $_POST['sessionID'] ?? 0;
            $assistantID = $_POST['assistantID'] ?? 0;
         
            // Reset the review status
            $assistantSessionModel = new AssistantSessionModel();
            $data = [
                'status' => 0, // Mark as pending
                'comment' => '',
                'rating' => 0,
                'feedbackDateTime' => date('Y-m-d H:i:s')
            ];
            
            // Update the record
            $assistantSessionModel->updateWithCompositeKey($sessionID, $assistantID, $data);
            
            // Return success response for AJAX
            echo json_encode(['success' => true]);
            exit();
        }
    }
}