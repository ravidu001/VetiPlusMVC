<?php

class AssistantSessionModel {
    use Model;

    protected $table = 'assistantSession';

    protected $allowedColumns = ['sessionID', 'assistantID','status', 'comment', 'rating', 'dateTime', 'feedbackDateTime', 'action'];

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

    public function getSessionByAssistant($assisId) {
        $this->order_column = 'sessionID';
        $this->order_type = 'asc';
        $this->limit = 100;
        $result = $this->where(['assistantiD' => $assisId]);

        return $result;
    }

    public function getReviewsByAssisId($assisId) {
        $this->order_column = 'sessionID';
        $this->order_type = 'asc';
        $this->limit = 100;
        $result = $this->where(['assistantiD' => $assisId]);

        return $result;
    }

    public function updateWithCompositeKey($sessionID, $assistantID, $data) {
        if (!is_numeric($sessionID) || is_numeric($assistantID)) {
            throw new InvalidArgumentException('SessionID and AssistantID must be numeric');
        }
        
        $query = "UPDATE {$this->table} SET ";
        $params = [];
        
        foreach ($data as $key => $value) {
            $query .= "{$key} = ?, ";
            $params[] = $value;
        }
        
        $query = rtrim($query, ", ");
        
        $query .= " WHERE sessionID = ? AND assistantID = ?";
        $params[] = $sessionID;
        $params[] = $assistantID;
        
        $this->query($query, $params);
        
        return true;
    }

}