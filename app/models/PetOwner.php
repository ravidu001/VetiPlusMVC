<?php

class PetOwner {
    use Model;

    protected $table = 'petowner';
    protected $order_column = 'petID';

    protected $allowedColumns = [ 
        
    ];

    public $userID;

    /**
     * Get the userID stored in server sessionStorage from when logging in
     * @return int The user ID.
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

    public function createPetProfile() {
        $petOwnerID = ['petOwnerID' => $_SESSION['userID']];
    }

}