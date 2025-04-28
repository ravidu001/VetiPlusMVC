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

    public function getDetailsByStatus($status)
    {
        $this->order_column = 'groomingID';
        return $this->where(['status' => $status]);
    }

    public function getSlotDetails($salSessionID) {
        $this->order_column = 'salSessionID';
        return $this->first(['salSessionID' => $salSessionID]);
    }


    public function getSlotDetailsByID($salSessionID) {
        $this->order_column = 'salSessionID';
        return $this->where(['salSessionID' => $salSessionID, 'status' => 0]);
    }
   

    public function  getCancelDetailsByID($salSessionID) {
        $this->order_column = 'salSessionID';
        return $this->where(['salSessionID' => $salSessionID, 'status' => 2]);
    }

    public function getCompleteDetailsByID($salSessionID) {
        $this->order_column = 'salSessionID';
        return $this->where(['salSessionID' => $salSessionID, 'status' => 1]);
    }

    public function getDEtailsByGroomingID($groomingID)
    {
        $this->order_column = 'groomingID';
        return $this->first(['groomingID' => $groomingID]);
    }
    
    public function getSlotDetailsByStatusAndDate($id, $status)
    {
        $this->order_column = 'groomingID';
        return $this->first(['salsessionID'=> $id, 'status' => $status]);
    }

    public function updateStatus($groomingID, $data)
    {
        return $this->update($groomingID, $data, 'groomingID');
    }

    public function getCompletedAppointmentsCount($salonID)
    {
        $query = "SELECT COUNT(*) as total 
                FROM groomingsession gs
                JOIN salonsession ss ON gs.salSessionID = ss.salSessionID
                WHERE ss.salonID = :salonID AND gs.status = 2";
        
        return $this->query($query, ['salonID' => $salonID])[0]->total ?? 0;
    }

    public function getCompletedCountBySlot($salSessionID) 
    {
        $query = "SELECT COUNT(*) as total 
        FROM groomingsession 
        WHERE salSessionID = :salSessionID AND status = 2";
        return $this->query($query, ['salSessionID' => $salSessionID])[0]->total ?? 0;
    }
    
    public function bookAppointment ($data) {
        $bookingSuccess = $this->insert($data);
        return empty($bookingSuccess) ? true : false;
    }

}