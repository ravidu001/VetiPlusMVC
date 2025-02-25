<?php

class Pet 
{
    use Model;

    
    protected $table = 'petowner';
    

    public function findPetDetailsByID($petID)
    {
        $this->order_colunm = 'petID';
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




    


    protected $table = 'pet';
    protected $allowedColumns = [
        'petID', 'petOwnerID', 'name', 'DOB', 'gender', 'weight', 
        'species', 'breed', 'breedAvailable', 'breedDescription', 'profilePicture'
    ];
    
    public $petOwnerID;

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
     * jm -  Based on the petOwner ID return all the pets' details
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

