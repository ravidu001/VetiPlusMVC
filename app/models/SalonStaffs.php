<?php

class SalonStaffs
{
    use Model;

    protected $table  = 'salonstaff';

    public function staffadd($data)
    {
      return  $this->insert($data);
    }

    public function wherestaff($staffID)
    {
        $this->order_column = 'staffID';
        return $this->where(['staffID' => $staffID]);
    }

    public function deletestaff($staffID)
    {
        return $this->delete($staffID, 'staffID');
    }

    public function updatestaff($staffID, $data)
    {
        return  $this->update($staffID, $data, 'staffID');
    }

    public function findAllstaff()
    {
        $this->order_column = 'staffID';
        return $this->findAll('staffID');
    }
    
}

?>