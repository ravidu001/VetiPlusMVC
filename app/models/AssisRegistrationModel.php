<?php

class AssisRegistrationModel {
    use Model;

    protected $table = 'assistantRegistration';

    protected $allowedColumns = [
        'assistantID',
        'fullName',
        'profilePicture',
        'contactNumber',
        'address',
        'DOB',
        'gender',
        'district',
        'certificateNumber',
        'expertise',
        'experience',
        'chargePerHour',
        'languageSpoken',
        'certificate',
        'status'
    ];

    public function create($data) {
        $this->insert($data);
    }

}