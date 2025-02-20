<?php 
   class OwnerAppointment extends Controller{
    public function index(){
        $this->view('owner/appointment');
    }

    public function appointmentlist(){
        $this->view('owner/appointmentlist');
    }
   }
?>