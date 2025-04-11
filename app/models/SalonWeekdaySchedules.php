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

    //FInd the slot by config ID 
    public function FindByConfigId($configID)
    {
        $this->order_column = 'config_id';
        return $this->where(['config_id' => $configID]);
    }

    //find the first SLot by shedule_id
    public function FindSlotByScheduleID($sheduleID)
    {
        $this->order_column = 'config_id';
        return $this->first(['schedule_id' => $sheduleID]);
    }
}    