<?php 

class MedicalRecordModel 
{
    use Model;

    protected $table = 'medicalrecord';

    protected $allowedColumns = ['recordID', 'symptom', 'date_administered', 'doctorID', 'assistantID', 'petID', 'appointmentID'];

    public function insertData($data) {
        $this->insert($data);
    }

    public function getMedicalID($conditions) {
        $this->order_column = 'recordID';
        $this->order_type = 'DESC';
        return $this->where(['appointmentID' => $conditions['appointmentID'], 'petID' => $conditions['petID']]);
    }

    public function getMedicalbypetID($petID) {
        $this->limit = 1000;
        $this->order_column = 'recordID';
        $this->order_type = 'DESC';
        return $this->where(['petID' => $petID]);
    }
}
