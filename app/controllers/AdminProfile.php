<?php

class AdminProfile extends Controller
{
    public function index()
    {
        $admin  =  $this->profileview();
        $this->view('admin/profile', ['admin' => $admin]);
    }

    public function profileview()
    {
        $adminuser = new AdminRegistrationModel();
        $admin = $adminuser->checkUser($_SESSION['adminID']);
        return $admin;
    }
    public function changePassword()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $currentPassword = $_POST['current_password'];
            $newPassword = $_POST['new_password'];
            $confirmPassword = $_POST['confirm_password'];

            $notification = new Notification();
    
            if ($newPassword !== $confirmPassword) {

                $notification->show('New passwords do not match.','error');
                redirect('AdminProfile');
                exit();
            }
    
            $email = $_GET['email']; 
    
            $userModel = new User();
            $user = $userModel->getUserByEmail($email);
    
            if (!$user) {
                $notification->show('User not found.','error'); 
                redirect('AdminProfile');
                exit();
            }
    
            if (!password_verify($currentPassword, $user[0]->password)) {
                $notification->show('Current password is incorrect.','error');  
                redirect('AdminProfile');
                exit();
            }
    
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    
            $data = [
                'password' => $hashedPassword
            ];
    
            $isUpdated = $userModel->updateUser($email, $data);
    
            if (!$isUpdated) {
                $notification->show(' Password changed successfully!.','success'); 
            } else {
                $notification->show(' Failed to change password!.','error'); 
            }
    
            redirect('AdminProfile');
            exit();
        }
    }
    
}
