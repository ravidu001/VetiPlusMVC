<?php
 
 class systemcomplainModel {
     use Model;
 
     protected $table = 'systemcomplain'; // Replace with your pets table name
 
     protected $allowedColumns =[
         
         'email',
         'complainID',
         'issue',
         'image',
 
     ];
 
     public function getcomplain(){
         $this->order_column = 'complainID';
         $result = $this->findAll();
         return $result;
     }
 
     
 
 }
 