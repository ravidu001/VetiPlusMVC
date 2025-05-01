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
            $email = $_GET['email'];
            $admin_password = $_GET['admin_password'];
            $adminID = $_SESSION['adminID'];

            $admin = new User();
            $adminData = $admin->checkLoginUser($adminID);
            $admindatabasePassword = $adminData->password;

            $notification = new Notification();


            if (password_verify($admin_password, $admindatabasePassword)) {

                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $petOwner = new PetOwner();

                    $result = $petOwner->checkUser($email);

                    if (!empty($result)) {
                        $this->view('admin/petuseraccount', ['admin' => $result[0]]);
                    } else {
                        $notification->show("No Pet Owner found with this email.", 'error');
                    }
                } else {
                    $notification->show("Invalid email format. Please try again.", 'error'); 
                }
            } else {
                $notification->show("Invalid password. Please try again.", 'error'); 
            }
        }
    }

    public function accept()
    {
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

    public function delete()
    {
        $notification = new Notification();

        if (isset($_GET['petOwnerID'])) {
            $petOwnerID = $_GET['petOwnerID'];

            $User = new User();
            $userData = $User->checkLoginUser($petOwnerID);

            if ($userData && $userData->email == $petOwnerID) {
                $activeStatus = 'deactive';

                $User->deactivateUser($petOwnerID, $activeStatus);
                $notification->show("User deactivate successfully!", 'success');
                redirect('AdminAccountDashboard');
            }
        } else {
            $notification->show("Invalid request.", 'error');
            redirect('AdminAccountDashboard');
        }
    }

    public function doctorselect()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['submit'])) {
            $email = $_GET['email'];
            $admin_password = $_GET['admin_password'];
            $adminID = $_SESSION['adminID'];

            $admin = new User();
            $adminData = $admin->checkLoginUser($adminID);
            $admindatabasePassword = $adminData->password;

            $notification = new Notification();

            if (password_verify($admin_password, $admindatabasePassword)) {

                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $adminModel = new DoctorModel();

                    $result = $adminModel->checkUser($email);

                    if (!empty($result)) {
                        $this->view('admin/doctoraccount', ['admin' => $result[0]]);
                    } else {
                        $notification->show("No Vet Doctor found with this email.", 'error');
                    }
                } else {
                    $notification->show("Invalid email format. Please try again.", 'error');
                }
            } else {
                $notification->show("Invalid password. Please try again.", 'error'); 
            }
        }
    }

    public function doctoraccept()
    {
        $notification = new Notification();

        if (isset($_GET['doctorID'])) {
            $doctorID = $_GET['doctorID'];

            $User = new User();
            $userData = $User->checkLoginUser($doctorID);

            if ($userData && $userData->email == $doctorID) {
                $newPassword = 'Ucsc@123';
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                $User->updatePassword($doctorID, $hashedPassword);
                $notification->show("Password reset successfully!", 'success');
                redirect('AdminAccountDashboard');
            }
        } else {
            $notification->show("Invalid request.", 'error');
            redirect('AdminAccountDashboard');
        }
    }
    public function doctordelete()
    {
        $notification = new Notification();

        if (isset($_GET['doctorID'])) {
            $doctorID = $_GET['doctorID'];

            $User = new User();
            $userData = $User->checkLoginUser($doctorID);

            if ($userData && $userData->email == $doctorID) {
                $activeStatus = 'deactive';

                $User->deactivateUser($doctorID, $activeStatus);
                $notification->show("User deactivate successfully!", 'success');
            }
        } else {
            $notification->show("Invalid request.", 'error');
        }
    }
    public function petselect()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['submit'])) {
            $email = $_GET['email'];
            $admin_password = $_GET['admin_password'];
            $adminID = $_SESSION['adminID'];

            $admin = new User();
            $adminData = $admin->checkLoginUser($adminID);
            $admindatabasePassword = $adminData->password;

            $notification = new Notification();

            if (password_verify($admin_password, $admindatabasePassword)) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $adminModel = new Pet();

                    $result = $adminModel->checkUser($email);

                    if (!empty($result)) {
                        $this->view('admin/petaccount', ['admin' => $result[0]]);
                    } else {
                        $notification->show("No Pet found with this email.", 'error');
                    }
                } else {
                    $notification->show("Invalid email format. Please try again.", 'error');
                }
            } else {
                $notification->show("Invalid password. Please try again.", 'error');
            }
        }
    }
}
