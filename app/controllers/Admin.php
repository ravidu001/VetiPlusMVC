<?php
class Admin extends Controller
{
    public function index()
    {
        $userCount = $this->countUser();
        $appointmentCount = $this->appointmentcount();
        $salonCount = $this->salonCount();
        $complain = $this->Complain();
    
        $data = [
            'userCount' => $userCount,
            'appointmentCount' => $appointmentCount,
            'salonCount' => $salonCount,
            'complain' => $complain
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

    public function salonCount(){
        $salon = new Salons();
        $count = $salon->salonCount();
        return $count;
    }
    public function Complain(){
        $complainuser = new systemcomplainModel();
        $complain =  $complainuser->getcomplain();
        return $complain;
     }
}

