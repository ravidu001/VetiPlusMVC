<?php

class SalonWeekdaySchedules 
{
    use Model;

    protected $table = 'salonweekdayschedule';

    //insert the data
    public function InsertData($array)
    {
        return $this->insert($array);
        
    }

}    