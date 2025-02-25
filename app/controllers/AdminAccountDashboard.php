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
   
        public function petuserselect()
        {
            if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['submit'])) {
                // Retrieve the email from the GET request
                $email = $_GET['email'];
    
                // Validate the email
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    // Instantiate the model
                    $adminModel = new PetOwner();
    
                    // Fetch admin details using the email
                    $result = $adminModel->checkUser($email);
    
                    // Check if an admin exists with the provided email
                    if (!empty($result)) {
                        // Pass the admin details to the admin profile view
                        $this->view('admin/petuseraccount', ['admin' => $result[0]]);
                    } else {
                        // If admin not found, redirect to a 'not found' page or display a message
                        $this->view(['error' => 'No admin found with this email.']);
                    }
                } else {
                    // Handle invalid email input
                    $this->view(['error' => 'Invalid email format. Please try again.']);
                }
            }
        }
        public function doctorselect()
        {
            if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['submit'])) {
                // Retrieve the email from the GET request
                $email = $_GET['email'];
                 
                // Validate the email
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    // Instantiate the model
                    $adminModel = new DoctorModel();
    
                    // Fetch admin details using the email
                    $result = $adminModel->checkUser($email);

                    show($result);
    
                    // Check if an admin exists with the provided email
                    if (!empty($result)) {
                        // Pass the admin details to the admin profile view
                        $this->view('admin/doctoraccount', ['admin' => $result[0]]);
                    } else {
                        // If admin not found, redirect to a 'not found' page or display a message
                        $this->view(['error' => 'No admin found with this email.']);
                    }
                } else {
                    // Handle invalid email input
                    $this->view(['error' => 'Invalid email format. Please try again.']);
                }
            }
        }
        public function petselect()
        {
            if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['submit'])) {
                // Retrieve the email from the GET request
                $email = $_GET['email'];
    
                // Validate the email
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    // Instantiate the model
                    $adminModel = new Pet();
    
                    // Fetch admin details using the email
                    $result = $adminModel->checkUser($email);
    
                    // Check if an admin exists with the provided email
                    if (!empty($result)) {
                        // Pass the admin details to the admin profile view
                        $this->view('admin/petuseraccount', ['admin' => $result[0]]);
                    } else {
                        // If admin not found, redirect to a 'not found' page or display a message
                        $this->view(['error' => 'No admin found with this email.']);
                    }
                } else {
                    // Handle invalid email input
                    $this->view(['error' => 'Invalid email format. Please try again.']);
                }
            }
        }
       
    
    public function pet()
    {
        $this->view('admin/petaccount');
    }

}
