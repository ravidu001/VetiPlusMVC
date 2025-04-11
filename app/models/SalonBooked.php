<?php

class SalonBooked
{
    use Model;

    protected $table = 'groomingsession';

    public function FindBookedDetails()
    {
        $this->order_column = 'groomingID';
        return $this->FindAll();
    }

    // Find slots by salonsessionID
    public function getSlotDetails($salSessionID) {
        $this->order_column = 'salSessionID';
        return $this->first(['salSessionID' => $salSessionID]);
    }


    // Find slots by salonsessionID
    public function getSlotDetailsByID($salSessionID) {
        $this->order_column = 'salSessionID';
        return $this->where(['salSessionID' => $salSessionID, 'status' => 0]);
    }
   

    // Find slots by salonsessionID
    public function  getCancelDetailsByID($salSessionID) {
        $this->order_column = 'salSessionID';
        return $this->where(['salSessionID' => $salSessionID, 'status' => 2]);
    }

    // Find slots by salonsessionID
    public function getCompleteDetailsByID($salSessionID) {
        $this->order_column = 'salSessionID';
        return $this->where(['salSessionID' => $salSessionID, 'status' => 1]);
    }

    //get details using the grooming ID
    public function getDEtailsByGroomingID($groomingID)
    {
        $this->order_column = 'groomingID';
        return $this->first(['groomingID' => $groomingID]);
    }
    
    //get details by status and id
    public function getSlotDetailsByStatusAndDate($id, $status)
    {
        $this->order_column = 'groomingID';
        return $this->first(['salsessionID'=> $id, 'status' => $status]);
    }

    public function updateStatus($groomingID, $data)
    {
        return $this->update($groomingID, $data, 'groomingID');
    }

}