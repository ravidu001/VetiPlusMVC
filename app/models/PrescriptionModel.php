<?php 

class PrescriptionModel
{
    use Model;

    protected $table = 'prescriptions';

    protected $allowedColumns = ['prescriptionID', 'prescriptionName', 'datePrescribed', 'recordID'];

    public function insertData($data) {
        $this->insert($data);
    }

    public function getPrescriptionData() {
        $this->limit = 1000;
        $this->order_column = 'prescriptionID';
        $this->order_type = 'DESC';
        return $this->findAll();
    }
}