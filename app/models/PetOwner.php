<?php

class PetOwner {
    use Model;

    protected $table = 'petowner'; 
    protected $allowedColumns = [ 
        'petOwnerID', 'fullName', 'profilePicture', 'contactNumber', 'gender', 'DOB', 'NIC',
        'houseNo', 'streetName', 'city'
        ,'lastLogin'
    ];
    
    public $petOwnerID;
    public $petOwnerDetails;

    public function __construct() {
        $this->order_column = 'petOwnerID ';  // Overriding order_column here

        if (isset($_SESSION['petOwnerID'])) {
            $this->petOwnerID = $_SESSION['petOwnerID'];

        // } else {
        //     redirect('Login');
        }
    }

    /**
     * jm -  Get the petOwner's details from the database
     * @return array The user details.
    */
    public function getUserDetails () {
        $userDetails = $this->first(['petOwnerID' => $this->petOwnerID]);
        return $userDetails;
    }

    /**
     * jm -  Register and insert the user details into database
     * @param array $data The petOwner's details to be inserted
     * @return bool  whether registration successful or not.
    */
    public function register ($data) {
        $data['petOwnerID'] = $this->petOwnerID;

        $registerSuccess = $this->insert($data);
        return empty($registerSuccess) ? true : false;
    }
   
    /**
     * jm - 'upload' petOwner's profile pic and update database
     * @return bool Whether successful or not
     */ 
    public function uploadProfilePicture ($data) {
        $uploadSuccess = $this->update($this->petOwnerID, $data);
        return empty($uploadSuccess) ? true : false;
    }

}
