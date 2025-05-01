<?php

class PO_VetSession {
    use Model;

    public function getActiveList_vet () {
        $query = "SELECT v.fullName as docName
                    FROM vetdoctor v INNER JOIN user u ON u.email = v.doctorID
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
                    AND s.doctorID = COALESCE(:doctorID, s.doctorID)
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
                            (s.startTime <= :startTime AND :startTime <= s.endTime) DESC
                ";
        
        $params = [
            'docName' => isset($options['docName']) ? '%'.$options['docName'].'%' : '%',
            'selectedDate' => isset($options['selectedDate']) ? $options['selectedDate'] : '%',
            'district' => isset($options['district']) ? '%'.$options['district'].'%' : '%',
            'startTime' => isset($options['startTime']) ? $options['startTime'] : '%',
            'doctorID' => isset($options['doctorID']) ? $options['doctorID'] : null
        ];
        return $this->query($query, $params);
    }

    public function getSessions_specificVet ($doctorID) {
        $params = ['doctorID' => $doctorID];

        $result = $this->getSessions_vet($params);
        return $result;
    }
    public function checkBookedApptSlots_vet ($sessionID) {
        $query = "SELECT a.visitTime
                    FROM appointment a
                    WHERE a.sessionID = :sessionID
                    AND a.status != 'completed' OR a.status != 'cancelled'
            ";
        return $this->query($query, ['sessionID' => $sessionID]);
    }

    public function getSessionDatesByDoctor ($doctorID) {
        $query = "SELECT sessionID, selectedDate, startTime, endTime FROM session 
                WHERE doctorID = :docID AND completeStatus = 0";

        $result = $this->query($query, ['docID' => $doctorID]);
        return $result;
    }

}