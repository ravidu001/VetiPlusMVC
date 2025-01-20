<?php

class Login extends Controller {
    public function index() {
        $this->view('logindetail/login',[]);
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /vetiplusMVC/public/signup');
        } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $data = [
                'email' => $_POST['email'],
                'password' => $_POST['password'], 
            ];
            $user = new User();

            $registered = $user->checkLoginUser($data['email']); 
            print_r($registered->email);
            

            if($registered) {
                if(password_verify($data['password'], $registered->password)) {
                    $_SESSION['email'] = $registered->email;
                    if($registered->loginCount == 0) {
                        $loginCount = $registered->loginCount + 1;
                        
                        $update = $user->updateCount($registered->email, $loginCount);
                        $_SESSION['type'] = $registered->type;
                        switch ($registered->type) {
                            case 'Vet Doctor':
                                header('Location: ../Doctor');
                                break;
                            case 'Pet Owner':
                                header('Location: ../PetOwner');
                                break;
                            case 'Salon':
                                header('Location: ../Salon');
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
                    } else {
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
                                header('Location: ../Salon');
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