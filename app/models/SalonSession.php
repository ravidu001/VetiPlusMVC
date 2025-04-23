<?php

class SalonSession {
    use Model;

    protected $table = 'salonsession';

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
                            noOfAvailable = noOfAvailable - 1
                            WHERE salSessionID = :salSessionID
                        ";
        $updateDone = $this->query($updateQuery, ['salSessionID' => $salSessionID]);
        return empty($updateDone) ? true : false;
    }

}