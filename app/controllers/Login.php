<?php

class Login extends Controller
{
    public function index()
    {
        $this->view('logindetail/login',[]);
    }

    public function login() 
    {
        $data = [];
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') 
        {
            header('Location: /vetiplusMVC/public/signup');
        } 
        else if ($_SERVER['REQUEST_METHOD'] == 'POST') 
        {
            $data = [
                'email' => $_POST['email'],
                'password' => $_POST['password']
            ];

            $user = new User();
            $salonRegister = new SalonRegisters();
            $salontable = new Salons();

            //find the login email has in the user table 
            //return the user table data 
            $registered = $user->checkLoginUser($data['email']); 

            if($registered) 
            {
                if(password_verify($data['password'], $registered->password)) 
                {
                    //$_SESSION['user_id'] = $registered->email; // register wechcha mail eka gann pluwan

                    if($registered->loginCount == 0) 
                    {
                        $loginCount = $registered->loginCount + 1;
                        
                        //$_SESSION['type'] = $registered->type; //type gann pluwan

                        $update = $user->updateCount($registered->email, $loginCount);

                        switch ($registered->type) 
                        {
                            case 'Vet Doctor':
                                $_SESSION['user_id'] = $registered->email;
                                header('Location: ../DoctorRegistration');
                                break;
                            case 'Pet Owner':
                                $_SESSION['petOwnerID'] = $registered->email;
                                redirect('PO_register');
                                break;
                            case 'Salon':
                                $_SESSION['SALON_USER'] = $registered->email;
                                // header('Location: ../SalonRegister?email=' . urlencode($registered->email));
                                // $this->view('logindetail/login',[]);
                                redirect('SalonRegister');
                                break;
                            case 'Vet Assistant':
                                $_SESSION['user_id'] = $registered->email;
                                header('Location: ../Assistant');
                                break;
                            case 'System Admin':
                                header('Location: ../Admin');
                                break;
                            case 'Owner':
                                header('Location: ../Owner');
                                break;

                            default:
                                $data['message'] = 'User type not recognized!';
                        }
                    } 
                    else 
                    {
                        $loginCount = $registered->loginCount + 1;
                        $update = $user->updateCount($registered->email, $loginCount);

                        switch ($registered->type)
                        {
                            case 'Vet Doctor':
                                $_SESSION['user_id'] = $registered->email;
                                header('Location: ../Doctor');
                                break;
                            case 'Pet Owner':
                                $_SESSION['petOwnerID'] = $registered->email;
                                redirect('PO_home');
                                break;
                            case 'Salon':
                                $_SESSION['SALON_USER'] = $registered->email;
                                //check the accepted email has or not
                                $email = $data['email']; 
                                //this function in the salons model file
                                $accepted = $salontable->FindUser($email);

                                show($accepted);
                                if($accepted)
                                {
                                    // echo json_encode(['status' => 'success', 'redirect' => ROOT . '/SalonDashboard']);
                                    $_SESSION['SALON_USER'] = $registered->email;
                                    redirect('SalonDashboard');
                                }
                                //email not in the accepted salon data table
                                //so it will be rejected or pending  
                                else
                                {
                                    //get the satus of the salon egister pending or not
                                    //this function in the salon registration model
                                    //get the first data row which match the email
                                    $salonStatus = $salonRegister->getSalonRegisterStatus($registered->email);

                                    //check the status
                                    if ($salonStatus) 
                                    {
                                        switch ($salonStatus->status) 
                                        {
                                            case 'pending':
                                                // echo json_encode(['status' => 'success', 'redirect' => ROOT . '/Pending']);
                                                $_SESSION['SALON_USER'] = $registered->email;
                                                redirect('Pending');
                                                break;
                                           
                                            case 'rejected':
                                                // echo json_encode(['status' => 'success', 'redirect' => ROOT . '/Rejected']);
                                                $_SESSION['SALON_USER'] = $registered->email;
                                                redirect('Rejected');
                                                break;

                                            default:
                                                // show('Invalid status');
                                                // $message[] = 'Invalid status. Please contact support.';
                                                $this->view('logindetail/login', ['errors' => 'User type not recognized!']);
                                                // $data['status'] = 'error';
                                                // $data['message'] = 'User type not recognized!';
                                                // echo json_encode(['status' => 'error', 'message' => $data['message']]);
                                        }
                                    }
                                    else 
                                    {
                                        // show('registration not found, not submit/ complete registration form');
                                        $this->view('logindetail/login', ['errors' => 'Registration data not found. Please register again.']);
                                        // $data['status'] = 'error';
                                        // $data['message'] = 'Registration data not found. Please register again.';
                                        // $data['message'] = 'Incorrect password';
                                        // echo json_encode(['status' => 'error', 'message' => $data['message']]);
                                    }

                                }

                                // $salonStatus = $salonRegister->getSalonRegisterStatus($registered->email);
                                // //if -> email eka salon table eke tyed  -> accepted -> dashboard 
                                // //else ->rejected / pending  -> 

                                // if ($salonStatus) 
                                // {
                                //     switch ($salonStatus->status) 
                                //     {
                                //         case 'pending':
                                //             $_SESSION['SALON_USER'] = $registered->email;
                                //             redirect('Pending');
                                //             break;
                                //         case 'approved':
                                //             $_SESSION['SALON_USER'] = $registered->email;
                                //             redirect('SalonDashboard');
                                //             break;
                                //         case 'rejected':
                                //             $_SESSION['SALON_USER'] = $registered->email;
                                //             redirect('Rejected');
                                //             break;
                                //         default:
                                //             $message[] = 'Invalid status. Please contact support.';
                                //     }
                                // } 
                                
                                //check the email is has or not in the  salon table 
                                //if has salon 

                                // if
                                // {

                                // }

                                //salon table has not the email -> it will reject or pending
                                // else
                                // {

                                // }

                                // else 
                                // {
                                //     $message[] = 'Registration data not found. Please register again.';
                                // }
                                break;
                                header('Location: ../Salon');
                                break;
                            case 'Vet Assistant':
                                $_SESSION['user_id'] = $registered->email;
                                header('Location: ../Assistant');
                                break;
                            case 'System Admin':
                                header('Location: ../Admin');
                                break;
                            case 'Owner':
                                header('Location: ../Owner');
                                break;

                            default:
                            $this->view('logindetail/login', ['errors' => 'User type not recognized!']);
                            // $data['message'] = 'User type not recognized!';
                        }
                    }
                    exit();
                } 
                else 
                {
                    // show('login incorrect password');
                    $this->view('logindetail/login', ['errors' => 'Incorrect email or password']);
                    // $data['message'] = 'Incorrect email or password';
                }
            } 
            else
            {
                // show('Invalid email or password');
                $this->view('logindetail/login', ['errors' => 'Incorrect email or password']);
                // $data['message'] = 'Incorrect email or password';
            }
        }

    }

}