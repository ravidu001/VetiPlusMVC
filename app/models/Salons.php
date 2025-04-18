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
       $this->order_column = 'salonID'; 
       return $this->update( $salonID , $data , 'salonID');
    }

    //delete salon profile picture
    public function DeleteProfile($salonID)
    {
        return $this->deleteOne( $salonID, 'profilePicture', 'salonID');
    }

    //insert the data in to the table
    public function insertData($arr)
    {
        return $this->insert($arr);
    }
}

