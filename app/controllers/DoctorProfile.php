<?php

class DoctorProfile extends Controller {
    public function index() {
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
        //echo "<script>window.alert('hello');</script>";
        // Assuming you have a model to handle database operations
        $doctor = new User();
        $doctorID = $_SESSION['user_id'];
        //echo '<script>window.alert("'.$doctorID.'");</script>';

        $data = [
            'password' => $_POST['password'] ?? ''
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
    
}
