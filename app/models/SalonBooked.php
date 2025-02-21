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
    
}