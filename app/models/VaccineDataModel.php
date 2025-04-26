<?php 

class VaccineDataModel
{
    use Model;

    protected $table = 'vaccineData';

    protected $allowedColumns = ['vaccineID', 'name', 'description', 'brand', 'petType'];

    public function getvaccine() {
        $this->order_column = "vaccineID";
        $this->order_type = "asc";
        return $this->findAll();
    }

    public function getVaccineByID($vaccineID) {
        $this->order_column = "vaccineID";
        $this->order_type = "asc";
        return $this->where(['vaccineID' => $vaccineID]);
    }
}