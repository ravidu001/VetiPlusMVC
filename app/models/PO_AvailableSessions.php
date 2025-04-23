<?php

class PO_AvailableSessions {
    use Model;

    public function getActiveList_vet () {
        $query = "SELECT v.fullName as docName
                    FROM vetdoctor v INNER JOIN user u ON u.email = v.doctorID
                    WHERE u.activeStatus = 'active'
                ";

        return $this->query($query);
    }
    public function getActiveList_salon () {
        $query = "SELECT s.name as salonName
                    FROM salon s INNER JOIN user u ON u.email = s.salonID
                    WHERE u.activeStatus = 'active'
                ";

        return $this->query($query);
    }
    public function getSpecificSession_vet ($doctorID, $sessionID) {
        $query = "SELECT 'vet' as type,
                    s.sessionID as sessionID,
                    s.selectedDate as sessDate,
                    CONCAT(s.selectedDate, ' ', s.startTime) as sessStartDateTime,
                    CONCAT(s.selectedDate, ' ', s.endTime) as sessEndDateTime,

                    s.clinicLocation as mapLocation, 
                    s.district as district, 
                    s.note as sessNote, 
                    s.doctorID as doctorID, 

                    v.fullName as providerName,
                    v.profilePicture as providerPic,
                    v.bio as details,
                    v.specialization as doctorSpecialization,
                    AVG(vf.rating) as avgRating,
                    s.noOfAppointments - (
                        SELECT COUNT(*) 
                        FROM appointment a1 INNER JOIN session s2 ON a1.sessionID = s2.sessionID
                        WHERE a1.sessionID = s.sessionID
                        AND a1.status = 'available'
                    ) as availApptCount,
                    s.noOfAppointments as totApptCount,
                    v.timeSlot as slotDuration

                    FROM session s
                    INNER JOIN vetdoctor v ON s.doctorID = v.doctorID
                    LEFT JOIN vetfeedback vf ON s.doctorID = vf.doctorID
                    INNER JOIN user u ON u.email = v.doctorID
                    WHERE v.doctorID = :doctorID
                    AND s.sessionID = :sessionID
                ";
        $params = [
            'doctorID' => $doctorID, 
            'sessionID' => $sessionID
        ];
        return $this->query($query, $params)[0];
    }

    public function getSessions_vet ($options) {
        $query = "SELECT 'vet' as type,
                    s.sessionID as sessionID,
                    s.selectedDate as sessDate,
                    CONCAT(s.selectedDate, ' ', s.startTime) as sessStartDateTime,
                    CONCAT(s.selectedDate, ' ', s.endTime) as sessEndDateTime,

                    s.clinicLocation as mapLocation, 
                    s.district as district, 
                    s.note as sessNote, 
                    s.doctorID as doctorID, 

                    v.fullName as providerName,
                    v.profilePicture as providerPic,
                    v.bio as details,
                    v.specialization as doctorSpecialization,
                    AVG(vf.rating) as avgRating,
                    s.noOfAppointments - (
                        SELECT COUNT(*) 
                        FROM appointment a1 INNER JOIN session s2 ON a1.sessionID = s2.sessionID
                        WHERE a1.sessionID = s.sessionID
                        AND a1.status = 'available'
                    ) as availApptCount,
                    v.timeSlot as slotDuration

                    FROM session s
                    INNER JOIN vetdoctor v ON s.doctorID = v.doctorID
                    LEFT JOIN vetfeedback vf ON s.doctorID = vf.doctorID
                    INNER JOIN user u ON u.email = v.doctorID
                    WHERE s.completeStatus = '0'
                    AND s.selectedDate >= CURRENT_DATE
                    AND (s.selectedDate > CURRENT_DATE OR s.startTime >= CURRENT_TIME)
                    AND (
                        SELECT COUNT(*) 
                        FROM appointment a2 INNER JOIN session s3 ON a2.sessionID = s3.sessionID
                        WHERE a2.sessionID = s.sessionID
                        AND a2.status = 'available'
                    ) < s.noOfAppointments
                    AND u.activeStatus = 'active'
                    GROUP BY s.sessionID
                    ORDER BY (v.fullName LIKE :docName) DESC,
                            (s.selectedDate = :selectedDate) DESC,
                            (s.district LIKE :district) DESC,
                            (s.startTime >= :startTime) DESC
                ";
        
        $params = [
            'docName' => '%'.$options['docName'].'%',
            'selectedDate' => $options['selectedDate'],
            'district' => '%'.$options['district'].'%',
            'startTime' => $options['startTime']
        ];
        return $this->query($query, $params);
    }

    public function checkBookedApptSlots_vet ($sessionID) {
        $query = "SELECT a.visitTime
                    FROM appointment a
                    WHERE a.sessionID = :sessionID
            ";
        return $this->query($query, ['sessionID' => $sessionID]);
    }





    private function getSessions_salon () {
        $query = "SELECT 'salon' as type,
                    ss.sessionID as sessID, 
                    ss.openday as sessDate, 
                    TRIM(SUBSTRING_INDEX(time_slot, '-', 1)) AS sessStartTime,
                    TRIM(SUBSTRING_INDEX(time_slot, '-', -1)) AS sessEndTime

                    s.address as salonAddress,
                    ss.noOfAvailable as availApptCount,
                    ss.salonID as salonID, 

                    s.name as providerName,
                    s.open_time as salonOpenTime,
                    s.close_time as salonCloseTime,
                    s.phoneNumber as salonPhoneNumber,
                    s.GMapLocation as mapLocation,
                    s.profilePicture as providerPic,
                    s.salonDetails as details,
                    s.salonType as salonType,

                    AVG(sf.rating) as avgRating

                    FROM salonsession ss
                    INNER JOIN salon s ON ss.salonID = s.salonID
                    INNER JOIN salonfeedback sf ON ss.salonID = sf.salonID
                    INNER JOIN user u ON u.email = s.salonID
                    WHERE ss.status = 'available' OR ss.status = 'booked'
                    AND ss.openday >= CURRENT_DATE
                    AND TRIM(SUBSTRING_INDEX(time_slot, '-', 1)) >= CURRENT_TIME
                    AND ss.noOfAvailable > 0
                    AND u.activeStatus = 'active'
                ";
        
        return $this->query($query);
    }



}