<?php

class DoctorViewSession extends Controller {
    public function index() {
        $this->view('vetDoctor/doctorviewsession');
    }

    public function session() {
        $this->view('vetDoctor/doctorsessionview');
    }
}