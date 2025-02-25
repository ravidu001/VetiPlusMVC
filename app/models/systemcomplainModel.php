<?php
 
 class systemcomplainModel {
     use Model;
 
     protected $table = 'systemcomplain'; // Replace with your pets table name
 
     protected $allowedColumns =[  
        'email',
        'name',
        'contactNumber',
        'complainID',
        'issue',
        'image',
        'adminEmail',
        'dateTime',
        'respond',
        'status',
        'reponseDateTime'
     ];
 
     public function getcomplain(){
         $this->order_column = 'complainID';
         $result = $this->findAll();
         return $result;
     }

     public function create($data) {
        $this->insert($data);
     }
 
     
 
 }
 