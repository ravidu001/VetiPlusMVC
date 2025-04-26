<?php

class SalonSession {
    use Model;

    protected $table = 'salonsession';

    public function getSalons ($options) {
        $query = "SELECT 'salon' as type,
                    s.*,
                    s.profilePicture as providerPic,
                    AVG(sf.rating) as avgRating

                    FROM salon s
                    LEFT JOIN salonsession ss ON ss.salonID = s.salonID
                    LEFT JOIN salonfeedback sf ON ss.salonID = sf.salonID
                    INNER JOIN user u ON u.email = s.salonID

                    WHERE ss.noOfAvailable > 0
                    AND u.activeStatus = 'active'
                    GROUP BY s.salonID
                    ORDER BY (s.name LIKE :salonName) DESC,
                            (s.open_time <= :openHour AND s.close_time >= :openHour) DESC
                ";
        
        $params = [
            'salonName' => isset($options['salonName']) ? '%'.$options['salonName'].'%' : '%'
            // 'openHour' => isset($options['openHour']) ? $options['openHour'] : date('H:i')          
        ];
        return $this->query($query, $params);
    }

    public function getSlots_byDate ($salonID, $date) {
        $params = [
            'salonID' => $salonID,
            'openday' => $date
        ];
        $notParams = ['status' => 'blocked'];
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