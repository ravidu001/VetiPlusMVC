<?php

class AdminRegistrationModel {
    use Model;

    protected $table = 'systemadmin'; 

    protected $allowedColumns =[
        
        'email',
        'name',
        'contactNumber',
        'address',
        'gender',
        'NIC',
        'DOB'
    ];

    public function create($data) {
        $this->insert($data);
    }
    
    public function checkUser($email) {
        $this->order_column = 'email';
        return $this->where(['email' => $email]); 
    }
    public function updateUser($email, $data) {
       return $this->update($email, $data, 'email');
    }

    public function countUser(){
        $count = $this->getCount();
        return $count;  

    }

    public function GetAdminDetails()
    {
        $this->order_column = 'email';
        return $this->findAll();
    }
    
}
