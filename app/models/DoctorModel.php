<?php

class DoctorModel {
    use Model;

    protected $table = 'vetDoctor';

    protected $allowedColumns = [
        'doctorID',
        'fullName',
        'profilePicture',
        'contactNumber',
        'address',
        'DOB',
        'gender',
        'bio',
        'experience',
        'lnumber',
        'doctorCertificate',
        'timeSlot',
        'specialization',
        'approvedStatus',
        'rejectReason',
        'registeredDate'
    ];

    public function getalldata() {
        $this->order_type = "desc";
        $this->order_column = "doctorID";
        return $this->findAll();
    }

    public function find($doctorID) {
        // $this->order_column = 'doctorID';
        $result = $this->first(['doctorID' => $doctorID]);
    
        // Return the first record if the result is not empty
        if (!empty($result)) {
            return $result; // Get the first record
        } else {
            return false; // No record found
        }
    }

    public function create($data) {
        $this->insert($data);
    }

    public function updateProfile($doctorID, $data) {
        $this->update($doctorID, $data, 'doctorID');
    }

    public function checkUser($email)
    {
        // echo $email;
        $this->order_column = 'doctorID';
        // $result = $this->where(['email' => $email]);
        return $this->where(['doctorID' => $email]); // what this return is an array of user
        // if($result) {
        //     return true;
        // } else {
        //     return false;
        // } 
    }

    public function updateStatus($doctorID, $data) {
        $this->update($doctorID, ['approvedStatus'=>$data['approvedStatus'],'rejectReason'=>$data['rejectReason']], 'doctorID');
    }

}

