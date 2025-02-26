<?php

class SalonTImeSLotConfig 
{
    use Model;

    protected $table = 'timeslotconfig';
    // protected $allowedColumns = ['slot_duration_minutes', 'appointments_per_slot', 'slot_creation_frequency'];

    //insert the data in to the table
    // Insert data into the table and return success or failure
    public function insertData($arr)
    {
        try 
        {
            $this->insert($arr);
            return ['success' => true, 'message' => 'Data inserted successfully'];
        }
        catch (Exception $e) 
        {
            return ['success' => false, 'message' => 'Data insertion failed: ' . $e->getMessage()];
        }
    }

    public function getLastInsertedID($salonID)
    {
        $query = "SELECT * FROM $this->table WHERE salonID = :salonID ORDER BY config_id DESC LIMIT 1";
        $result = $this->query($query, ['salonID' => $salonID]);

        return $result;
    }

    //find the details using the config
    public function findById($ConfigID, $salonID)
    {
        $this->order_column = 'config_id';
        return $this->where(['config_id' => $ConfigID,'salonID' => $salonID]);
    }


}    