<?php 

class PrescriptionModel
{
    use Model;

    protected $table = 'prescriptions';

    protected $allowedColumns = ['prescriptionID', 'prescriptionName', 'datePrescribed', 'recordID'];

    public function insertData($data) {
        $this->insert($data);
    }
}