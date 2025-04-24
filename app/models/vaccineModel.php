<?php 

class VaccineModel
{
    use Model;

    protected $table = 'vaccine';

    protected $allowedColumns = ['vaccinationID', 'status', 'nextDate', 'vaccinatedDate', 'recordID', 'newRecordID', 'vaccineID', 'petID'];

    public function getVaccineBypetID($petID)
    {
        $this->order_column = 'vaccinationID';
        $this->order_type = 'ASC';
        return $this->where(['petID' => $petID]); // what this return is an array of pet
    }
    
    public function getVaccineBypetIDDECS($petID)
    {
        $this->limit = 1000;
        $this->order_column = 'vaccinationID';
        $this->order_type = 'DESC';
        return $this->where(['petID' => $petID]); // what this return is an array of pet
    }

    public function insertData($data) {
        $this->insert($data);
    }

    public function updatevaccine($vaccinationID, $vaccine) {
        return $this->update($vaccinationID, ['status'=>$vaccine['status'], 'vaccinatedDate'=>$vaccine['vaccinatedDate'], 'newRecordID'=>$vaccine['newRecordID']], 'vaccinationID');
    }
}
