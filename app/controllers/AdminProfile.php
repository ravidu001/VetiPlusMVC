<?php

class AdminProfile extends Controller
{
    public function index()
    {   
        $admin  =  $this-> profileview();
        $this->view('admin/profile',['admin' => $admin]);
    }

   public function profileview(){
        $adminuser = new AdminRegistrationModel();
        $admin = $adminuser->checkUser($_SESSION['adminID']);
        return $admin;
   }
    

    
}
