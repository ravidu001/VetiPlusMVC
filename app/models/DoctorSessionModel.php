<?php

class DoctorSessionModel {
    use Model;

    protected $table = 'session';

    protected $allowedColumns = ['sessionID', 'selectedDate', 'startTime', 'endTime','noOfAppointments', 'publishedTime', 'clinicLocation', 'district', 'assistantID', 'doctorID', 'note', 'completeStatus'];

    public function insertData($data) {
        $this->insert($data);
    }

    public function lastID() {
        $this->order_column = 'sessionID';
        $this->limit = 1;
        $result = $this->findAll();

        return $result[0]->sessionID;
    }

    public function getsession($doctorID) {
        $this->order_column = 'selectedDate';
        $this->order_type = 'asc';
        $this->limit = 1000;
        $result = $this->where(['doctorID' => $doctorID]);

        return $result;
    }

    public function getsessionBySession($sessionID) {
        $this->order_column = 'selectedDate';
        $this->order_type = 'asc';
        $this->limit = 1000;
        $result = $this->where(['sessionID' => $sessionID]);

        return $result;
    }

    public function deleteold($sessionID) {
        if (!is_numeric($sessionID)) {
            throw new InvalidArgumentException('Session ID must be numeric');
        }
    
        return $this->delete($sessionID, 'sessionID');
    }

    public function updatecompleteStatus($sessionID, $data) {
        $this->update($sessionID, $data, 'sessionID');
    }

}

