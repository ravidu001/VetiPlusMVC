<?php

class DoctorRegistration extends Controller {
    public function index() {
        $this->view('vetDoctor/doctorregistration');
    }
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Validate and process the uploaded file
            // echo $_POST['name'];
            if (isset($_FILES['doctorCertificate']) && $_FILES['doctorCertificate']['error'] === UPLOAD_ERR_OK) {
                $doctorCertificate = $_FILES['doctorCertificate']['name'];
                $doctorCertificate_tmp_name = $_FILES['doctorCertificate']['tmp_name'];
                $upload_dir = 'assets/images/vetDoctor/';
                if (!is_dir($upload_dir)) {
                    echo "<script>console.log('Upload directory does not exist.');</script>";
                    return;   
                }

                if (!move_uploaded_file($doctorCertificate_tmp_name, $upload_dir . $doctorCertificate)) {
                    echo "<script>console.log('Error uploading file. Please try again.');</script>";    
                    return;
                }
            } else {
                echo "<script>console.log('Please upload your doctor certificate!');</script>";
                return; // Exit the method if validation fails
            }

            $contactNumber = $_POST['mobile'];
                if (!preg_match('/^\d{10,15}$/', $contactNumber)) {
                die("Invalid contact number. Please provide a valid phone number.");
            }

               
            $data = [
                'doctorID' => $_SESSION['user_id'],
                'fullName' => $_POST['name'],
                'profilePicture' => 'defaultProfile.png',
                'contactNumber' => $_POST['mobile'],
                'address' => $_POST['address'],
                'DOB' => $_POST['DOB'],
                'gender' => $_POST['gender'],
                'bio' => $_POST['bio'],
                'experience' => $_POST['experience'],
                'lnumber' => $_POST['lnumber'],
                'doctorCertificate' => $doctorCertificate,
                'timeSlot' => $_POST['timeSlot'],
                'specialization' => $_POST['special'],
                'approvedStatus' => 'Pending',
                'registeredDate' => date('Y-m-d H:i:s')
            ];

            // echo $data['doctorID'];
            $doctor = new DoctorModel();
            $result = $doctor->create($data);

            $notification = new Notification();
    
            if(!$result) {
                // echo "<script>console.log('Registration successful!');</script>";
                // header('Location: /vetiplusMVC/public/DoctorRegistration/home');
                $notification->show("Your registration is successful. Please wait for the approval.", 'success');
                redirect('login/index'); // this is not working because page is refreshed by the notification model.
            } else {
                // echo "<script>console.log('Registration failed. Please try again.');</script>";
                // header('Location: /vetiplusMVC/public/DoctorRegistration/errorUpdate');
                $notification->show("Registration failed. Please try again.", 'error');
                redirect('DoctorRegistration/index');
            }

            if(!$result) {
                $this->view('login/index');
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
            // Validate and process the uploaded file
            // echo $_POST['name'];
            $doctorID = $_SESSION['user_id'];
            $doctor = new DoctorModel();
            $doctorDetails = $doctor->find($doctorID);

            if ($doctorDetails->doctorCertificate != $_FILES['doctorCertificate']['name']){
                if (isset($_FILES['doctorCertificate']) && $_FILES['doctorCertificate']['error'] === UPLOAD_ERR_OK) {
                    $doctorCertificate = $_FILES['doctorCertificate']['name'];
                    $doctorCertificate_tmp_name = $_FILES['doctorCertificate']['tmp_name'];
                    $upload_dir = 'assets/images/vetDoctor/';
                    if (!is_dir($upload_dir)) {
                        echo "<script>console.log('Upload directory does not exist.');</script>";
                        return;   
                    }
    
                    if (!move_uploaded_file($doctorCertificate_tmp_name, $upload_dir . $doctorCertificate)) {
                        echo "<script>console.log('Error uploading file. Please try again.');</script>";    
                        return;
                    }
                } else {
                    echo "<script>console.log('Please upload your doctor certificate!');</script>";
                    return; // Exit the method if validation fails
                }
            }

            $contactNumber = $_POST['mobile'];
                if (!preg_match('/^\d{10,15}$/', $contactNumber)) {
                die("Invalid contact number. Please provide a valid phone number.");
            }

               
            $data = [
                'doctorID' => $_SESSION['user_id'],
                'fullName' => $_POST['name'],
                'profilePicture' => 'defaultProfile.png',
                'contactNumber' => $_POST['mobile'],
                'address' => $_POST['address'],
                'DOB' => $_POST['DOB'],
                'gender' => $_POST['gender'],
                'bio' => $_POST['bio'],
                'experience' => $_POST['experience'],
                'lnumber' => $_POST['lnumber'],
                'doctorCertificate' => $doctorCertificate,
                'timeSlot' => $_POST['timeSlot'],
                'specialization' => $_POST['special'],
                'approvedStatus' => 'Pending',
                'registeredDate' => date('Y-m-d H:i:s')
            ];

            // echo $data['doctorID'];
            $doctor = new DoctorModel();
            $result = $doctor->updateProfile($doctorID, $data);

            $notification = new Notification();
    
            if(!$result) {
                // echo "<script>console.log('Registration successful!');</script>";
                // header('Location: /vetiplusMVC/public/DoctorRegistration/home');
                $notification->show("Your registration form Updated successfully. Please wait for the approval.", 'success');
                redirect('login/index'); // this is not working because page is refreshed by the notification model.
            } else {
                // echo "<script>console.log('Registration failed. Please try again.');</script>";
                // header('Location: /vetiplusMVC/public/DoctorRegistration/errorUpdate');
                $notification->show("Registration failed. Please try again.", 'error');
                redirect('DoctorRegistration/index');
            }

            if(!$result) {
                $this->view('login/index');
            }
        }
    }
}
