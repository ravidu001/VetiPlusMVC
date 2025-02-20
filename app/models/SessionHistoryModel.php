<?php

class SessionHistoryModel {
    use Model;

    protected $table = 'sessionHistory';

    protected $allowedColumns = ['sessionID', 'selectedDate', 'startTime', 'endTime', 'publishedTime', 'clinicLocation', 'district', 'doctorID', 'note'];

    public function insertData($data) {
        $this->insert($data);
    }
}