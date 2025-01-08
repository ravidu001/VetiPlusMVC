<?php

class Login extends Controller {
    public function index() {
        $this->view('logindetail/login',[]);
    }

    public function login() 
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /vetiplusMVC/public/signup');
        } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $data = [
                'email' => $_POST['email'],
                'password' => $_POST['password'], 
            ];

            $user = new User();

            $salonRegister = new SalonRegisters();

            $registered = $user->checkLoginUser($data['email']); 
            
            if($registered) {
                if(password_verify($data['password'], $registered->password)) {
                    //$_SESSION['user_id'] = $registered->email; // register wechcha mail eka gann pluwan

                    if($registered->loginCount == 0) {
                        $loginCount = $registered->loginCount + 1;
                        
                        //$_SESSION['type'] = $registered->type; //type gann pluwan

                        $update = $user->updateCount($registered->email, $loginCount);
                        switch ($registered->type) {
                            case 'Vet Doctor':
                                header('Location: ../Doctor');
                                break;
                            case 'Pet Owner':
                                header('Location: ../PetOwner');
                                break;
                            case 'Salon':
                                $_SESSION['SALON_USER'] = $registered->email;
                                // header('Location: ../SalonRegister?email=' . urlencode($registered->email));
                                // $this->view('logindetail/login',[]);
                                redirect('SalonRegister');
                                break;
                            case 'Vet Assistant':
                                header('Location: ../Assistant');
                                break;
                            case 'System Admin':
                                header('Location: ../Admin');
                                break;
                            case 'Owner':
                                header('Location: ../Owner');
                                break;

                            default:
                                $message[] = 'User type not recognized!';
                        }
                    } 
                    else 
                    
                    {
                        $loginCount = $registered->loginCount + 1;

                        $update = $user->updateCount($registered->email, $loginCount);
                        
                        
                        
                        switch ($registered->type) {
                            case 'Vet Doctor':
                                header('Location: ../Doctor.php');
                                break;
                            case 'Pet Owner':
                                header('Location: ../PetOwner');
                                break;
                            case 'Salon':
                                $salonStatus = $salonRegister->getSalonRegisterStatus($registered->email);
                                if ($salonStatus) {
                                    switch ($salonStatus->status) {
                                        case 'pending':
                                            $_SESSION['SALON_USER'] = $registered->email;
                                            redirect('Pending');
                                            break;
                                        case 'approved':
                                            $_SESSION['SALON_USER'] = $registered->email;
                                            // header('Location: ../SalonDashboard');
                                            redirect('SalonDashboard');
                                            break;
                                        case 'rejected':
                                            // echo 'Your registration has been rejected. Please contact support.';
                                            // header('Location: ../SalonRegister');
                                            $_SESSION['SALON_USER'] = $registered->email;
                                            redirect('Rejected');
                                            break;
                                        default:
                                            $message[] = 'Invalid status. Please contact support.';
                                    }
                                } else 

                                {
                                    $message[] = 'Registration data not found. Please register again.';
                                }
                                break;
                                // header('Location: ../Salon');
                                // break;
                            case 'Vet Assistant':
                                header('Location: ../Assistant');
                                break;
                            case 'System Admin':
                                header('Location: ../Admin');
                                break;
                            case 'Owner':
                                header('Location: ../Owner');
                                break;

                            default:
                                $message[] = 'User type not recognized!';
                        }
                    }
                    exit();
                } else {
                    $message[] = 'Incorrect email or password';
                }
            } else {
                $message[] = 'Incorrect email or password';
            }
    }
}

}