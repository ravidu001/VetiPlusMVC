<?php

class AdminDoctorSystem extends Controller
{
    public function index()
    {
        $doctor = new doctorModel();
        $doctorData = $doctor->getalldata();
       
        $this->view('admin/doctorsystem', ['doctorItem' =>$doctorData]);

    }

    public function accept($doctorID)
    {
        $doctor = new doctorModel();
        $data = [
            'approvedStatus' => 'accepted',
            'rejectReason' => 'Proved' 
        ];
        $doctor->updateStatus($doctorID, $data);
        redirect('admindoctorsystem'); 
    }

    public function decline($doctorID)
{
    $reason = $_GET['reason'] ?? '';
    $doctor = new doctorModel();
    $data = [
        'approvedStatus' => 'rejected',
        'rejectReason' => $reason
    ];
    $doctor->updateStatus($doctorID, $data);
    redirect('AdminDoctorSystem');
}

}
