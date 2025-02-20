<?php

class AdminComplain extends Controller
{
    public function index()
    {   
        $complain = $this->Complain();
        $this->view('admin/complain', ['complain' => $complain]);

    }

    public function Complain(){
        $complainuser = new systemcomplainModel();
        $complain =  $complainuser->getcomplain();
        return $complain;
     }

    public function complainlist()
    {
        $this->view('admin/complainlist');
    }
}
