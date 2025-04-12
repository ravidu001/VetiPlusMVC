<?php

class SalonHoliday
{
    use Model;

    protected $table = 'holiday';

    //insert the data
    public function insertData($array)
    {
        return $this->insert($array);  
    }

    public function FindHolidays()
    {
        $this->order_column = 'holiday_id';
        return $this->findAll('holiday_id');
    }

    public function findHolidayByDate($date)
    {
        $this->order_column = 'holiday_id';
        return $this->where(['date' => $date]);
    }

    public function findDateAndID($salonID, $date)
    {
        $this->order_column = 'holiday_id';
        return $this->where(['date' => $date, 'salonID' => $salonID]);
    }

    public function deleteHoliday($holidayID)
    {
        $this->delete($holidayID, 'holiday_id');
        return true;
    }

}    