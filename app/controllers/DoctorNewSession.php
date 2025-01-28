<?php

class DoctorNewSession extends Controller {
    public function index() {
        $this->view('vetDoctor/doctornewsession');
    }

    public function createSession() {
        $doctorID = $_SESSION['user_id'];
        $session = new DoctorSessionModel();

        $data = [
            'selectedDate' => $_POST['selectedDate'],
            'startTime' => $_POST['startTime'],
            'endTime' => $_POST['endTime'],
            'clinicLocation' => $_POST['clinicLocation'],
            'district' => $_POST['district'],
            'assistantID' => $_POST['assistantID'],
        ];
    }
}