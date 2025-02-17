<?php

class PetOwner {
    use Model;

    protected $table = 'petowner';
    public $petOwnerID;

    protected $allowedColumns = [ 
        'petOwnerID', 'fullName', 'profilePicture', 'contactNumber', 'gender', 'DOB', 'NIC',
        'houseNo', 'streetName', 'city'
        ,'lastLogin'
    ];
    
    public function __construct() {
        $this->order_column = 'petOwnerID ';  // Overriding order_column here

        if (isset($_SESSION['petOwnerID'])) {
            $this->petOwnerID = $_SESSION['petOwnerID'];
        } else {
            redirect('Login');
        }
        // $this->petOwnerID = isset($_SESSION['petOwnerID']) ? $_SESSION['petOwnerID'] : 'sp.john.manuel737@gmail.com';
    }

    /**
     * Get the petOwner's details from the database
     * @return array The user details.
    */
    public function getUserDetails () {
        $userDetails = $this->where(['petOwnerID' => $this->petOwnerID]);
        return $userDetails;
    }


    /**
     * Register and insert the user details into database
     * @param array $data The petOwner's details to be inserted
     * @return bool  whether registration successful or not.
    */
    public function register ($data) {
        $data['petOwnerID'] = $this->petOwnerID;

        $registerSuccess = $this->insert($data);
        return empty($registerSuccess) ? true : false;
    }

    
    public function createPetProfile() {
        $petOwnerID = ['petOwnerID' => $_SESSION['userID']];
    }

}