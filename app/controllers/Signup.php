<?php

class Signup extends Controller {
    public function index() {
        $this->view('logindetail/signup',[]);
    }

    public function signup() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /vetiplusMVC/public/signup');
        } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $data = [
                'email' => $_POST['email'],
                // 'password' => password_hash($_POST['password'], PASSWORD_DEFAULT), 
                // 'repassword' => password_hash($_POST['repassword'], PASSWORD_DEFAULT), 
                'password' =>$_POST['password'],
                'repassword' =>$_POST['repassword'],
                'type' => $_POST['userType']
            ];

            $user = new User();
            $alreadyHave = $user->checkUser($data['email']);

            if($alreadyHave) 
            {
                $this->view('logindetail/signup', ['errors' => 'User already exists']);
            } 
            else 
            {
                if($user->validate($data)) 
                {
                    $arr = [];
                    $arr = [
                        'email' => $data['email'],
                        'password' => password_hash($_POST['password'], PASSWORD_DEFAULT), 
                        'type' => $data['type']
                    ];
                    
                    $user->create($arr);
                    header('Location: /vetiplusMVC/public/login');
                } 
                else
                {
                    foreach($user->errors as $error)
                    {
                        $this->view('logindetail/signup', ['errors' => $error]);
                    }
                }
            }
        } 
        else 
        {
            $this->view('logindetail/signup'); // remover user because it is out of the if statement
        }


    }
}
