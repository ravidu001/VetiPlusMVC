<?php

class Pet {
    use Model;

    protected $table = 'pet';
    public $petOwnerID;

    protected $allowedColumns = [
        'petID', 'petOwnerID', 'name', 'DOB', 'gender', 'weight', 
        'species', 'breed', 'breedAvailable', 'breedDescription', 'profilePicture'
    ];
  
    public function __construct() {
        $this->order_column = 'petID ';  // Overriding order_column here

        if (isset($_SESSION['petOwnerID'])) {
            $this->petOwnerID = $_SESSION['petOwnerID'];
        } else if( $_SESSION['SALON_USER'])
        {
            $this->petOwnerID = $_SESSION['SALON_USER'];
        }
        else {
            redirect('Login');
        }
    }

    /**
     * Based on the petOwner ID return all the pets' details
     * @return 'array of arrays'|false 
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
     * Register and insert the pet's details into database
     * @param array $data The pet's details to be inserted
     * @return bool Whether registration successful or not.
    */
    public function register ($data) {
        $data['petOwnerID'] = $this->petOwnerID;

        $registerSuccess = $this->insert($data);
        return empty($registerSuccess) ? true : false;
    }
    public $userID;
    // Use this function at start to get the petOwnerID:
    private function getUserID () {
        $this->userID = $_SESSION['userID'];
    }

    public function uploadProfilePicture ($petID, $data) {
        $uploadSuccess = $this->update($petID, $data);
        return empty($uploadSuccess) ? true : false;
    }

    

}