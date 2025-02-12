<?php

class PetOwner {
    use Model;

    protected $table = 'petowner';
    protected $order_column = 'petID';

    protected $allowedColumns = [ 
        'petOwnerID', 'fullName', 'profilePicture', 'gender', 'DOB', 'NIC',
        'houseNo', 'streetName', 'city'
        // ,'lastLogin'
    ];

    public $userID;

    /**
     * Get the userID stored in server sessionStorage from when logging in
     * @return void
    */
    private function getUserID () {
        $this->userID = $_SESSION['userID'];
    }

    /**
     * Get the user details from the database
     * @return array The user details.
    */
    private function getUserDetails () {
        $this->getUserID();
        // try 
        // {
        //     $userDetails = $this->where(['userID' => $this->userID]);
        //     return $userDetails;
        // } 
        // catch (Exception $e) {
        //     return $e->getMessage();
        // }
        $userDetails = $this->where(['userID' => $this->userID]);
        return $userDetails;
    }

    /**
     * Register and insert the user details into database
     * @return bool  - whether registration successful or not.
    */
    private function register ($data) {
        $registerSuccess = $this->insert($data);
        // if ($registerSuccess) {
        //     return true;
        // } else {
        //     return false;
        // }
        
        return $registerSuccess ? true : false;
    }
    public function createPetProfile() {
        $petOwnerID = ['petOwnerID' => $_SESSION['userID']];
    }

}