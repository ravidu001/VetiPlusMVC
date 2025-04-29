<?php

class DoctorCertificate extends Controller {
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

        // if ($_SESSION['type'] != 'Vet Doctor') {
        //     header('Location: ' . ROOT . '/login');
        //     $notification = new Notification();
        //     $_SESSION['notification'] = [
        //         'message' => 'You are not authorized to access this page.',
        //         'type' => 'error',
        //     ];
        //     exit;
        // }
        $this->view('vetDoctor/doctorcertificate');
    }

    public function certificate($petID = null,$flag = 0) {
        // Check if the flag is set to 1
        // if ($flag == 1) {
        //     $notification = new Notification();
        //     $notification->show('Certificate created successfully', 'success');
        // }
        // Load the certificate view
        $certificate = new CertificateModel();

        if ($petID == null) {
            $petID = $_GET['petId'] ?? null; // Get the pet ID from the URL parameter
        }
        //$petID = $_GET['petId'] ?? null; // Get the pet ID from the URL parameter
        if ($petID) {
            $certificateData = $certificate->getCertificateByPetID($petID);
            $petModel = new Pet(); 
            $petData = $petModel->findPetDetailsByID($petID); // Fetch pet data by ID
            $DOB = $petData->DOB;
            $currentDate = date('Y-m-d');
            $age = date_diff(date_create($DOB), date_create($currentDate))->y;
            // show($certificateData);
            if ($certificateData) {
                $this->view('vetDoctor/certificate', [
                    'certificateData' => $certificateData, 
                    'petData' => $petData, 
                    'age' => $age,
                    'flag' => $flag]
                );
                return;
            } else {
                // $notification = new Notification();
                // $notification->show('Certificate not found', 'error');
            }
        }
        
    }
    // New method to fetch pet data based on Pet ID
    public function getPetData() {
        // Check if the request is an AJAX request
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['petId'])) {
            $petId = $_GET['petId'];
    
            $petModel = new Pet(); 
            $petData = $petModel->findPetDetailsByID($petId); // Fetch pet data by ID
            //show($petData);
            echo "<script>console.log('Pet Data:');</script>";
            if (!empty($petData)) {
                $DOB = $petData->DOB;
                $currentDate = date('Y-m-d');
                $age = date_diff(date_create($DOB), date_create($currentDate))->y;

                $petOwnerModel = new PetOwner();
                $petOwnerData = $petOwnerModel->getUserDetailsByID($petData->petOwnerID);
                $this->view('vetDoctor/doctorcertificate', [
                    'petData' => $petData,
                    'age' => $age,
                    'petOwnerData' => $petOwnerData
                ]);
            } else {
                $notification = new Notification();
                $notification->show('Pet not found', 'error');
                $this->view('vetDoctor/doctorcertificate');
            }
           
        } else {
            // Handle invalid requests
            http_response_code(400);
            $notification = new Notification();
            $notification->show('Invalid request', 'error');
            // echo json_encode(['error' => 'Invalid request']);
        }
    }

    public function insertData() {
        $doctorID = $_SESSION['user_id'];
        $petID = $_POST['petID'] ?? null; // Get the pet ID from the form submission
        // Check if the request is a POST request
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $doctor = new DoctorModel();
            $doctorData = $doctor->find($doctorID);
            // show($doctorData);
            $data = [
                'examinationDate' => date('Y-m-d'),
                'vaccinationStatus' => $_POST['vaccinationStatus'], 
                'followUpAppointment' => $_POST['followUpAppointments'], 
                'healthRate' => $_POST['healthStatus'], 
                'recommendation' => $_POST['recommendations'], 
                'expiryDate' => $_POST['expiryDate'], 
                'petID' => $_POST['petID'], 
                'doctorID' => $doctorID,
                'fullName' => $doctorData->fullName,
                'lnumber' => $doctorData->lnumber,
                
            ];

            $certificateModel = new CertificateModel();
            $insertSuccess = $certificateModel->create($data);
            if (!$insertSuccess) {
                $flag = 1;
                // Redirect to the certificate page
                $this->certificate($petID, $flag);
                exit;
            } else {
                $notification = new Notification();
                $notification->show('Failed to create certificate', 'error');
            }

        }
    }
}
