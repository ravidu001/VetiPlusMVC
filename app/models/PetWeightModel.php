<?php 

class PetWeightModel
{
    use Model;

    protected $table = 'petweight';

    protected $allowedColumns = ['petID', 'appointmentID', 'weight', 'measuredDate'];

    public function insertData($data) {
        $this->insert($data);
    }
}