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
        try {
            $result = $this->delete($serviceID, 'serviceID');
            return true; // Successful deletion
    
        } catch (Exception $e) {
            // Log the error if needed
            return false; // Deletion failed
        }
    }

    public function serviceupdate($serviceID, $data)
    {
       return $this->update($serviceID,$data, 'serviceID');
    }

    public function findAllServiceId($salonID)
    {
        $this->order_column = 'serviceID';
        return $this->where(['salonID' => $salonID]);
    }
}

