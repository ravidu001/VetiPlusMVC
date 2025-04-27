<?php

class Salons 
{
    use Model;

    protected $table = 'salon';

    //find the user email has or not 
    public function FindUser($salonId)
    {
        //if has return the row of the user data
        return $this->first(['salonID' => $salonId]);
    }

    //update the salon time details
    public function updateSalonTimeSlots($salonID, $data)
    {
       $this->order_column = 'salonID'; 
       return $this->update( $salonID , $data , 'salonID');
    }

    //delete salon profile picture
    public function DeleteProfile($salonID)
    {
        return $this->deleteOne( $salonID, 'profilePicture', 'salonID');
    }

    //insert the data in to the table
    public function insertData($arr)
    {
        return $this->insert($arr);
    }

    ///check by br number
    public function fetchByBrNumber($number) 
    {
        $this->order_column = "salonID";
        return $this->where(['BRNumber' => $number]);
    }

    public function salonCount(){
        $count = $this->getCount();
        return $count;
    }
    public function getalldata() {
        $this->order_type = "desc";
        $this->order_column = "salonID";
        return $this->findAll();
    }
    public function updateStatus($salonID, $data) {
        $this->update($salonID, ['approvedStatus'=>$data['approvedStatus'],'rejectReason'=>$data['rejectReason']], 'salonID');
    }

    public function getActiveList_salon () {
        $query = "SELECT s.name as salonName
                    FROM salon s INNER JOIN user u ON u.email = s.salonID
                    WHERE u.activeStatus = 'active'
                    AND s.approvedStatus = 'accepted'
                ";

        return $this->query($query);
    }
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
                    AND s.approvedStatus = 'accepted'
                    GROUP BY s.salonID
                    ORDER BY (s.name LIKE :salonName) DESC,
                            (s.open_time <= :openHour AND s.close_time >= :openHour) DESC
                ";
        
        $params = [
            'salonName' => isset($options['salonName']) ? '%'.$options['salonName'].'%' : '%'
            
        ];
        return $this->query($query, $params);
    }
    public function pendingsaloncount(){
        $query = "SELECT COUNT(*) as total FROM $this->table WHERE approvedStatus = 'pending'";
        $result = $this->query($query);
        return $result[0]->total;
    }
}

