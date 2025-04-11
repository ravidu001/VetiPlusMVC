<?php

class Pet {
    use Model;
    
    public function findPetDetailsByID($petID)
    {
        $this->order_column = 'petID';
        return $this->first(['petID' => $petID ]);
    }

    public function checkUser($email)
    {
        // echo $email;
        $this->order_column = 'petOwnerID';
        // $result = $this->where(['email' => $email]);
        return $this->where(['petOwnerID' => $email]); // what this return is an array of user
        // if($result) {
        //     return true;
        // } else {
        //     return false;
        // } 
    }

    protected $table = 'pet';
    protected $allowedColumns = [
        'petID', 'petOwnerID', 'name', 'DOB', 'gender', 'weight', 
        'species', 'breed', 'breedAvailable', 'breedDescription', 'profilePicture'
    ];
    
    public function __construct() {
        $this->order_column = 'petID ';  // Overriding order_column here
        $this->limit = 30;     // override default limit 10, since maybe more than 10 pets.
    }
    
    public $petOwnerID;
    /**
     * jm - Sets the value of petOwner ID from session storage.
     * Controller itself should make sure ID is set in session.
     * Call this function whenever petOwner or pet object created is created by me
     */
    public function setPetOwnerID () {
        isset($_SESSION['petOwnerID']) && $this->petOwnerID = $_SESSION['petOwnerID'];
    }

    /**
     * jm -  Based on the petOwner ID return all the pets' details
    //  * @return 'array of arrays'|false
    */
    public function getPetsDetails () {
        $petDetailsArray = $this->where(['petOwnerID' => $this->petOwnerID]);
        return $petDetailsArray;
    }

    public function getOnePet ($petID) {
        $petDetails = $this->first(['petOwnerID' => $this->petOwnerID,
                                    'petID' => $petID]);
        return $petDetails;
    }
    
    /**
     * jm -  Register and insert the pet's details into database
     * @param array $data The pet's details to be inserted
     * @return bool Whether registration successful or not.
    */
    public function register ($data) {
        $data['petOwnerID'] = $this->petOwnerID;

        $registerSuccess = $this->insert($data);
        return empty($registerSuccess) ? true : false;
    }

    /**
     * jm - 'upload' pet's profile pic and update database
     * @return bool Whether successful or not
     */
    public function uploadProfilePicture ($petID, $data) {
        $uploadSuccess = $this->update($petID, $data);
        return empty($uploadSuccess) ? true : false;
    }

    public $userID;
    // Use this function at start to get the petOwnerID:
    private function getUserID () {
        $this->userID = $_SESSION['userID'];
    }



}