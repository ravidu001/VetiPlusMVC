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
                    $_SESSION['type'] = $registered->type; //type gann pluwan

                    if($registered->loginCount == 0) 
                    {
                        $loginCount = $registered->loginCount + 1;

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
                                $_SESSION['adminID'] = $registered->email;
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
                        if($registered->activeStatus == 'active'){
                            switch ($registered->type)
                            {
                                case 'Vet Doctor':
                                    $_SESSION['user_id'] = $registered->email;
                                    // read data from the doctor table
                                    $doctor = new DoctorModel();
                                    $doctorData = $doctor->find($registered->email);

                                    switch ($doctorData->approvedStatus){
                                        case 'pending':
                                            header('Location: ../Pending');
                                            break;
                                        case 'accepted':
                                            header('Location: ../Doctor');
                                            break;
                                        case 'rejected':
                                            header('Location: ../Rejected');
                                            break;
                                        default:
                                            $this->view('logindetail/login', ['errors' => 'User type not recognized!']);
                                    }
                                    break;
                                    
                                case 'Pet Owner':
                                    $_SESSION['petOwnerID'] = $registered->email;
                                    redirect('PO_home');
                                    break;
                                case 'Salon':
                                    break;
                                case 'Vet Assistant':
                                    $_SESSION['user_id'] = $registered->email;
                                    header('Location: ../Assistant');
                                    break;
                                case 'System Admin':
                                    $_SESSION['adminID'] = $registered->email;
                                    header('Location: ../Admin');
                                    break;
                                case 'Owner':
                                    header('Location: ../Owner');
                                    break;
    
                                default:
                                $this->view('logindetail/login', ['errors' => 'User type not recognized!']);
                                // $data['message'] = 'User type not recognized!';
                            }

                        } else {
                            echo "Your account is not active.";
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