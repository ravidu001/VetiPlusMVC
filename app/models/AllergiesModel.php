<?php 

class AllergiesModel
{
    use Model;

    protected $table = 'allergies';

    protected $allowedColumns = ['allergyID', 'allergenType', 'reactionDescription', 'dateIdentified', 'recordID'];

    public function insertData($data) {
        $this->insert($data);
    }
}
