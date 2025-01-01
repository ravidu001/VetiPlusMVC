<?php

class AdminAppointment extends Controller
{
    public function index()
    {
        $this->view('admin/appointment');
    }
    public function appointmentlist()
    {
        $this->view('admin/appointmentlist');
    }
}
