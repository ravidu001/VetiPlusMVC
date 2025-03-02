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
        // $this->view('admin/complainlist');
        $email = $_GET['email'];
        // $email = $_SESSION['user_id'];
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Instantiate the model
            $adminModel = new systemcomplainModel();

            // Fetch admin details using the email
            $result = $adminModel->checkUser($email);


            // Check if an admin exists with the provided email
            if (!empty($result)) {
                // Pass the admin details to the admin profile view
                $this->view('Admin/complainlist', ['admin' => $result[0]]);
            } else {
                // If admin not found, redirect to a 'not found' page or display a message
                $this->view('Admin/complain', ['error' => 'No admin found with this email.']);
            }
        } else {
            // Handle invalid email input
            
        }
    }
}
