<?php

class User {
    use Model;

    protected $table = 'User';

    protected $allowedColumns = ['email', 'password', 'type', 'loginCount'];

    public function create($data) {
        $this->insert($data);
    }   

    public function checkUser($email) {
        // echo $email;
        $this->order_column = 'email';
        $result = $this->where(['email' => $email]);
        return $this->where(['email' => $email]); // what this return is an array of user
        // if($result) {
        //     return true;
        // } else {
        //     return false;
        // }
        
    }

    public function checkLoginUser($email) {
        // if($this->first(['email' => $email])) {
        //    echo "wada";
        // } else {
        //     echo "false";
        // }
        return $this->first(['email' => $email]); // how to access return value: $registered['email']
    }

    public function updateCount($email, $loginCount) {
        $this->update($email, ['loginCount' => $loginCount], 'email');
    }

    public function updatePassword($email, $password) {
        $this->update($email, ['password' => $password], 'email');
    }


    public function validate($data) {
        $this->errors = [];

        if(empty($data['email'])) {
            $this->errors['name'] = "email is required";
        }

        if(empty($this->errors)) {
            return true;
        } else {
            return false;
        }
    }
}

