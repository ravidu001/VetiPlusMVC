<?php

class Salons 
{
    use Model;

    protected $table = 'salon';

    //find the user email has or not 
    public function FindUser($salonId)
    {
        //if has return the row of the user data
        return $this->first(['salonID' => $salonId]);
    }

    //update the salon time details
    public function updateSalonTimeSlots($salonID, $data)
    {
        $this->update( $salonID , $data , 'salonID');
    }
}

?>