<?php

class Pet {
    use Model;

    protected $table = 'pet';
    protected $order_column = 'petID';

    protected $allowedColumns = [
        'petID', 'petOwnerID', 'name', 'DOB', 'gender', 'weight', 
        'species', 'breed', 'breedAvailable', 'breedDescription', 'profilePicture'
    ];

    public $userID;

    /**
     * confirmation of user ID
     * @return int The user ID.
    */
    private function getUserID () {
        $this->userID = $_SESSION['userID'];
    }

    public function createPetProfile() {
        $petOwnerID = ['petOwnerID' => $_SESSION['userID']];
        $this->insert()
    }

}