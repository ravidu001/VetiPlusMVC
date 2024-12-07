<?php

class DoctorRegistration extends Controller {
    public function index() {
        $this->view('vetDoctor/doctorregistration');
    }
    public function register() {
        $this->view('vetDoctor/home');
    }
}
