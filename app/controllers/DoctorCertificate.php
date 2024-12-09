<?php

class DoctorCertificate extends Controller {
    public function index() {
        $this->view('vetDoctor/doctorcertificate');
    }

    public function certificate() {
        $this->view('vetDoctor/certificate');
    }
}