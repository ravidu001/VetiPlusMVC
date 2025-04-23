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
                    echo "<script>alert('Feedback submitted successfully!');</script>";
                    $this->view('assistant/assiscontactus');
                } else {
                    echo "<script>alert('Failed to submit feedback!');</script>";
                    $this->view('assistant/assiscontactus');
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
                            echo "<script>alert('Complain submitted successfully!');</script>";
                            $this->view('assistant/assiscontactus');
                        } else {
                            // Remove the uploaded file if database update fails
                            unlink($uploadPath);
                            echo json_encode(['success' => false, 'message' => 'Failed to update profile picture in the database']);
                            echo "<script>alert('Failed to upload complain image to the database!');</script>";
                            $this->view('assistant/assiscontactus');
                        }
                    } else {
                        echo json_encode(['success' => false, 'message' => 'Failed to move uploaded file']);
                        echo "<script>alert('Failed to move complain image to the database!');</script>";
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
                        echo "<script>alert('Complain submitted successfully!');</script>";
                        $this->view('assistant/assiscontactus');
                    } else {
                        echo "<script>alert('Failed to submit complain!');</script>";
                        $this->view('assistant/assiscontactus');
                    }
                }
            }
        }
    }
}