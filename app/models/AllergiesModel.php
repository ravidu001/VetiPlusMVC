<?php 

class AllergiesModel
{
    use Model;

    protected $table = 'allergies';

    protected $allowedColumns = ['allergyID', 'allergenType', 'reactionDescription', 'dateIdentified', 'recordID'];

    public function insertData($data) {
        $this->insert($data);
    }

    public function getAllergyData() {
        $this->limit = 500;
        $this->order_column = 'allergyID';
        $this->order_type = 'DESC';
        return $this->findAll();
    }
}
