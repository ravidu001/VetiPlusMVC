<?php

class AssistantSessionModel {
    use Model;

    protected $table = 'assistantSession';

    protected $allowedColumns = ['sessionID', 'assistantID','status', 'comment', 'rating', 'dateTime'];

    public function insertData($data) {
        $this->insert($data);
    }

}