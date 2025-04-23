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
                $admin_password = $_GET['admin_password'];
                $adminID = $_SESSION['adminID'];

                $admin = new User();
                $adminData = $admin->checkLoginUser($adminID);
                $admindatabasePassword = $adminData->password;
    
                // Verify the password
                if (password_verify($admin_password, $admindatabasePassword)) {
                    // echo "Password verified successfully!";
                   
                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        // Instantiate the model
                        $petOwner = new PetOwner();
        
                        // Fetch admin details using the email
                        $result = $petOwner->checkUser($email);
        
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
                    // Proceed with the rest of your logic
                } else {
                    // Password is incorrect
                    echo "Invalid password. Please try again.";
                    // Handle the error (e.g., redirect or show an error message)
                }
            }
        }

        public function accept() {
            // Create an instance of the Notification controller
            $notification = new Notification();

            if (isset($_GET['petOwnerID'])) {
                $petOwnerID = $_GET['petOwnerID'];

                $User = new User();
                $userData = $User->checkLoginUser($petOwnerID);

                if ($userData && $userData->email == $petOwnerID) {
                    $newPassword = 'Ucsc@123';
                    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                
                    $User->updatePassword($petOwnerID, $hashedPassword);
                    $notification->show("Password reset successfully!", 'success');
                }
                
            } else {
                $notification->show("Invalid request.", 'error');
            }
        }

        public function delete() {
            // Create an instance of the Notification controller
            $notification = new Notification();

            if (isset($_GET['petOwnerID'])) {
                $petOwnerID = $_GET['petOwnerID'];

                $User = new User();
                $userData = $User->checkLoginUser($petOwnerID);

                if ($userData && $userData->email == $petOwnerID) {
                    $activeStatus = 'deactive';
                
                    $User->deactivateUser($petOwnerID, $activeStatus);
                    $notification->show("User deactivate successfully!", 'success');
                }
                
            } else {
                $notification->show("Invalid request.", 'error');
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
