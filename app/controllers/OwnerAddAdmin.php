<?php

class OwnerAddAdmin extends Controller
{
    public function index()
    {
        $this->view('owner/addadmin');
    }
    public function adminprofile()
    {
        $this->view('owner/adminprofile');
    }
    public function adminregistration()
    {
        $this->view('owner/adminregistration');
    }
    public function editprofile(){
        $this->view('owner/editprofile');
    }
    public function deleteprofile(){
        $this->view('owner/deleteprofile');
    }
}
