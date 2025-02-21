<?php

class systemfeedbackModel {
    use Model;

    protected $table = 'systemfeedback'; // Replace with your pets table name

    protected $allowedColumns =[
        'feedbackID',
        'email',
        'name',
        'comment',
        'rating',
        'feedbackDateTime',
        'contactNumber', // not in the admin ui
        'adminEmail',
        'respondDateTime',
        'respond',
        'status',

    ];

    public function getfeedback(){
        $this->order_column = 'feedbackID';
        $result = $this->findAll();
        return $result ? $result : [];
    }

    public function create($data) {
        $this->insert($data);
    }

    

}