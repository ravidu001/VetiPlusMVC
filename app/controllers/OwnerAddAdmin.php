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
    public function editprofile()
    {
        $this->view('owner/editprofile');
    }
    public function deleteprofile()
    {
        $this->view('owner/deleteprofile');
    }
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['submit'])) {
                $data = [

                    'name' => $_POST['name'],
                    'email' => $_POST['email'],
                    'password' => $_POST['password'],
                    'address' => $_POST['address'],
                    'contactNumber' => $_POST['phone_number'],
                    'nic' => $_POST['nic'],

                ];

                $admin = new  AdminRegistrationModel();
                $admin->create($data);
                $this->view('owner/addadmin');
            }
        }
    }
}
