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

    public function addNew($data){
        $addSuccess = $this->insert($data);
        return empty($addSuccess) ? true : false;
    }
    public function getalldata() {
        $this->limit=1000;
        $this->order_column = 'vaccineID';
        $this->order_type = 'ASC';
        return $this->findAll();
    }
}