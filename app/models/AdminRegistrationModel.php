<?php

class AdminRegistrationModel {
    use Model;

    protected $table = 'systemadmin'; // Replace with your pets table name

    protected $allowedColums =[
        
        'email',
        'password',
        'name',
        'contactNumber',
        'address',
        'gender',
        'nic'
    ];

    public function create($data) {
        $this->insert($data);
    }
}