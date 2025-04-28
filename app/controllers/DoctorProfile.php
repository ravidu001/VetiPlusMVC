<?php

class DoctorProfile extends Controller {
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
        
        $doctorData = $this->showdata();
        // echo '<script>window.alert("'.$doctorData->timeSlot.'")</script>';
        // $this->view('vetDoctor/doctorprofile');
        $this->view('vetDoctor/doctorprofile', ['doctor' => $doctorData]);
    }

    public function showdata() {
        $doctor = new DoctorModel();
        $doctorID = $_SESSION['user_id'];

        // Debugging the doctorID
        // echo '<script>window.alert("'.$doctorID.'")</script>';

        $doctorData = $doctor->find($doctorID);

        if ($doctorData) {
            $_SESSION['profilePicture'] = $doctorData->profilePicture;
            // Debugging the fullName
            // echo '<script>window.alert("'.$doctorData->fullName.'")</script>';
            // echo '<script>window.alert("'.$doctorData->doctorCertificate.'")</script>';
        } else {
            echo '<script>window.alert("Doctor not found!")</script>';
        }

        return $doctorData;

        // Pass the data to the view if needed
        // $this->view('vetDoctor/doctorprofile', ['doctor' => $doctorData]);
    }

    public function updateProfile() {
        $doctor = new DoctorModel();
        $doctorID = $_SESSION['user_id'];
    
        // Check if the request is a POST request
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Check if a file was uploaded
            if (isset($_FILES['profilePicture']) && $_FILES['profilePicture']['error'] === UPLOAD_ERR_OK) {
                // Generate a unique filename
                $originalFileName = $_FILES['profilePicture']['name'];
                $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
                $uniqueFileName = uniqid('profile_') . '.' . $fileExtension;
    
                // Define the upload directory
                $uploadDirectory = __DIR__ . '/../../public/assets/images/vetDoctor/';
    
                // Ensure the directory exists
                if (!is_dir($uploadDirectory)) {
                    mkdir($uploadDirectory, 0755, true);
                }
    
                // Full path for the file
                $uploadPath = $uploadDirectory . $uniqueFileName;
    
                // Move the uploaded file
                if (move_uploaded_file($_FILES['profilePicture']['tmp_name'], $uploadPath)) {
                    // Prepare data for database update
                    $data = [
                        'profilePicture' => $uniqueFileName
                    ];
    
                    // Update the profile picture in the database
                    $result = $doctor->updateProfile($doctorID, $data);
    
                    if (empty($result)) {
                        echo json_encode([
                            'success' => true, 
                            'message' => 'Profile picture updated successfully',
                            'filename' => $uniqueFileName
                        ]);
                    } else {
                        // Remove the uploaded file if database update fails
                        unlink($uploadPath);
                        echo json_encode(['success' => false, 'message' => 'Failed to update profile picture in the database']);
                    }
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to move uploaded file']);
                }
            } else {
                // Handle file upload errors
                $errorMessage = 'No file uploaded';
                switch ($_FILES['profilePicture']['error']) {
                    case UPLOAD_ERR_INI_SIZE:
                        $errorMessage = 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
                        break;
                    case UPLOAD_ERR_FORM_SIZE:
                        $errorMessage = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
                        break;
                    case UPLOAD_ERR_PARTIAL:
                        $errorMessage = 'The uploaded file was only partially uploaded';
                        break;
                    case UPLOAD_ERR_NO_FILE:
                        $errorMessage = 'No file was uploaded';
                        break;
                    case UPLOAD_ERR_NO_TMP_DIR:
                        $errorMessage = 'Missing a temporary folder';
                        break;
                    case UPLOAD_ERR_CANT_WRITE:
                        $errorMessage = 'Failed to write file to disk';
                        break;
                    case UPLOAD_ERR_EXTENSION:
                        $errorMessage = 'File upload stopped by extension';
                        break;
                }
    
                echo json_encode(['success' => false, 'message' => $errorMessage]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid request method']);
        }
        // Redirect to the index page
        // header('Location: ' . ROOT . '/doctorProfile/index');
        exit;
    }

    public function removeProfile(){
        $doctor = new DoctorModel();
        $doctorID = $_SESSION['user_id'];

        // Inside updateProfile method
        if (isset($_POST['removeProfilePicture']) && $_POST['removeProfilePicture'] === 'true') {
            $data = [
                'profilePicture' => 'defaultProfile.png'
            ];

            $result = $doctor->updateProfile($doctorID, $data);

            if (empty($result)) {
                echo json_encode([
                    'success' => true, 
                    'message' => 'Profile picture reset to default'
                ]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to reset profile picture']);
            }
            // Redirect to the index page
            // header('Location: ' . ROOT . '/doctorProfile/index');
            exit;
        }
        
    }

    public function updatePersonal() {
        //echo "<script>window.alert('hello');</script>";
        // Assuming you have a model to handle database operations
        $doctor = new DoctorModel();
        $doctorID = $_SESSION['user_id'];
        // Get the form data from the POST request
        $data = [
            'fullName' => $_POST['fullName'] ?? '',
            'address' => $_POST['address'] ?? '',
            'DOB' => $_POST['DOB'] ?? '',
            'contactNumber' => $_POST['contactNumber'] ?? '',
            'gender' => $_POST['gender'] ?? '',
            
        ];
        // Validate the data (you can add more validation as needed)
        // $errors = $this->validate($data);

        // if (!empty($errors)) {
        //     echo json_encode(['success' => false, 'message' => 'Validation failed', 'errors' => $errors]);
        //     return;
        // }

        // Save the data using the model
        $result = $doctor->updateProfile($doctorID, $data);

        if (empty($result)) {
            echo json_encode(['success' => true, 'message' => 'Profile updated successfully']);
            return;
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update profile']);
            return;
        }
    }
    
    private function validate($data) {
        $errors = [];

        // Example validation rules
        if (empty($data['fullName'])) {
            $errors['fullName'] = 'Name is required';
        }
        if (empty($data['address'])) {
            $errors['address'] = 'Address is required';
        }
        if (empty($data['DOB'])) {
            $errors['DOB'] = 'Date of Birth is required';
        }
        if (empty($data['contactNumber']) || !preg_match('/^[0-9]{10}$/', $data['contactNumber'])) {
            $errors['contactNumber'] = 'Valid mobile number is required';
        }
        if (empty($data['gender'])) {
            $errors['gender'] = 'Gender is required';
        }

        return $errors;
    }

    public function updateProfessional() {
        //echo "<script>window.alert('hello');</script>";
        // Assuming you have a model to handle database operations
        $doctor = new DoctorModel();
        $doctorID = $_SESSION['user_id'];
        //echo '<script>window.alert("'.$doctorID.'");</script>';

        $data = [
            'lnumber' => $_POST['lnumber'] ?? '',
            'experience' => $_POST['experience'],
            'timeSlot' => $_POST['timeSlot'] ?? '',
            'specialization' => $_POST['specialization']
        ];

        // Save the data using the model
        $result = $doctor->updateProfile($doctorID, $data);

        if (empty($result)) {
            echo json_encode(['success' => true, 'message' => 'Profile updated successfully']);
            return;
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update profile']);
            return;
        }
    }

    public function updatePassword() {
        $doctor = new User();
        $doctorID = $_SESSION['user_id'];
        $doctorDetails = $doctor->checkLoginUser($doctorID);
    
        $currentPasswordHash = $doctorDetails->password;
    
        // Get the form data from the POST request
        $data = [
            'password' => $_POST['password'] ?? '',
            'newPassword' => $_POST['newPassword'] ?? '',
            'confirmPassword' => $_POST['confirmPassword'] ?? ''
        ];

        // Check if new password is strong
        if (!$this->isStrongPassword($data['newPassword'])) {
            echo json_encode(['success' => false, 'message' => 'New password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character.']);
            return;
        }

        if ($data['newPassword'] != $data['confirmPassword']) {
            echo json_encode(['success' => false, 'message' => 'Passwords do not match']);
            return;
        } else if (empty($data['newPassword']) || empty($data['confirmPassword'])) {
            echo json_encode(['success' => false, 'message' => 'Password cannot be empty']);
            return;
        } else if ($data['password'] == $data['newPassword']) {
            echo json_encode(['success' => false, 'message' => 'New password cannot be the same as the old password']);
            return;
        } else if (!password_verify($data['password'], $currentPasswordHash)) {
            echo json_encode(['success' => false, 'message' => 'Current password is incorrect']);
            return;
        } else {
            $newPasswordHash = password_hash($data['newPassword'], PASSWORD_DEFAULT);
            $result = $doctor->updatePassword($doctorID, $newPasswordHash);
            if (empty($result)) {
                echo json_encode(['success' => true, 'message' => 'Password updated successfully']);
                return;
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to update password']);
                return;
            }
        }
    }

    public function deleteAccount() {
        // Initialize the response array
        $response = [];
        
        // Check if the user is authenticated and has provided the correct password
        if (isset($_POST['password'])) {
            $password = $_POST['password'];
            
            // method to verify the password
            if ($this->verifyPassword($password)) {
                
                $deletionSuccessful = $this->deleteUserAccount(); // This should return true or false
                
                if ($deletionSuccessful) {
                    $response['success'] = true;
                    $response['message'] = 'Account deleted successfully.';
                } else {
                    $response['success'] = false;
                    $response['message'] = 'Error deleting account. Please try again.';
                }
            } else {
                $response['success'] = false;
                $response['message'] = 'Incorrect password. Please try again.';
            }
        } else {
            $response['success'] = false;
            $response['message'] = 'Password is required.';
        }
    
        // Set the content type to application/json
        header('Content-Type: application/json');
        echo json_encode($response);
        exit; // Ensure no further output is sent
    }

    // Function to check if the password is strong
    private function isStrongPassword($password) {
        // Regular expression to check for at least one uppercase letter, one lowercase letter, one number, one special character, and minimum length of 8
        return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password);
    }
    
    // Example method to verify the password
    private function verifyPassword($password) {
        $doctorID = $_SESSION['user_id'];
        $userModel = new User();
        $doctorData = $userModel->checkUser($doctorID);

        if($doctorData){
            $currentPasswordHash = $doctorData[0]->password;
            if(password_verify($password, $currentPasswordHash)) {
                return true;
            } else {
                return false;
            }
        }
    }
    
    // method to delete the user account
    private function deleteUserAccount() {
        $doctorID = $_SESSION['user_id'];
        $session = new DoctorSessionModel();
        $sessionData = $session->getsession($doctorID);

        if(is_array($sessionData)) {
            foreach ($sessionData as $sessionItem) {
                if ($sessionItem->completeStatus == 0) {
                    return false;
                } else {
                    $userModel = new User();
                    $doctorData = $userModel->checkUser($doctorID);

                    if ($doctorData) {
                        $status = 'deactive';

                        $result = $userModel->updateActiveStatus($doctorID, $status);

                        if(empty($result)) {
                            return true;
                        } else {
                            return false;
                        }
                    }
                    return false;
                }
            }
        } else {
            $userModel = new User();
            $doctorData = $userModel->checkUser($doctorID);

            if ($doctorData) {
                $status = 'deactive';

                $result = $userModel->updateActiveStatus($doctorID, $status);

                if(empty($result)) {
                    return true;
                } else {
                    return false;
                }
            }
            return false;
        }
    }
    
}
