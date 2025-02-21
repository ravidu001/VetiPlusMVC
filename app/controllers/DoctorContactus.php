<?php

class DoctorContactus extends Controller {
    public function index() {
        $this->view('vetDoctor/doctorcontactus');
    }

    public function insertData() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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

            $feedback = new systemfeedbackModel();

            if (!$feedback->create($data)) {
                echo "<script>alert('Feedback submitted successfully!');</script>";
                $this->view('vetDoctor/doctorcontactus');
            } else {
                echo "<script>alert('Failed to submit feedback!');</script>";
                $this->view('vetDoctor/doctorcontactus');
            }
        }
    }
}