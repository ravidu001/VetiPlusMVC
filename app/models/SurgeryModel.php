<?php 

class SurgeryModel
{
    use Model;

    protected $table = 'surgery';

    protected $allowedColumns = ['surgeryID', 'surgeryName', 'description', 'datePerformed', 'recordID'];

    public function insertData($data) {
        $this->insert($data);
    }

    public function getSurgeryData() {
        $this->limit = 100;
        $this->order_column = 'surgeryID';
        $this->order_type = 'DESC';
        return $this->findAll();
    }
}