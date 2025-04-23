<?php

class AdminAccountDashboard extends Controller
{
    public function index()
    {
        $this->view('admin/accountdashboard');
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
                        $this->view('admin/petaccount', ['admin' => $result[0]]);
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
       
        // public function accept() {
        //     // Create an instance of the Notification controller
        //     $notification = new Notification();
    
        //     if (isset($_GET['petOwnerID'])) {
        //         $sessionID = $_GET['petOwnerID'];
        //         $assistantID = $_GET['assistantID'];
    
        //         // show($assistantID);
    
        //         // Update the assistant session
        //         $assistantSessionModel = new AssistantSessionModel();
        //         $data = [
        //             'action' => 'accept'
        //         ];
                
        //         // Call a method that can handle updating with composite keys
        //         $success = $assistantSessionModel->updateWithCompositeKey($sessionID, $assistantID, $data);
    
        //         // Prepare the message based on the success of the operation
        //         if ($success) {
        //             $notification->show("Session accepted successfully!", 'success');
        //         } else {
        //             $notification->show("Failed to accept the session.", 'error');
        //         }
        //     } else {
        //         $notification->show("Invalid request.", 'error');
        //     }
        // }

}
