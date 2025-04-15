<?php 

class SalonFeedbacks
{
    use Model;

    protected $table = 'salonfeedback';

    protected $allowedColumns = ['feedbackID', 'rating', 'feedbackDateTime', 'status', 'comment', 'response', 'responseDateTime', 'groomingID', 'petOwner', 'salonID'];

    public function getReviewsBySalonID($salonID)
    {
        // show($salonId);
        $this->limit = 100;
        $this->offset = 0;
        $this->order_type = "desc";
        $this->order_column = "feedbackDateTime";
        return  $this->where(['salonID' => $salonID]);  
    }

    public function getAllDetails($salonID)
    {
        $this->order_column = "feedbackDateTime";
        return  $this->where(['salonID' => $salonID]); 
    }

    public function saveReply($feedbackID, $replyContent)
    {
        // Prepare the data to be updated
        $data = [
            'response' => $replyContent,
            'status' => 1, // Assuming 1 means replied
            'responseDateTime' => date('Y-m-d H:i:s') // Current date and time
        ];

        // Update the record in the database
        return $this->update($feedbackID, [
            'status' => $data['status'], 
            'response' => $data['response'], 
            'responseDateTime' => $data['responseDateTime']
        ], 'feedbackID');
        
    }
}

