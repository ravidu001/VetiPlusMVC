<?php

class OwnerAddAdmin extends Controller
{
    public function index()
    {
        $userCount = $this->countUser();
        $admincount = $this->totalcountUser();
        $deactiveusercount = $this->deactiveusercount();
        $this->view('owner/addadmin', [
            'userCount' => $userCount,
            'admincount' => $admincount,
            'deactiveusercount' => $deactiveusercount,
        ]);
    }

    public function redirectToIndex($data = [])
    {
        $userCount = $this->countUser();
        $admincount = $this->totalcountUser();
        $deactiveusercount = $this->deactiveusercount();

        $this->view('owner/addadmin', [...$data, 
        'userCount' => $userCount,
        'admincount' => $admincount,
        'deactiveusercount' => $deactiveusercount,

    ]);
    }

    public function adminregistration()

    {
        $this->view('owner/adminregistration');
    }
    public function editprofile()
    {
        $email = $_GET['email'];
        // $email = $_SESSION['user_id'];
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Instantiate the model
            $adminModel = new AdminRegistrationModel();

            // Fetch admin details using the email
            $result = $adminModel->checkUser($email);

            // Check if an admin exists with the provided email
            if (!empty($result)) {
                // Pass the admin details to the admin profile view
                $this->view('owner/editprofile', ['admin' => $result[0]]);
            } else {
                // If admin not found, redirect to a 'not found' page or display a message
                $this->view('owner/adminprofile', ['error' => 'No admin found with this email.']);
            }
        } else {
            // Handle invalid email input
            $this->redirectToIndex(['error' => 'Invalid email format. Please try again.']);
        }
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
                    'gender' => $_POST['gender'],
                    'NIC' => $_POST['nic'],

                ];

                $admin = new  AdminRegistrationModel();
                $admin->create($data);

                $user = new User();
                $password = $_POST['password'];
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $userData = [
                    'email' => $_POST['email'],
                    'password' => $hashedPassword,
                    'type' => 'System Admin',
                    'loginCount' => 0,
                    'activeStatus' => 'active'
                ];

                $result = $user->create($userData);

                $notification = new Notification();
                if(!$result) {
                    $notification->show("Admin registration successful.", "success");
                } else {
                    $notification->show("Admin registration failed.", "error");
                }
                // $this->redirectToIndex();
            }
        }
    }

    public function select()
    {
        $notification = new Notification();
        
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['submit'])) {
            // Retrieve the email from the GET request
            $email = $_GET['email'];

            // Validate the email
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                // Instantiate the model
                $adminModel = new AdminRegistrationModel();

                // Fetch admin details using the email
                $result = $adminModel->checkUser($email);

                // Check if an admin exists with the provided email
                if (!empty($result)) {
                    // Pass the admin details to the admin profile view
                    $this->view('owner/adminprofile', [
                        'admin' => $result[0],
                    ]);
                  
                } else {
                    // If admin not found, redirect to a 'not found' page or display a message .
                    $notification->show("No admin found with this email !", 'error');

                }
            } else {
                // Handle invalid email input
                $notification->show("invalid email format. Please try again !", 'error');
            }
        }
    }

    public function adminupdate()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
            $data = [
                'name' => $_POST['name'],
                'address' => $_POST['address'],
                'contactNumber' => $_POST['phone_number']
            ];

            $email = $_POST['email'];
            $adminModel = new AdminRegistrationModel();

            $isUpdated = $adminModel->updateUser($email, $data);

            if (!$isUpdated) {
                // Fetch updated user data
                $updatedAdmin = $adminModel->checkUser($email);
                if (!empty($updatedAdmin)) {
                    // Pass both success message and updated admin data
                    $this->view('owner/adminprofile', [
                        'admin' => $updatedAdmin[0]
                    ]);
                } else {
                    echo "<script>alert('Failed to fetch updated profile.');</script>";
                    $this->view('owner/editprofile', ['error' => 'Failed to fetch updated profile.']);
                }
            } else {
                $this->view('owner/adminprofile', ['error' => 'Failed to update profile.']);
            }
        } else {
            $this->view('owner/editprofile', ['error' => 'Invalid request.']);
        }
    }


    public function countUser()
    {
        $user = new AdminRegistrationModel();
        $count = $user->countUser();
        return $count;
    }

    public function totalcountUser() {
        $user = new User();
        $count = $user->admincountUser();
        return $count;
    }

    public function deactiveusercount(){
        $user = new User();
        $count = $user->deactiveusercount();
        return $count;

    }
    


    public function deleteprofile()
    {
        $email = $_GET['email'];
        $adminModel = new AdminRegistrationModel();
        $adminModel->delete($email, 'email');

        $email = $_GET['email'];
        $chnagestatus = new User();
        $chnagestatus->changestatus($email);
        $this->redirectToIndex();
    }
}
