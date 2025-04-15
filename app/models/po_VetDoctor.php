<?php

class  po_VetDoctor{
    use Model;

    protected $table = 'vetdoctor'; 
    protected $allowedColumns = [ 
        'doctorID', 'fullName', 'profilePicture', 'contactNumber', 'address', 
        'DOB', 'gender', 'bio', 'experience', 'lnumber', 'doctorCertificate', 'timeSlot', 'specialization'
    ];

    public function __construct() {
        $this->order_column = 'petOwnerID ';  // Overriding order_column here

        if (isset($_SESSION['petOwnerID'])) {
            // $this->petOwnerID = $_SESSION['petOwnerID'];

        // } else {
        //     redirect('Login');
        }
    }

    /**
     * jm -  Get the petOwner's details from the database
     * @return array The user details.
    */
    public function getUserDetails () {
        // $userDetails = $this->first(['petOwnerID' => $this->petOwnerID]);
        // return $userDetails;
    }

}
