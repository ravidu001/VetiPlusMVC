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
        return $this->where(['salSessionID' => $salSessionID]);
    }

    //get details using the grooming ID
    public function getDEtailsByGroomingID($groomingID)
    {
        $this->order_column = 'groomingID';
        return $this->first(['groomingID' => $groomingID]);
    }
    
    public function updateStatus($groomingID, $data)
    {
        return $this->update($groomingID, $data, 'groomingID');
    }
}