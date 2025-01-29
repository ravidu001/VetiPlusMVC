<?php

class DoctorSessionHistory extends Controller {
    public function index() {
        $this->view('vetDoctor/doctorsessionhistory');
    }

    public function session() {
        $this->view('vetDoctor/doctorsessionhistoryview');
    }
    
}