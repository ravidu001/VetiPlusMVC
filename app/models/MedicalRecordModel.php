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


    // for pet:
    public function getRecords_byPet ($petID) {}
    public function getPrescriptions_byPet ($petID) {}
    public function getVaccines_byPet ($petID) {}
    public function getSurgeries_byPet ($petID) {}
}
