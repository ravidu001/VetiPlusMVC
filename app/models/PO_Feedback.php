<?php

class PO_Feedback {
    use Model;

    protected $table;
    protected $allowedColumns = [
        'petOwnerID', 'rating', 'comment'
    ];

    public function postFeedback ($type, $data) {

        if ($type === 'vet') {
            $this->table = 'vetfeedback';
            $otherCols = ['appointmentID', 'doctorID'];
        } elseif ($type === 'salon') {
            $this->table = 'salonfeedback';
            $otherCols = ['groomingID', 'salonID'];
        }

        $this->allowedColumns = array_merge($this->allowedColumns, $otherCols);

        $postSuccess = $this->insert($data);
        return empty($postSuccess) ? true : false;
    }
}