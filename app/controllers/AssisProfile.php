<?php

class AssisProfile extends Controller {
    public function index() {
        list($assisData, $languageSpoken) = $this->showdata();
        $this->view('assistant/assisprofile', ['assis' => $assisData, 'languageSpoken' => $languageSpoken]);
    }

    public function showdata() {
        $assis = new AssisModel();
        $assistantID = $_SESSION['user_id'];

        $assisData = $assis->find($assistantID);
        if ($assisData) {
            $_SESSION['profilePicture'] = $assisData->profilePicture;
            $languageSpoken = unserialize($assisData->languageSpoken);
        } else {
            echo '<script>window.alert("Assistant not found!")</script>';
            $languageSpoken = [];
        }

        return [$assisData, $languageSpoken];
    }

    public function updateProfile() {
        $assis = new AssisModel();
        $assistantID = $_SESSION['user_id'];
    
        // Check if the request is a POST request
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Check if a file was uploaded
            if (isset($_FILES['profilePicture']) && $_FILES['profilePicture']['error'] === UPLOAD_ERR_OK) {
                // Generate a unique filename
                $originalFileName = $_FILES['profilePicture']['name'];
                $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
                $uniqueFileName = uniqid('profile_') . '.' . $fileExtension;
    
                // Define the upload directory
                $uploadDirectory = __DIR__ . '/../../public/assets/images/vetAssistant/';
    
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
                    $result = $assis->updateProfile($assistantID, $data);
    
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
    }

    public function removeProfile(){
        $assis = new AssisModel();
        $assistantID = $_SESSION['user_id'];

        // Inside updateProfile method
        if (isset($_POST['removeProfilePicture']) && $_POST['removeProfilePicture'] === 'true') {
            $data = [
                'profilePicture' => 'defaultProfile.png'
            ];

            $result = $assis->updateProfile($assistantID, $data);

            if (empty($result)) {
                echo json_encode([
                    'success' => true, 
                    'message' => 'Profile picture reset to default'
                ]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to reset profile picture']);
            }
            exit;
        }
    
    }

    public function updatePersonal() {
        $assis = new AssisModel();
        $assistantID = $_SESSION['user_id'];
        $data = [
            'fullName' => $_POST['fullName'] ?? '',
            'address' => $_POST['address'] ?? '',
            'DOB' => $_POST['DOB'] ?? '',
            'contactNumber' => $_POST['contactNumber'] ?? '',
            'address' => $_POST['address'] ?? '',
            'district' => $_POST['district'] ?? '',
            'bio' => $_POST['bio'] ?? '',
            'gender' => $_POST['gender'] ?? ''
        ];

        $result = $assis->updateProfile($assistantID, $data);

        if (empty($result)) {
            echo json_encode(['success' => true, 'message' => 'Profile updated successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Profile update failed']);
        }
    }

    public function updateProfessional() {
        $assis = new AssisModel();
        $assistantID = $_SESSION['user_id'];
    
        // Retrieve languages from POST data
        $languages = $_POST['languageSpoken'] ?? [];
    
        // Ensure languages is an array and filter out any empty values
        $languages = is_array($languages) ? array_filter($languages) : [];

    
        $data = [
            'certificateNumber' => $_POST['certificateNumber'] ?? '',
            'expertise' => $_POST['expertise'] ?? '',
            'experience' => $_POST['experience'] ?? '',
            'chargePerHour' => $_POST['chargePerHour'] ?? '',
            'languageSpoken' => serialize($languages)
        ];
    
        try {
            // Perform the update
            $assis->updateProfile($assistantID, $data);
    
            echo json_encode([
                'success' => true, 
                'message' => 'Professional details updated successfully',
                'languages' => $languages // Optional: send back the languages for verification
            ]);
        } catch (Exception $e) {
            echo json_encode([
                'success' => false, 
                'message' => 'Failed to update professional details: ' . $e->getMessage()
            ]);
        }
    }

    public function updatePassword() {
        $assis = new User();
        $assistantID = $_SESSION['user_id'];
        $assisDetails = $assis->checkLoginUser($assistantID);
    
        $currentPasswordHash = $assisDetails->password;
    
        // Get the form data from the POST request
        $data = [
            'password' => $_POST['password'] ?? '',
            'newPassword' => $_POST['newPassword'] ?? '',
            'confirmPassword' => $_POST['confirmPassword'] ?? ''
        ];
    
        // Validation
        if (empty($data['password']) || empty($data['newPassword']) || empty($data['confirmPassword'])) {
            echo json_encode(['success' => false, 'message' => 'All password fields are required']);
            return;
        }
    
        if ($data['newPassword'] !== $data['confirmPassword']) {
            echo json_encode(['success' => false, 'message' => 'New passwords do not match']);
            return;
        }
    
        if (strlen($data['newPassword']) < 8) {
            echo json_encode(['success' => false, 'message' => 'New password must be at least 8 characters long']);
            return;
        }
    
        if (!password_verify($data['password'], $currentPasswordHash)) {
            echo json_encode(['success' => false, 'message' => 'Current password is incorrect']);
            return;
        }
    
        if ($data['password'] === $data['newPassword']) {
            echo json_encode(['success' => false, 'message' => 'New password cannot be the same as the current password']);
            return;
        }
    
        // Hash the new password
        $newPasswordHash = password_hash($data['newPassword'], PASSWORD_DEFAULT);
    
        // Update password
        try {
            $result = $assis->updatePassword($assistantID, $newPasswordHash);
            
            if ($result) {
                echo json_encode(['success' => true, 'message' => 'Password updated successfully']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to update password']);
            }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    
}
