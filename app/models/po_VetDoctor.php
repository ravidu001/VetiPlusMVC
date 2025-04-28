<?php

class  po_VetDoctor{
    use Model;

    protected $table = 'vetdoctor'; 
    protected $allowedColumns = [ 
        'doctorID', 'fullName', 'profilePicture', 'contactNumber', 'address', 
        'DOB', 'gender', 'bio', 'experience', 'lnumber', 'doctorCertificate', 'timeSlot', 'specialization'
    ];

    public function __construct() {
        $this->order_column = 'petOwnerID ';  

        if (isset($_SESSION['petOwnerID'])) {
       
        }
    }

   
    

}
