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
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT), 
                'type' => $_POST['userType']
            ];
            $user = new User();
            $alreadyHave = $user->checkUser($data['email']);

            if($alreadyHave) {
                $this->view('logindetail/signup', ['errors' => 'User already exists']);
            } else {
                if($user->validate($data)) {
                    $user->create($data);
                    header('Location: /vetiplusMVC/public/login');
                } else {
                    $this->view('logindetail/signup', ['errors' => $user->errors]);
                }
            }
        } else {
            $this->view('logindetail/signup', ['errors' => $user->errors]);
        }


    }
}
