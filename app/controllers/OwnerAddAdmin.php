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

        $this->view('owner/addadmin', [
            ...$data,
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
                $errors = [];
                $notification = new Notification();
                // Validate Name
                if (empty(trim($_POST['name']))) {
                    $errors[] = "Name is required.";
                } elseif (!preg_match("/^[a-zA-Z\s]+$/", $_POST['name'])) {
                    $errors[] = "Name can only contain letters and spaces.";
                }

                // Validate Email
                if (empty(trim($_POST['email']))) {
                    $errors[] = "Email is required.";
                } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    $errors[] = "Invalid email format.";
                }

                // Validate Password
                if (empty(trim($_POST['password']))) {
                    $errors[] = "Password is required.";
                } elseif (strlen($_POST['password']) < 8) {
                    $errors[] = "Password must be at least 8 characters long.";
                } elseif ($_POST['password'] !== $_POST['cpassword']) {
                    $errors[] = "Passwords do not match.";
                }

                // Validate Address
                if (empty(trim($_POST['address']))) {
                    $errors[] = "Address is required.";
                }

                // Validate Phone Number
                if (empty(trim($_POST['phone_number']))) {
                    $errors[] = "Phone number is required.";
                } elseif (!preg_match("/^[0-9]{10}$/", $_POST['phone_number'])) {
                    $errors[] = "Invalid phone number format.";
                }

                // Validate NIC
                if (empty(trim($_POST['nic']))) {
                    $errors[] = "NIC number is required.";
                }

                // Validate Gender
                if (empty($_POST['gender'])) {
                    $errors[] = "Gender must be selected.";
                }

                // If there are errors, show them
                if (!empty($errors)) {
                    foreach ($errors as $error) {
                        $notification->show($error, "error");
                    }
                    return; // Stop further processing
                }

                // Proceed with registration if no errors
                $data = [
                    'name' => $_POST['name'],
                    'email' => $_POST['email'],
                    'password' => $_POST['password'],
                    'address' => $_POST['address'],
                    'contactNumber' => $_POST['phone_number'],
                    'gender' => $_POST['gender'],
                    'NIC' => $_POST['nic'],
                ];

                $admin = new AdminRegistrationModel();
                $admin->create($data);

                $user = new User();
                $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $userData = [
                    'email' => $_POST['email'],
                    'password' => $hashedPassword,
                    'type' => 'System Admin',
                    'loginCount' => 0,
                    'activeStatus' => 'active'
                ];

                $result = $user->create($userData);
                $notification = new Notification();
                if (!$result) {
                    $notification->show("Admin registration successful.", "success");
                } else {
                    $notification->show("Admin registration failed.", "error");
                }
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

    public function totalcountUser()
    {
        $user = new User();
        $count = $user->admincountUser();
        return $count;
    }

    public function deactiveusercount()
    {
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
