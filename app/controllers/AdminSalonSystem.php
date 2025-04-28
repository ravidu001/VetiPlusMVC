<?php

class AdminSalonSystem extends Controller
{
    public function index()
    {
        $salon = new Salons();
        $salonData = $salon->getallData();

        $this->view('admin/salonsystem', ['salonItem' => $salonData]);
    }
    public function accept($salonID)
    {
        $salon = new Salons();
        $data = [
            'approvedStatus' => 'accepted',
            'rejectReason' => 'Proved' 
        ];
        $salon->updateStatus($salonID, $data);
        redirect('adminsalonsystem'); 
    }

    public function decline($salonID)
    {
        $reason = $_GET['reason'] ?? '';
        $salon = new Salons();
        $data = [
            'approvedStatus' => 'rejected',
            'rejectReason' => $reason
        ];
        $salon->updateStatus($salonID, $data);
        redirect('AdminsalonSystem');
    }
}
