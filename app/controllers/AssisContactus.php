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

                // check if contact number is valid
                if (!preg_match('/^\d{10}$/', $data['contactNumber'])) {
                    $notification = new Notification();
                    $notification->show('Invalid contact number format!', 'error');
                    exit();
                }

                // check if comment is empty
                if (empty($data['comment'])) {
                    $notification = new Notification();
                    $notification->show('Comment cannot be empty!', 'error');
                    return;
                }

                // check if rating is valid
                if (!in_array($data['rating'], [1, 2, 3, 4, 5])) {
                    $notification = new Notification();
                    $notification->show('Invalid rating value!', 'error');
                    return;
                }

                // checkif name is empty
                if (empty($data['name'])) {
                    $notification = new Notification();
                    $notification->show('Name cannot be empty!', 'error');
                    return;
                }

                // check if email is empty
                if (empty($data['email'])) {
                    $notification = new Notification();
                    $notification->show('Email cannot be empty!', 'error');
                    return;
                }

                
                if (!$feedback->create($data)) {
                    $notification = new Notification();
                    $notification->show('Feedback submitted successfully!', 'success');
                    //echo "<script>alert('Feedback submitted successfully!');</script>";
                    //$this->view('assistant/assiscontactus');
                } else {
                    $notification = new Notification();
                    $notification->show('Failed to submit feedback!', 'error');
                    //echo "<script>alert('Failed to submit feedback!');</script>";
                    //$this->view('assistant/assiscontactus');
                }
            } else {
                $complain = new systemcomplainModel();

                if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                    // Generate a unique filename
                    $originalFileName = $_FILES['image']['name'];
                    $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
                    $uniqueFileName = uniqid('complain_') . '.' . $fileExtension;
        
                    // Define the upload directory
                    $uploadDirectory = '/Applications/XAMPP/xamppfiles/htdocs/VetiPlusMVC/public/assets/images/systemAdmin/complain/';
        
                    // Ensure the directory exists
                    if (!is_dir($uploadDirectory)) {
                        mkdir($uploadDirectory, 0755, true);
                    }
        
                    // Full path for the file
                    $uploadPath = $uploadDirectory . $uniqueFileName;
        
                    // Move the uploaded file
                    if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
                        // Prepare data for database insert
                        $data = [
                            'name' => $_POST['name'],
                            'email' => $_POST['email'],
                            'contactNumber' => $_POST['contact'],
                            'issue' => $_POST['message'],
                            'dateTime' => date('Y-m-d H:i:s'),
                            'status' => 0,
                            'image' => $uniqueFileName
                        ];

                        // check if contact number is valid
                        if (!preg_match('/^\d{10}$/', $data['contactNumber'])) {
                            $notification = new Notification();
                            $notification->show('Invalid contact number format!', 'error');
                            exit();
                        }
        
                        // insert data in to the database
                        $result = $complain->create($data);
        
                        if (!$result) {
                            // echo json_encode([
                            //     'success' => true, 
                            //     'message' => 'Complain submitted successfully!',
                            //     'filename' => $uniqueFileName
                            // ]);
                            // echo "<script>alert('Complain submitted successfully!');</script>";
                            $notification = new Notification();
                            $notification->show('Complain submitted successfully!', 'success');
                            // $this->view('assistant/assiscontactus');
                        } else {
                            // Remove the uploaded file if database update fails
                            unlink($uploadPath);
                            echo json_encode(['success' => false, 'message' => 'Failed to update profile picture in the database']);
                            // echo "<script>alert('Failed to upload complain image to the database!');</script>";
                            $notification = new Notification();
                            $notification->show('Failed to upload complain image to the database!', 'error');
                            //$this->view('assistant/assiscontactus');
                        }
                    } else {
                        echo json_encode(['success' => false, 'message' => 'Failed to move uploaded file']);
                        // echo "<script>alert('Failed to move complain image to the database!');</script>";
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

                    // check if contact number is valid
                    if (!preg_match('/^\d{10}$/', $data['contactNumber'])) {
                        $notification = new Notification();
                        $notification->show('Invalid contact number format!', 'error');
                        exit();
                    }
                   
                    if (!$complain->create($data)) {
                        $notification = new Notification();
                        $notification->show('Complain submitted successfully!', 'success');
                        // echo "<script>alert('Complain submitted successfully!');</script>";
                        // $this->view('assistant/assiscontactus');
                    } else {
                        $notification = new Notification();
                        $notification->show('Failed to submit complain!', 'error');
                        //echo "<script>alert('Failed to submit complain!');</script>";
                        //$this->view('assistant/assiscontactus');
                    }
                }
            }
        }
    }
}