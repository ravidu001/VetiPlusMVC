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

    //FInd the slot by config ID and Status
    public function findByConfigIDStatus($configID, $status)
    {
        $this->order_column = 'config_id';
        return $this->where(['config_id' => $configID, 'is_closed' => $status]);
    }

    //find the first SLot by shedule_id
    public function FindSlotByScheduleID($sheduleID)
    {
        $this->order_column = 'config_id';
        return $this->first(['schedule_id' => $sheduleID]);
    }

    public function getLastInsertedWeekday($config_id)
    {
        $query = "SELECT * FROM $this->table WHERE config_id = :config_id ORDER BY schedule_id DESC LIMIT 1";
        $result = $this->query($query, ['config_id' => $config_id]);
        return $result;
    }


    //find the config id and date
    public function findByDayANdConfidID($configID, $day)
    {
        $this->order_column = 'config_id';
        return $this->first(['config_id' => $configID, 'date' => $day]);

    }

    //find the details by date
    public function findByDate($date)
    {
        $this->order_column = 'schedule_id';
        return $this->where(['date' => $date]);
    }
}    