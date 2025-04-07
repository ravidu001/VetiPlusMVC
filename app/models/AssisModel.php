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
        'certificateNumber',
        'expertise',
        'experience',
        'chargePerHour',
        'languageSpoken',
        'certificate',
        'status'
    ];

    public function find($assistantID) {
        // $this->order_column = 'assistantID';
        $result = $this->first(['assistantID' => $assistantID]);
    
        // Return the first record if the result is not empty
        if (!empty($result)) {
            return $result; // Get the first record
        } else {
            return false; // No record found
        }
    }

    public function updateProfile($assisID, $data) {
        $this->update($assisID, $data, 'assistantID');
    }

    // Get all assistants by district
    public function getAssistantsByDistrict($district) {
        $result = $this->where(['district' => $district]);
        return $result;
    }

    public function getAssistant($assistantID) {
        $result = $this->where(['assistantID' => $assistantID]);
        
        // Return the first result if it exists, otherwise return null
        return !empty($result) ? $result[0] : null;
    }

}