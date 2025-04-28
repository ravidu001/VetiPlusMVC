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

    //Find the details by SalonSessions
    public function getDetailsByStatus($status)
    {
        $this->order_column = 'groomingID';
        return $this->where(['status' => $status]);
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

    //get the count of the complete bookings appointments
    public function getCompletedAppointmentsCount($salonID)
    {
        $query = "SELECT COUNT(*) as total 
                FROM groomingsession gs
                JOIN salonsession ss ON gs.salSessionID = ss.salSessionID
                WHERE ss.salonID = :salonID AND gs.status = 2";
        
        return $this->query($query, ['salonID' => $salonID])[0]->total ?? 0;
    }

    //get the count of complet by the slots
    public function getCompletedCountBySlot($salSessionID) 
    {
        $query = "SELECT COUNT(*) as total 
        FROM groomingsession 
        WHERE salSessionID = :salSessionID AND status = 2";
        return $this->query($query, ['salSessionID' => $salSessionID])[0]->total ?? 0;
    }
    
    public function bookAppointment_andReturnID ($data) {

        $bookingSuccess = $this->insert($data);
        return empty($bookingSuccess) ? true : false;
        
        // if (empty($bookingSuccess)) {
        //     return ['success' => true, 'appointmentID' => $this->getLastID()];
        // } else {
        //     return ['success' => false, 'appointmentID' => ''];
        // }
    }

    public function cancelAppt ($apptID) {
        $cancelSuccess = $this->update($apptID, ['status' => 1], 'groomingID');
        return empty($cancelSuccess) ? true : false;
    }

}