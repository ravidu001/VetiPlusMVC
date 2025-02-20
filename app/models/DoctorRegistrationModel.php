<?php

class DoctorRegistrationModel {
    use Model;

    protected $table = 'vetDoctorRegistration';

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
        'status'
    ];

    public function create($data) {
        $this->insert($data);
    }

}
