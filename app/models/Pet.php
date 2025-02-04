<?php

class Pet {
    use Model;
    protected $table = 'Pet';
    protected $order_column = 'petID';
    protected $allowedColumns = [
        'petID',
        'petOwnerID',
        'name',
        'DOB',
        'gender',
        'weight',
        'species',
        'breed',
        'breedAvailable',
        'breedDescription',
        'profilePicture'
    ];
    public $userID;
    // Use this function at start to get the petOwnerID:
    private function getUserID () {
        $this->userID = $_SESSION['userID'];
    }

    public function createPetProfile() {
        $petOwnerID = ['petOwnerID' => $_SESSION['userID']];
    }

    

}