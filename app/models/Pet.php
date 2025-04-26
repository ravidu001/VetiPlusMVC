<?php

class Pet {
    use Model;

    protected $table = 'pet';
    protected $allowedColumns = [
        'petID', 'petOwnerID', 'name', 'DOB', 'gender', 'profilePicture',
        'species', 'breed', 'activeStatus'
    ];
  
   public function __construct() {
        $this->order_column = 'petID ';  // Overriding order_column here
        $this->limit = 30;               // override default limit 10, since maybe more than 10 pets.
        isset($_SESSION['petOwnerID']) && ($this->petOwnerID = $_SESSION['petOwnerID']);  
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
     * jm -  Based on the petOwner ID return ALL the pets' details
    */
    public function getAllPetsUnderUser () {
        $params = [
            'petOwnerID' => $this->petOwnerID,
            'activeStatus' => 'active'
        ];
        $petDetailsArray = $this->where($params) ?? [];
        return $petDetailsArray;
    }
    public function getOnePet ($petID) {
        $params = [
            'petID' => $petID,
            'petOwnerID' => $this->petOwnerID,
            'activeStatus' => 'active'
        ];
        $petDetails = $this->first($params);
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
        $uploadSuccess = $this->update($petID, $data, 'petID');
        return empty($uploadSuccess) ? true : false;
    }

    /**
     * jm - Update the pet's details in the database - used in pet's profile page
     */
    public function editProfileDetails ($petID, $data) {
        $updateSuccess = $this->update($petID, $data, 'petID');
        return empty($updateSuccess) ? true : false;
    }

    public function getDetails_forOtherListings ($petID) {
        $query = "SELECT name, DOB, gender, species, breed from pet WHERE petID = :petID";
        
        $result = $this->query($query, ['petID' => $petID]);
        return $result;
    }

    /**
     * jm - Delete the pet's details  -> actually only update status as 'deactive'
     */
    public function deletePet ($petID) {
        $params = ['activeStatus' => 'deactive'];
        $deleteSuccess = $this->update($petID, $params, 'petID');
        return empty($deleteSuccess) ? true : false;
    }


    public $userID;
    // Use this function at start to get the petOwnerID:
    private function getUserID () {
        $this->userID = $_SESSION['petOwnerID'];
    }


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

}


