<?php

class DoctorContactus extends Controller {
    public function index() {
        // Check if the user is logged in
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . ROOT . '/login');
            $notification = new Notification();
            $_SESSION['notification'] = [
                'message' => 'You are not authorized to access this page.',
                'type' => 'error',
            ];
            exit;
        }

        if ($_SESSION['type'] != 'Vet Doctor') {
            header('Location: ' . ROOT . '/login');
            $notification = new Notification();
            $_SESSION['notification'] = [
                'message' => 'You are not authorized to access this page.',
                'type' => 'error',
            ];
            exit;
        }
        
        $this->view('vetDoctor/doctorcontactus');
    }

    public function insertData() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if ($_POST['type'] == 'Feedback') {
                $feedback = new systemfeedbackModel();

                // check contact number is valid
                if (!preg_match('/^\d{10}$/', $_POST['contact'])) {
                    $notification = new Notification();
                    $notification->show('Invalid contact number!', 'error');
                    return;
                }

                // check rating is not empty
                if (empty($_POST['rate'])) {
                    $notification = new Notification();
                    $notification->show('Please select a rating!', 'error');
                    return;
                }

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
                    // echo "<script>alert('Feedback submitted successfully!');</script>";
                    //$this->view('vetDoctor/doctorcontactus');
                } else {
                    $notification = new Notification();
                    $notification->show('Failed to submit feedback!', 'error');
                    // echo "<script>alert('Failed to submit feedback!');</script>";
                    //$this->view('vetDoctor/doctorcontactus');
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
        
                        // insert data in to the database
                        $result = $complain->create($data);
        
                        if (!$result) {
                            echo json_encode([
                                'success' => true, 
                                'message' => 'Complain submitted successfully!',
                                'filename' => $uniqueFileName
                            ]);
                            $notification = new Notification();
                            $notification->show('Complain submitted successfully!', 'success');
                            // echo "<script>alert('Complain submitted successfully!');</script>";
                            //$this->view('vetDoctor/doctorcontactus');
                        } else {
                            // Remove the uploaded file if database update fails
                            unlink($uploadPath);
                            echo json_encode(['success' => false, 'message' => 'Failed to update profile picture in the database']);
                            // echo "<script>alert('Failed to upload complain image to the database!');</script>";
                            $this->view('vetDoctor/doctorcontactus');
                        }
                    } else {
                        $notification = new Notification();
                        $notification->show('Failed to move uploaded file!', 'error');
                        //echo json_encode(['success' => false, 'message' => 'Failed to move uploaded file']);
                        // echo "<script>alert('Failed to move complain image to the database!');</script>";
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
                        $notification = new notification();
                        $notification->show('Complain submitted successfully!', 'success');
                        //echo "<script>alert('Complain submitted successfully!');</script>";
                        //$this->view('vetDoctor/doctorcontactus');
                    } else {
                        $notification = new notification();
                        $notification->show('Failed to submit complain!', 'error');
                        //echo "<script>alert('Failed to submit complain!');</script>";
                        // $this->view('vetDoctor/doctorcontactus');
                    }
                }
            }
        }
    }
}