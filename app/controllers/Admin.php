<?php
class Admin extends Controller
{
    public function index()
    {
        $userCount = $this->countUser();
        $appointmentCount = $this->appointmentcount();
    
        $data = [
            'userCount' => $userCount,
            'appointmentCount' => $appointmentCount
        ];
    
        $this->view('admin/adminhome', $data);
    }
    

    public function countUser(){
        $user = new User();
        $count = $user->countUser();
        return $count;
    }

    public  function appointmentcount(){
        $appointment  = new AppointmentModel();
        $count = $appointment->appointmentcount();
        return $count;
    }
}

