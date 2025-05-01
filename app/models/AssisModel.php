<?php

class AssisModel {
    use Model;

    protected $table = 'vetAssitance';

    protected $allowedColumns = [
        'ID',
        'assistantID',
        'fullName',
        'profilePicture',
        'contactNumber',
        'address',
        'DOB',
        'gender',
        'district',
        'bio',
        'certificateNumber',
        'expertise',
        'experience',
        'chargePerHour',
        'languageSpoken',
        'certificate',
        'status'
    ];

    public function find($assistantID) {
        $result = $this->first(['assistantID' => $assistantID]);
    
        if (!empty($result)) {
            return $result; 
        } else {
            return false; 
        }
    }

    public function create($data) {
        $this->insert($data);
    }

    public function updateProfile($assisID, $data) {
        $this->update($assisID, $data, 'assistantID');
    }

    public function getAssistantsByDistrict($district) {
        $result = $this->where(['district' => $district]);
        return $result;
    }

    public function getAssistant($assistantID) {
        $result = $this->where(['assistantID' => $assistantID]);
        
        return !empty($result) ? $result[0] : null;
    }

}