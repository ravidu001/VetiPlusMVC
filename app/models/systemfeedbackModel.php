<?php

class systemfeedbackModel {
    use Model;

    protected $table = 'systemfeedback'; // Replace with your pets table name

    protected $allowedColumns =[
        
        'email',
        'comment',
        'rating',

    ];

    public function getfeedback(){
        $this->order_column = 'feedbackID';
        $result = $this->findAll();
        return $result;
    }

    

}