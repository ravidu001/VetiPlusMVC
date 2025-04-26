<?php

class AssisRegistration extends Controller {
    public function index() {
        $this->view('assistant/assisregistration');
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Initialize an array to hold error messages
            $_SESSION['errors'] = [];
    
            // Validate required fields
            if (empty($_POST['fullName'])) {
                $_SESSION['errors'][] = "Full name is required.";
            }
            if (empty($_POST['mobile'])) {
                $_SESSION['errors'][] = "Mobile number is required.";
            }
            if (empty($_POST['address'])) {
                $_SESSION['errors'][] = "Address is required.";
            }
            if (empty($_POST['DOB'])) {
                $_SESSION['errors'][] = "Date of birth is required.";
            }
            if (empty($_POST['gender'])) {
                $_SESSION['errors'][] = "Gender is required.";
            }
            if (empty($_POST['district'])) {
                $_SESSION['errors'][] = "District is required.";
            }
            if (empty($_POST['bio'])) {
                $_SESSION['errors'][] = "Bio is required.";
            }
            if (empty($_POST['certificateNumber'])) {
                $_SESSION['errors'][] = "Certificate number is required.";
            }
            if (empty($_POST['expertise'])) {
                $_SESSION['errors'][] = "Expertise is required.";
            }
            if (empty($_POST['experience'])) {
                $_SESSION['errors'][] = "Experience is required.";
            }
            if (empty($_POST['chargePerHour'])) {
                $_SESSION['errors'][] = "Charge per hour is required.";
            }
    
            // Validate and process the uploaded file
            if (isset($_FILES['certificate']) && $_FILES['certificate']['error'] === UPLOAD_ERR_OK) {
                $assistantCertificate = $_FILES['certificate']['name'];
                $assistantCertificate_tmp_name = $_FILES['certificate']['tmp_name'];
                $upload_dir = 'assets/images/vetAssistant/';
                if (!is_dir($upload_dir)) {
                    $_SESSION['errors'][] = "Upload directory does not exist.";
                } else {
                    if (!move_uploaded_file($assistantCertificate_tmp_name, $upload_dir . $assistantCertificate)) {
                        $_SESSION['errors'][] = "Error uploading file. Please try again.";
                    }
                }
            } else {
                $_SESSION['errors'][] = "Please upload your assistant certificate!";
            }
    
            $contactNumber = $_POST['mobile'];
            if (!preg_match('/^\d{10,15}$/', $contactNumber)) {
                $_SESSION['errors'][] = "Invalid contact number. Please provide a valid phone number.";
            }
    
            // If there are any errors, redirect back to the form
            if (!empty($_SESSION['errors'])) {
                redirect('AssisRegistration/index'); // Redirect to the registration form
                return; // Exit the method
            }
    
            // Serialize the languageSpoken array
            $languageSpoken = isset($_POST['languageSpoken']) ? serialize($_POST['languageSpoken']) : '';
    
            $data = [
                'assistantID' => $_SESSION['user_id'],
                'fullName' => $_POST['fullName'],
                'profilePicture' => 'defaultProfile.png',
                'contactNumber' => $_POST['mobile'],
                'address' => $_POST['address'],
                'DOB' => $_POST['DOB'],
                'gender' => $_POST['gender'],
                'district' => $_POST['district'],
                'bio' => $_POST['bio'],
                'certificateNumber' => $_POST['certificateNumber'],
                'expertise' => $_POST['expertise'],
                'experience' => $_POST['experience'],
                'chargePerHour' => $_POST['chargePerHour'],
                'languageSpoken' => $languageSpoken,
                'certificate' => $assistantCertificate,
                'status' => 1
            ];
    
            $assistant = new AssisModel();
            $result = $assistant->create($data);
            
            $notification = new Notification();
    
            if (!$result) {
                $notification->show("Your registration is successful. Thank you for joining us!", 'success');
                redirect('login/index');
            } else {
                $notification->show("Registration failed. Please try again.", 'error');
                redirect('AssisRegistration/index');
            }
        }
    }
}
