<?php
class Owner extends Controller
{
  public function index()
  {

    $appointmentPay = new AppointmentPayModel();
    $total = $appointmentPay->CalRevenue();
    $todayRevenue = $appointmentPay->CalTodayRevenue();

    $doctorcount = $this->doctorcount();
    $saloncount = $this->saloncount();
    $petownercount = $this->petownercount();
    $petcount = $this->petcount();
    $appointmentcount = $this->appointmentcount();


    $this->view('owner/ownerhome', [
      'doctorcount' => $doctorcount,
      'saloncount' => $saloncount,
      'petownercount' => $petownercount,
      'petcount' => $petcount,
      'total' => $total,
      'todayRevenue' => $todayRevenue,
      'appointmentcount' => $appointmentcount,

    ]);
  }

  public function doctorcount()
  {
    $doctorcount = new DoctorModel();
    $count = $doctorcount->doctorcount();
    return $count;
  }

  public function saloncount()
  {
    $saloncount = new Salons();
    $count = $saloncount->salonCount();
    return $count;
  }

  public function petownercount(){
    $petownercount = new PetOwner();
    $count = $petownercount->petownercount();
    return $count;
  }

  public function petcount(){
    $petcount = new pet();
    $count = $petcount->petcount();
    return $count;
  }
  public  function appointmentcount()
  {
      $appointment  = new AppointmentModel();
      $count = $appointment->appointmentcount();
      return $count;
  }

}
