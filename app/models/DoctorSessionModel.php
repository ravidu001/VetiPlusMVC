<?php

class DoctorSessionModel {
    use Model;

    protected $table = 'session';

    protected $allowedColumns = ['sessionID', 'selectedDate', 'startTime', 'endTime', 'publishedTime', 'clinicLocation', 'district', 'assistantID', 'doctorID', 'note', 'completeStatus'];

    public function insertData($data) {
        $this->insert($data);
    }

    public function lastID() {
        // need a query to get the last inserted ID
        $this->order_column = 'sessionID';
        $this->limit = 1;
        $result = $this->findAll();

        return $result[0]->sessionID;
    }

    public function getsession($doctorID) {
        $this->order_column = 'selectedDate';
        $this->order_type = 'asc';
        $this->limit = 100;
        $result = $this->where(['doctorID' => $doctorID]);

        return $result;
    }

    // this function is used to get the session details by sessionID
    public function getsessionBySession($sessionID) {
        $this->order_column = 'selectedDate';
        $this->order_type = 'asc';
        $result = $this->where(['sessionID' => $sessionID]);

        return $result;
    }

    public function deleteold($sessionID) {
        if (!is_numeric($sessionID)) {
            throw new InvalidArgumentException('Session ID must be numeric');
        }
    
        // Call the delete method
        return $this->delete($sessionID, 'sessionID');
    }

    public function updatecompleteStatus($sessionID, $data) {
        $this->update($sessionID, $data, 'sessionID');
    }

}

