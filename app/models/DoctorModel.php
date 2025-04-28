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
    
    public function doctorcount()
    {
        $count = $this->getCount();
        return $count;  

    }

    public function find($doctorID) {
        $result = $this->first(['doctorID' => $doctorID]);
    
        if (!empty($result)) {
            return $result; 
        } else {
            return false; 
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
        $this->order_column = 'doctorID';
        return $this->where(['doctorID' => $email]); 
        
    }

    public function updateStatus($doctorID, $data) {
        $this->update($doctorID, ['approvedStatus'=>$data['approvedStatus'],'rejectReason'=>$data['rejectReason']], 'doctorID');
    }
    public function pendingvetdoctorcount()
    {
        $query = "SELECT COUNT(*) as total FROM $this->table WHERE approvedStatus = 'pending'";
        $result = $this->query($query);
        return $result[0]->total;
    }

}

