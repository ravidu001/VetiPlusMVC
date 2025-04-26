<?php

class ForAdoption {
    use Model;

    protected $table = 'foradoption';
    protected $allowedColumns = [
        'adoptionListID', 'petOwnerID', 'listedDate', 'title', 'species', 'adoptionImage', 'freeOrSell', 'price', 'district', 'contactNumber', 'lastCheckUpDate'
    ];
  
   public function __construct() {
        $this->order_column = 'adoptionListID ';
        $this->limit = 30;
    }

    public function addNew ($data) {
        $addSuccess = $this->insert($data);
        return empty($addSuccess) ? true : false;
    }

    public function edit ($adoptionListID, $data) {
        $updateSuccess = $this->update($adoptionListID, $data, 'adoptionListID');
        return empty($updateSuccess) ? true : false;
    }

    public function delist ($adoptionListID) {
        $delistSuccess = $this->delete($adoptionListID, 'adoptionListID');
        return empty($delistSuccess) ? true : false;
    }
    
    public function getList_byOthers ($petOwnerID) {
        $adoptionList = $this->where([], ['petOwnerID' => $petOwnerID]);
        return $adoptionList;
    }
    public function getList_byPetOwner ($petOwnerID) {
        $result = $this->where(['petOwnerID' => $petOwnerID]);
        return $result;
    }

}