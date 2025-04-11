<?php 

class VetFeedbackModel
{
    use Model;

    protected $table = 'vetFeedback';

    protected $allowedColumns = ['feedbackID', 'rating', 'feedbackDateTime', 'status', 'comment', 'respond', 'respondDateTime', 'appointmentID', 'petOwnerID', 'doctorID'];

    public function getReviewsByDoctorId($doctorId)
    {
        $this->limit = 100;
        $this->offset = 0;
        $this->order_type = "desc";
        $this->order_column = "feedbackDateTime";
        return $this->where(['doctorID' => $doctorId]);  
    }

    public function saveReply($feedbackID, $replyContent)
    {
        // Prepare the data to be updated
        $data = [
            'respond' => $replyContent,
            'status' => 1, // Assuming 1 means replied
            'respondDateTime' => date('Y-m-d H:i:s') // Current date and time
        ];

        // Update the record in the database
        return $this->update($feedbackID, ['status' => $data['status'], 'respond' => $data['respond'], 'respondDateTime' => $data['respondDateTime'] ], 'feedbackID');
    }
}

