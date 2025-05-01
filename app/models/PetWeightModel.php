<?php 

class PetWeightModel
{
    use Model;

    protected $table = 'petweight';

    protected $allowedColumns = ['petID', 'appointmentID', 'weight', 'measuredDate'];

    public function insertData($data) {
        $this->insert($data);
    }

    public function getPetWeightData($petID) {
        $this->limit = 1000;
        $this->order_column = 'measuredDate';
        $this->order_type = 'DESC';
        return $this->where(['petID' => $petID]); 
    }
}