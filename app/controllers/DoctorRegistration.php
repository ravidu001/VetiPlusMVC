<?php

class DoctorRegistration extends Controller {
    public function index() {
        $this->view('vetDoctor/doctorregistration');
    }
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $errors = [];
    
            // Validate uploaded certificate
            if (isset($_FILES['doctorCertificate']) && $_FILES['doctorCertificate']['error'] === UPLOAD_ERR_OK) {
                $doctorCertificate = $_FILES['doctorCertificate']['name'];
                $doctorCertificate_tmp_name = $_FILES['doctorCertificate']['tmp_name'];
                $upload_dir = 'assets/images/vetDoctor/';
                
                if (!is_dir($upload_dir)) {
                    $errors[] = "Upload directory does not exist.";
                } else {
                    if (!move_uploaded_file($doctorCertificate_tmp_name, $upload_dir . $doctorCertificate)) {
                        $errors[] = "Error uploading doctor certificate.";
                    }
                }
            } else {
                $errors[] = "Please upload your doctor certificate!";
            }
    
            // Validate contact number
            $contactNumber = $_POST['mobile'];
            if (!preg_match('/^\d{10}$/', $contactNumber)) {
                $errors[] = "Invalid contact number. It should be 10 digits.";
            }
    
            // Validate DoctorID (should be email format)
            $doctorID = $_SESSION['user_id'];
            if (!filter_var($doctorID, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Invalid email format for Doctor ID.";
            }
    
            // Validate veterinary license number format (VC/xxxx or TVC/xxxx)
            $lnumber = $_POST['lnumber'];
            if (!preg_match('/^(VC|TVC)\/\d{4}$/', $lnumber)) {
                $errors[] = "Invalid license number format. It should be VC/xxxx or TVC/xxxx where xxxx are digits.";
            }
    
            // Validate other required fields 
            $requiredFields = ['name', 'address', 'DOB', 'gender', 'bio', 'experience', 'timeSlot', 'special'];
            foreach ($requiredFields as $field) {
                if (empty($_POST[$field])) {
                    $errors[] = ucfirst($field) . " is required.";
                }
            }
    
            // If there are any errors, send them back to frontend
            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                redirect('DoctorRegistration/index');
                exit;
            }
    
            // If validation passes, prepare data
            $data = [
                'doctorID' => $doctorID,
                'fullName' => $_POST['name'],
                'profilePicture' => 'defaultProfile.png',
                'contactNumber' => $contactNumber,
                'address' => $_POST['address'],
                'DOB' => $_POST['DOB'],
                'gender' => $_POST['gender'],
                'bio' => $_POST['bio'],
                'experience' => $_POST['experience'],
                'lnumber' => $lnumber,
                'doctorCertificate' => $doctorCertificate,
                'timeSlot' => $_POST['timeSlot'],
                'specialization' => $_POST['special'],
                'approvedStatus' => 'Pending',
                'registeredDate' => date('Y-m-d H:i:s')
            ];
    
            $doctor = new DoctorModel();
            $result = $doctor->create($data);
    
            $notification = new Notification();
    
            if (!$result) {
                $notification->show("Your registration is successful. Please wait for the approval.", 'success');
                redirect('login/index');
            } else {
                $notification->show("Registration failed. Please try again.", 'error');
                redirect('DoctorRegistration/index');
            }
        }
    }
    

    public function errorUpdate() {
        if (isset($_GET['doctorID'])) {
            $doctorID = $_GET['doctorID'];
            $doctor = new DoctorModel();
            $doctorDetails = $doctor->find($doctorID);
            if ($doctorDetails->approvedStatus == 'rejected') {
                $this->view('vetDoctor/updateregistration', [
                    'doctorDetails' => $doctorDetails
                ]);
            } else {
                // Redirect to the appropriate page based on the doctor's status
                switch ($doctorDetails->approvedStatus) {
                    case 'pending':
                        header('Location: ' . ROOT . '/Pending');
                        break;
                    case 'accepted':
                        header('Location: ' . ROOT . '/Doctor');
                        break;
                    default:
                        header('Location: ' . ROOT . '/login');
                        exit();
                }
            }
        } else {
            $notification = new Notification();
            $notification->show("Invalid request. Please try again.", 'error');
            redirect('Rejected/index');
        }
        // $this->view('vetDoctor/doctorregistration');
    }

    public function updatedoctordata() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $errors = [];
            $doctorID = $_SESSION['user_id'];
            $doctor = new DoctorModel();
            $doctorDetails = $doctor->find($doctorID);
    
            $upload_dir = 'assets/images/vetDoctor/';
            $doctorCertificate = $doctorDetails->doctorCertificate; // Default to existing certificate
    
            // 1. Validate file upload if a new one is provided
            if (isset($_FILES['doctorCertificate']) && $_FILES['doctorCertificate']['error'] === UPLOAD_ERR_OK) {
                $uploadedFileName = $_FILES['doctorCertificate']['name'];
                $uploadedTempPath = $_FILES['doctorCertificate']['tmp_name'];
    
                // Check upload directory
                if (!is_dir($upload_dir)) {
                    // echo "<script>console.log('Upload directory does not exist.');</script>";
                    $errors[] = "Upload directory does not exist.";
                }
    
                // Move uploaded file
                if (!move_uploaded_file($uploadedTempPath, $upload_dir . $uploadedFileName)) {
                    //echo "<script>console.log('Error uploading file. Please try again.');</script>";
                    $errors[] = "Error uploading file. Please try again.";
                    //return;
                }
    
                // Update the certificate only if new one uploaded successfully
                $doctorCertificate = $uploadedFileName;
            }
    
            // 2. Validate contact number
            $contactNumber = $_POST['mobile'];
            if (!preg_match('/^\d{10,15}$/', $contactNumber)) {
                // die("Invalid contact number. Please provide a valid phone number.");
                $errors[] = "Invalid contact number. It should be 10 to 15 digits.";
            }
    
            // 3. Validate required fields (extra layer)
            $requiredFields = ['name', 'mobile', 'address', 'DOB', 'gender', 'bio', 'experience', 'lnumber', 'timeSlot', 'special'];
            foreach ($requiredFields as $field) {
                if (empty($_POST[$field])) {
                    $errors[] = ucfirst($field) . " is required.";
                }
            }

            // If there are any errors, send them back to frontend
            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                // Wait for 5 seconds before redirecting
                // sleep(5);
                redirect('DoctorRegistration/errorUpdate?doctorID=' . $doctorID);
                exit;
            }
    
            // 4. Prepare data
            $data = [
                'doctorID' => $doctorID,
                'fullName' => trim($_POST['name']),
                'profilePicture' => 'defaultProfile.png',
                'contactNumber' => $contactNumber,
                'address' => trim($_POST['address']),
                'DOB' => $_POST['DOB'],
                'gender' => $_POST['gender'],
                'bio' => trim($_POST['bio']),
                'experience' => intval($_POST['experience']),
                'lnumber' => strtoupper(trim($_POST['lnumber'])),
                'doctorCertificate' => $doctorCertificate,
                'timeSlot' => $_POST['timeSlot'],
                'specialization' => $_POST['special'],
                'approvedStatus' => 'Pending',
                'registeredDate' => date('Y-m-d H:i:s')
            ];
    
            // 5. Update doctor profile
            $result = $doctor->updateProfile($doctorID, $data);
    
            $notification = new Notification();
    
            if (!$result) {
                $notification->show("Your registration form updated successfully. Please wait for approval.", 'success');
                redirect('login/index');
            } else {
                $notification->show("Registration update failed. Please try again.", 'error');
                redirect('DoctorRegistration/index');
            }
        }
    }
    
}
