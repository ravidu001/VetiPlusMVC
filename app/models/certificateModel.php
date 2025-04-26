<?php

class CertificateModel {
    use Model;

    protected $table = 'certificate';

    protected $allowedColumns = ['certificateNo', 'examinationDate','vaccinationStatus', 'followUpAppointment', 'healthRate', 'recommendation', 'expiryDate', 'petID', 'doctorID', 'lnumber', 'fullName'];

    public function create($data) {
        return $this->insert($data);
    }

    public function getCertificateByPetID($petID) {
        $this->order_column = 'certificateNo';
        $this->order_type = 'desc';
        $this->limit = 1;
        return $this->where(['petID' => $petID]);
    }

}