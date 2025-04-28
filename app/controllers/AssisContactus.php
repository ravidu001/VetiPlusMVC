<?php

class AssisContactus extends Controller {
    public function index() {
        $this->view('assistant/assiscontactus');
    }

    public function insertData() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if ($_POST['type'] == 'Feedback') {
                $feedback = new systemfeedbackModel();

                $data = [
                    'name' => $_POST['name'],
                    'email' => $_POST['email'],
                    'contactNumber' => $_POST['contact'],
                    'comment' => $_POST['message'],
                    'rating' => $_POST['rate'],
                    'feedbackDateTime' => date('Y-m-d H:i:s'),
                    'respond' => '',
                    'status' => 0
                ];
                
                if (!$feedback->create($data)) {
                    $notification = new Notification();
                    $notification->show('Feedback submitted successfully!', 'success');
                   
                } else {
                    $notification = new Notification();
                    $notification->show('Failed to submit feedback!', 'error');
                  
                }
            } else {
                $complain = new systemcomplainModel();

                if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                    $originalFileName = $_FILES['image']['name'];
                    $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
                    $uniqueFileName = uniqid('complain_') . '.' . $fileExtension;
        
                    $uploadDirectory = '/Applications/XAMPP/xamppfiles/htdocs/VetiPlusMVC/public/assets/images/systemAdmin/complain/';
        
                    if (!is_dir($uploadDirectory)) {
                        mkdir($uploadDirectory, 0755, true);
                    }
        
                    $uploadPath = $uploadDirectory . $uniqueFileName;
        
                    if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
                        $data = [
                            'name' => $_POST['name'],
                            'email' => $_POST['email'],
                            'contactNumber' => $_POST['contact'],
                            'issue' => $_POST['message'],
                            'dateTime' => date('Y-m-d H:i:s'),
                            'status' => 0,
                            'image' => $uniqueFileName
                        ];
        
                        $result = $complain->create($data);
        
                        if (!$result) {
                            
                            $notification = new Notification();
                            $notification->show('Complain submitted successfully!', 'success');
                        } else {
                            unlink($uploadPath);
                            echo json_encode(['success' => false, 'message' => 'Failed to update profile picture in the database']);
                            $notification = new Notification();
                            $notification->show('Failed to upload complain image to the database!', 'error');
                        }
                    } else {
                        echo json_encode(['success' => false, 'message' => 'Failed to move uploaded file']);
                        $notification = new Notification();
                        $notification->show('Failed to move complain image to the database!', 'error');
                    }
                } else {
                    $data = [
                        'name' => $_POST['name'],
                        'email' => $_POST['email'],
                        'contactNumber' => $_POST['contact'],
                        'issue' => $_POST['message'],
                        'dateTime' => date('Y-m-d H:i:s'),
                        'status' => 0,
                        'image' => ''
                    ];
                   
                    if (!$complain->create($data)) {
                        $notification = new Notification();
                        $notification->show('Complain submitted successfully!', 'success');
                       
                    } else {
                        $notification = new Notification();
                        $notification->show('Failed to submit complain!', 'error');
                        
                    }
                }
            }
        }
    }
}