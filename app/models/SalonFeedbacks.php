<?php 

class SalonFeedbacks
{
    use Model;

    protected $table = 'salonfeedback';

    protected $allowedColumns = ['feedbackID', 'rating', 'feedbackDateTime', 'status', 'comment', 'response', 'responseDateTime', 'groomingID', 'petOwner', 'salonID'];

    public function getReviewsBySalonID($salonID)
    {
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
        $data = [
            'response' => $replyContent,
            'status' => 1, 
            'responseDateTime' => date('Y-m-d H:i:s') 
        ];

        return $this->update($feedbackID, [
            'status' => $data['status'], 
            'response' => $data['response'], 
            'responseDateTime' => $data['responseDateTime']
        ], 'feedbackID');
        
    }
}

