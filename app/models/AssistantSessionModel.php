<?php

class AssistantSessionModel {
    use Model;

    protected $table = 'assistantSession';

    protected $allowedColumns = ['sessionID', 'assistantID','status', 'comment', 'rating', 'dateTime'];

    public function insertData($data) {
        $this->insert($data);
    }

    public function getAssistantsession($sessionID) {
        $this->order_column = 'assistantID';
        $this->order_type = 'asc';
        $this->limit = 10;
        $result = $this->where(['sessionID' => $sessionID]);

        return $result;
    }

}