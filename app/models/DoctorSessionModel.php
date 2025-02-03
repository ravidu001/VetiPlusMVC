<?php

class DoctorSessionModel {
    use Model;

    protected $table = 'session';

    protected $allowedColumns = ['sessionID', 'selectedDate', 'startTime', 'endTime', 'publishedTime', 'clinicLocation', 'district', 'assistantID', 'doctorID', 'note'];

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

}

