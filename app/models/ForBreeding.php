<?php

class ForBreeding{
    use Model;

    protected $table = 'forbreeding';
    protected $allowedColumns = [
        'breedingListID', 'status', 'petID', 'petOwnerID', 'listedDate', 'title', 'freeOrSell', 'price', 'district', 'contactNumber', 'lastCheckUpDate'
    ];

    private $petObj;
  
   public function __construct() {
        $this->order_column = 'breedingListID ';
        $this->limit = 30;

        $this->petObj = new Pet;
    }

    public function addNew ($data) {
        $addSuccess = $this->insert($data);
        return empty($addSuccess) ? true : false;
    }

    public function edit ($breedingListID, $data) {
        $updateSuccess = $this->update($breedingListID, $data, 'breedingListID');
        return empty($updateSuccess) ? true : false;
    }

    public function delist ($breedingListID) {
        $params = ['status' => 'unavailable'];

        $delistSuccess = $this->update($breedingListID, $params, 'breedingListID');
        return empty($delistSuccess) ? true : false;
    }
    
    public function getList_byOthers ($petOwnerID) {
        $query = "SELECT p.name AS petName, p.DOB AS DOB, p.gender AS gender, p.species AS species, p.breed AS breed, b.*
                    FROM forbreeding b INNER JOIN pet p ON b.petID = p.petID
                    WHERE p.petOwnerID != :poID,
                    AND b.status = 'available'
                ";

        $result = $this->query($query, ['poID' => $petOwnerID]);
        return $result;
    }
    public function getList_byPetOwner ($petOwnerID) {
        $query = "SELECT p.name AS petName, p.DOB AS DOB, p.gender AS gender, p.species AS species, p.breed AS breed, b.*
                    FROM forbreeding b INNER JOIN pet p ON b.petID = p.petID
                    WHERE p.petOwnerID = :poID,
                    AND b.status = 'available'
                ";

        $result = $this->query($query, ['poID' => $petOwnerID]);
        return $result;
    }

}