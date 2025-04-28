<?php

class SalonSession {
    use Model;

    protected $table = 'salonsession';

    public function __construct() {
        $this->order_column = 'salSessionID';
        $this->limit = 30;
    }

    public function getOpenDays ($salonID) {
        $query = "SELECT DISTINCT openday from salonsession
                    WHERE salonID = :salonID
                ";
                
        return $this->query($query, ['salonID' => $salonID]);
    }

    public function getSlots_byDate ($salonID, $date) {
        $params = [
            'salonID' => $salonID,
            'openday' => $date
        ];
        $result = $this->where($params);
        return $result;
    }

    public function updateBookingsCount ($salSessionID) {
        $updateQuery = " UPDATE salonsession SET
                            noOfBookings = noOfBookings + 1,
                            noOfAvailable = CASE 
                                WHEN noOfAvailable > 0 THEN noOfAvailable - 1 
                                ELSE 0 
                                END
                            WHERE salSessionID = :salSessionID
                        ";
        $updateDone = $this->query($updateQuery, ['salSessionID' => $salSessionID]);
        return ($updateDone) ? true : false;
    }

    


}