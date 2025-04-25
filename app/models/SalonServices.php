<?php

class SalonServices
{
    use Model;
    use Database;

    protected $table  = 'salonservice';

    public function serviceadd($data)
    {
      return  $this->insert($data);
    }

    public function whereservice($serviceID)
    {
        $this->order_column = 'serviceID';
        return $this->where(['serviceID' => $serviceID]);
    }

    public function servicedelete($serviceID)
    {   
        $this->delete($serviceID, 'serviceID');
        return true; 
    }

    public function serviceupdate($serviceID, $data)
    {
        $this->update($serviceID,$data, 'serviceID');
        return true;
    }

    public function findAllServiceId($salonID)
    {
        $this->order_column = 'serviceID';
        return $this->where(['salonID' => $salonID]);
    }
}

