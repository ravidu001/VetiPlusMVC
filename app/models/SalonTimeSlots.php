<?php

class SalonTimeSlots {
    use Model;
    use Database;
    
    protected $table = 'salonsession';

    // Add a method to insert a new session
    public function addSession($data) 
    {
        return $this->insert($data);
    }

    //Find slots using the salonID and date
    public function fetchUpcomingAppointments($salonID, $today, $status)
    {
        $this->order_column = 'openday';
        return $this->where(['openday' => $today, 'salonID' => $salonID, 'status' => $status]);
    }

    //Find slots using the salonID and date
    public function slotsByDateAndSalon($salonID, $today)
    {
        $this->order_column = 'openday';
        return $this->where(['openday' => $today, 'salonID' => $salonID]);
    }


    // Find slots by date
    public function findSlotsbyDate($openday) 
    {
        $this->order_column = 'openday';
        return $this->where(['openday' => $openday]);
    }

    // Find slots by date and staus
    public function findSlotsbyDateAndStatus($openday, $status) {
        $this->order_column = 'openday';
        return $this->where(['openday' => $openday, 'status' => $status]);
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
    public function updateSlotStatus($salSessionID, $newStatus) 
    {
        return $this->update($salSessionID, ['status' => $newStatus], 'salSessionID');
    }

    //Create the function to delete all slots per holidays
    public function deleteAllSlots($salSessionID)
    {
        return $this->delete($salSessionID, 'salSessionID');
    }

    //Find details using the status, salonID, date
    public function FindBooking($salonuser, $holiDate, $status)
    {
        $this->order_column = 'salSessionID';
        return $this->where(['salonID' => $salonuser, 'openday' => $holiDate, 'status' => $status]);
    }

    //Update the status 
    public function updateStatus($salonuser, $date, $status)
    {
        // First, find the ID of the timeslot for this salon and date
        $query = "SELECT * FROM $this->table WHERE salonID = :salonID AND openday = :openday LIMIT 1";
        $params = [
            'salonID' => $salonuser,
            'openday' => $date
        ];
        
        $result = $this->query($query, $params);
    
        if ($result && count($result) > 0) {
            $record = $result[0];
            $id = $record->id;
    
            // Now update the status to 'blocked' using the reusable update method
            $this->update($id, ['status' => $status]);
        }
    }
    
}
