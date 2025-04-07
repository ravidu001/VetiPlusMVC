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
    ];

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

}

