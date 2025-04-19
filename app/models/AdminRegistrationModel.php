<?php

class AdminRegistrationModel {
    use Model;

    protected $table = 'systemadmin'; // Replace with your pets table name

    protected $allowedColumns =[
        
        'email',
        'name',
        'contactNumber',
        'address',
        'gender',
        'NIC'
    ];

    public function create($data) {
        $this->insert($data);
    }
    
    //select user
    public function checkUser($email) {
        $this->order_column = 'email';
        return $this->where(['email' => $email]); // what this return is an array of user

    }
    //update user
    public function updateUser($email, $data) {
       return $this->update($email, $data, 'email');
    }

    public function countUser(){
        $count = $this->getCount();
        return $count;  // Return the count value

    }

    public function GetAdminDetails()
    {
        $this->order_column = 'email';
        return $this->findAll();
    }
    
}
