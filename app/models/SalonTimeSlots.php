<?php

class SalonTimeSlots {
    use Model;
    use Database;
    
    protected $table = 'salonsession';

    // Add a method to insert a new session
    public function addSession($data) {
        return $this->insert($data);
    }

    // Find slots by date
    public function findSlotsbyDate($openday) {
        $this->order_column = 'openday';
        return $this->where(['openday' => $openday]);
    }

    // Find slots by ID
    public function getSlotDetails($salSessionID) {
        $this->order_column = 'salSessionID';
        return $this->first(['salSessionID' => $salSessionID]);
    }

    //find the all data in the table
    public function finAllDetails()
    {
        $this->order_column = 'openday';
        return $this->findAll();
    }

    // Update slot status (available <-> blocked)
    public function updateSlotStatus($salSessionID, $newStatus) {
        return $this->update($salSessionID, ['status' => $newStatus], 'salSessionID');
    }

    //Create the function to delete all slots per holidays
    public function deleteAllSlots($salSessionID)
    {
        return $this->delete($salSessionID, 'salSessionID');
    }
}
