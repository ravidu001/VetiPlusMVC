<?php

class SalonFeedbacks
{
    use Model;

    protected $table = 'salonfeedback'; // Feedback table name

    /**
     * Get feedback details with pet owner details.
     */
    public function getFeedbackData()
    {
        $query = "
            SELECT 
                 salonfeedback.*, 
                petowner.fullName AS fullName, 
                petowner.profilePicture  AS profilePicture 
            FROM 
                $this->table 
            LEFT JOIN 
                petowner 
            ON 
                 salonfeedback.petownerID = petowner.petownerID
        ";
        return $this->query($query);
    }

    /**
     * Insert new feedback data.
     */
    public function addFeedback($data)
    {
        return $this->insert($data);
    }

    /**
     * Update existing feedback.
     */
    public function updateFeedback($feedbackID, $data)
    {
        return $this->update($feedbackID, $data, 'feedbackID');
    }

    /**
     * Delete feedback by ID.
     */
    public function deleteFeedback($feedbackID)
    {
        return $this->delete($feedbackID, 'feedbackID');
    }

    /**
     * Find all feedback with sorting options.
     */
    public function findAllFeedback()
    {
        $this->order_column = 'feedbackID';
        return $this->findAll();
    }

    /**
     * Get feedback by specific conditions.
     */
    public function whereFeedback($conditions, $notConditions = [])
    {
        return $this->where($conditions, $notConditions);
    }
}
