<?php 

class SurgeryModel
{
    use Model;

    protected $table = 'surgery';

    protected $allowedColumns = ['surgeryID', 'surgeryName', 'description', 'datePerformed', 'recordID'];

    public function insertData($data) {
        $this->insert($data);
    }
}