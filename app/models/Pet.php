<?php

class Pet {
    use Model;

    protected $table = 'pet';
    protected $allowedColumns = [
        'petID', 'petOwnerID', 'name', 'DOB', 'gender', 'profilePicture',
        'species', 'breed', 'activeStatus'
    ];
  
   public function __construct() {
        $this->order_column = 'petID ';  
        $this->limit = 30;               
        isset($_SESSION['petOwnerID']) && ($this->petOwnerID = $_SESSION['petOwnerID']);  
    }
    
    public $petOwnerID;
    
    public function setPetOwnerID () {
        isset($_SESSION['petOwnerID']) && $this->petOwnerID = $_SESSION['petOwnerID'];
    }

  
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
    
   
    public function register ($data) {
        $data['petOwnerID'] = $this->petOwnerID;

        $registerSuccess = $this->insert($data);
        return empty($registerSuccess) ? true : false;
    }

    public function uploadProfilePicture ($petID, $data) {
        $uploadSuccess = $this->update($petID, $data, 'petID');
        return empty($uploadSuccess) ? true : false;
    }

    
    public function editProfileDetails ($petID, $data) {
        $updateSuccess = $this->update($petID, $data, 'petID');
        return empty($updateSuccess) ? true : false;
    }

    public function getDetails_forOtherListings ($petID) {
        $query = "SELECT name, DOB, gender, species, breed from pet WHERE petID = :petID";
        
        $result = $this->query($query, ['petID' => $petID]);
        return $result;
    }

    
    public function deletePet ($petID) {
        $params = ['activeStatus' => 'deactive'];
        $deleteSuccess = $this->update($petID, $params, 'petID');
        return empty($deleteSuccess) ? true : false;
    }


    public $userID;
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
        $this->order_column = 'petOwnerID';
        return $this->where(['petOwnerID' => $email]); 
        
    }

    public function petcount()
    {
        $count = $this->getCount();
        return $count;  

    }

}


