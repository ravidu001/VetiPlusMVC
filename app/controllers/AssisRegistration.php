<?php

class AssisRegistration extends Controller {
    public function index() {
        $this->view('assistant/assisregistration');
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Validate and process the uploaded file
            // echo $_POST['fullName'];
            if (isset($_FILES['certificate']) && $_FILES['certificate']['error'] === UPLOAD_ERR_OK) {
                $assistantCertificate = $_FILES['certificate']['name'];
                $assistantCertificate_tmp_name = $_FILES['certificate']['tmp_name'];
                $upload_dir = 'assets/images/vetAssistant/';
                if (!is_dir($upload_dir)) {
                    echo "<script>console.log('Upload directory does not exist.');</script>";
                    return;   
                }

                if (!move_uploaded_file($assistantCertificate_tmp_name, $upload_dir . $assistantCertificate)) {
                    echo "<script>console.log('Error uploading file. Please try again.');</script>";    
                    return;
                }
            } else {
                echo "<script>console.log('Please upload your assistant certificate!');</script>";
                return; // Exit the method if validation fails
            }

            $contactNumber = $_POST['mobile'];
                if (!preg_match('/^\d{10,15}$/', $contactNumber)) {
                die("Invalid contact number. Please provide a valid phone number.");
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

            // echo $data['assistantID'];
            $assistant = new AssisModel();
            $result = $assistant->create($data);
            
            $notification = new Notification();
    
            if(!$result) {
                // echo "<script>console.log('Registration successful!');</script>";
                // header('Location: /vetiplusMVC/public/DoctorRegistration/home');
                $notification->show("Your registration is successful. Thank you for join with us!", 'success');
                redirect('login/index'); // this is not working because page is refreshed by the notification model.
            } else {
                // echo "<script>console.log('Registration failed. Please try again.');</script>";
                // header('Location: /vetiplusMVC/public/DoctorRegistration/errorUpdate');
                $notification->show("Registration failed. Please try again.", 'error');
                redirect('AssisRegistration/index');
            }

            if(!$result) {
                $this->view('login/index');
            }
        }
    }
}
