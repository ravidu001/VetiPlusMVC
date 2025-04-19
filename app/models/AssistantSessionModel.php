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
        // Validate inputs
        if (!is_numeric($sessionID) || is_numeric($assistantID)) {
            throw new InvalidArgumentException('SessionID and AssistantID must be numeric');
        }
        
        // Build the query to update based on both keys
        $query = "UPDATE {$this->table} SET ";
        $params = [];
        
        foreach ($data as $key => $value) {
            $query .= "{$key} = ?, ";
            $params[] = $value;
        }
        
        // Remove trailing comma and space
        $query = rtrim($query, ", ");
        
        // Add WHERE clause for composite key
        $query .= " WHERE sessionID = ? AND assistantID = ?";
        $params[] = $sessionID;
        $params[] = $assistantID;
        
        // Execute the query
        $this->query($query, $params);
        
        return true;
    }

}