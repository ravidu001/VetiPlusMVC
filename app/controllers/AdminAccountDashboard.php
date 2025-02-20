<?php

class AdminAccountDashboard extends Controller
{
    public function index()
    {
        $this->view('admin/accountdashboard');
    }
    public function doctor()
    {
        $this->view('admin/doctoraccount');
    }
    public function petuser()
    {
        $this->view('admin/petuseraccount');
    }
    public function pet()
    {
        $this->view('admin/petaccount');
    }

}
