<?php
class Admin extends Controller
{
    public function index()
    {
        $userCount = $this->countUser();
        $appointmentCount = $this->appointmentcount();
        $salonCount = $this->salonCount();
        $complain = $this->Complain();
        $petcount = $this->petcount();
        $petownercount = $this->petownercount();
        $doctorcount = $this->doctorcount();
        $pendingvetdoctorcount = $this->pendingvetdoctorcount();
        $pendingsaloncount = $this->pendingsaloncount();


        $appointmentPay = new AppointmentPayModel();
        $total = $appointmentPay->CalRevenue();
    
        $data = [
            'userCount' => $userCount,
            'appointmentCount' => $appointmentCount,
            'salonCount' => $salonCount,
            'complain' => $complain,
            'total' => $total,
            'petcount' => $petcount,
            'petownercount' => $petownercount,
            'doctorcount' => $doctorcount,
            'pendingvetdoctorcount' => $pendingvetdoctorcount,
            'pendingsaloncount' => $pendingsaloncount,
        ];
    
        $this->view('admin/adminhome', $data);
    }

    public function petcount(){

         $petdata = new Pet();
         $count = $petdata->petcount();
         return $count;
    }

    public function petownercount(){
        $petownerdata = new PetOwner();
        $count = $petownerdata->petownercount();
        return $count;
    }

    public function doctorcount(){
        $doctordata = new DoctorModel();
        $count = $doctordata->doctorcount();
        return $count;
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
     public function pendingsaloncount(){
              $pendingsalon = new Salons();
              $count = $pendingsalon->pendingsaloncount();
              return $count;
     }
     public function pendingvetdoctorcount(){
        $pendingvetdoctor = new DoctorModel();
        $count = $pendingvetdoctor->pendingvetdoctorcount();
        return $count;
    }
}

