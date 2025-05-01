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
        $email = $_GET['email'];
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $adminModel = new systemcomplainModel();

            $result = $adminModel->checkUser($email);


            if (!empty($result)) {
                $this->view('Admin/complainlist', ['admin' => $result[0]]);
            } else {
                $this->view('Admin/complain', ['error' => 'No admin found with this email.']);
            }
        } else {
            
        }
    }
}
