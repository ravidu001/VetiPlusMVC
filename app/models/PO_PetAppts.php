<?php

class PO_PetAppts {
    use Model;

    private function getPetAppts_vet(array $params, string $type = 'history') {
        $query = "SELECT 'vet' as type,
                    a.status as apptStatus,
                    a.appointmentID as apptID, 
                    s.doctorID as providerID, 
                    a.petOwnerID as petOwnerID,
                    CONCAT(s.selectedDate, ' ', a.visitTime) as apptDateTime,
                    'Vet Visit' as reason,
                    CONCAT('Dr. ', v.fullName )as providerName, 
                    v.profilePicture as providerPic,
                    p.profilePicture as petPic,
                    p.name as petName,
                    a.status as apptStatus";
        
        if ($type === 'history') {
            $query .= ", vf.rating as rating,
                        'history' as whenType";
        }
        
        $query .= " FROM appointment a 
                    INNER JOIN session s ON a.sessionID = s.sessionID
                    INNER JOIN vetdoctor v ON s.doctorID = v.doctorID
                    INNER JOIN pet p ON a.petID = p.petID";
        
        if ($type === 'history') {
            $query .= " LEFT JOIN vetfeedback vf ON a.appointmentID = vf.appointmentID";
        }
        
        $query .= " WHERE a.petOwnerID = COALESCE(:petOwnerID, a.petOwnerID)
                    AND a.petID = COALESCE(:petID, a.petID)";
        

        if ($type === 'history') {
            $query .= " AND CONCAT(s.selectedDate, ' ', a.visitTime) < CURRENT_TIMESTAMP";
        } else {
            $query .= " AND CONCAT(s.selectedDate, ' ', a.visitTime) > CURRENT_TIMESTAMP";
        }
        
        $query .= " ORDER BY apptDateTime " . ($type === 'history' ? 'DESC' : 'ASC');
        
        return $this->query($query, $params);
    }
    private function getPetAppts_salon(array $params, string $type = 'history') {
        $query = "SELECT 'salon' as type,
                    g.status as apptStatus,
                    g.groomingID as apptID, 
                    ss.salonID as providerID, 
                    g.petOwnerID as petOwnerID,
                    g.dateTime as apptDateTime,
                    g.service as reason,
                    s.name as providerName, 
                    s.profilePicture as providerPic,
                    p.profilePicture as petPic,
                    p.name as petName,
                    ss.openday as day,
                    ss.time_slot as timeSlot";
        
        if ($type === 'history') {
            $query .= ", sf.rating as rating";
        }
        
        $query .= " FROM groomingsession g
                    INNER JOIN salonsession ss ON g.salSessionID = ss.salSessionID
                    INNER JOIN salon s ON ss.salonID = s.salonID
                    INNER JOIN pet p ON g.petID = p.petID";
        
        if ($type === 'history') {
            $query .= " LEFT JOIN salonfeedback sf ON g.groomingID = sf.groomingID";
        }
        
        $query .= " WHERE g.petOwnerID = COALESCE(:petOwnerID, g.petOwnerID)
                    AND g.petID = COALESCE(:petID, g.petID)";
        
        if ($type === 'history') {
            $query .= " AND g.status != '0' AND ss.openday <= CURRENT_TIMESTAMP";
        } else {
            $query .= " AND g.status != '2'";
        }
        
        $query .= " ORDER BY g.dateTime " . ($type === 'history' ? 'DESC' : 'ASC');
        
        return $this->query($query, $params);
    }
    private function getPetAppts_all(array $params, string $type = 'history') {
        if (!in_array($type, ['history', 'upcoming'])) {
            throw new InvalidArgumentException("Type must be either 'history' or 'upcoming'");
        }
        
        $vetResults = $this->getPetAppts_vet($params, $type) ?: [];
        $salonResults = $this->getPetAppts_salon($params, $type) ?: [];
        
        // Combine and sort results
        $combined = array_merge($vetResults, $salonResults);
        
        usort($combined, function($a, $b) use ($type) {
            $cmp = strtotime($a->apptDateTime) <=> strtotime($b->apptDateTime);
            return $type === 'history' ? -$cmp : $cmp;
        });
        
        return $combined;
    }

    // i'm seperating these because history and upcoming won't be needed together
    /**
     * jm - $options should contain petOwnerID, petID and a type whether all, vet or salon
     */
    public function getPetApptHistory (array $options) {
        $params = ['petOwnerID' => $options['petOwnerID'], 'petID' => $options['petID']];

        $type = $options['type'] ?? 'all';
        if ($type === 'all') {
            $result = $this->getPetAppts_all($params, 'history');
        } elseif ($type === 'vet') {
            $result = $this->getPetAppts_vet($params, 'history');
        } elseif ($type === 'salon') {
            $result = $this->getPetAppts_salon($params, 'history');
        } else {
            throw new InvalidArgumentException("Invalid type: $type");
        }
        return $result;
    }

    /**
     * jm - $options should contain petOwnerID, petID and a type whether all, vet or salon
     */
    public function getPetApptUpcoming (array $options) {
        $params = ['petOwnerID' => $options['petOwnerID'], 'petID' => $options['petID']];

        $type = $options['type'] ?? 'all';
        if ($type === 'all') {
            $result = $this->getPetAppts_all($params, 'upcoming');
        } elseif ($type === 'vet') {
            $result = $this->getPetAppts_vet($params, 'upcoming');
        } elseif ($type === 'salon') {
            $result = $this->getPetAppts_salon($params, 'upcoming');
        } else {
            throw new InvalidArgumentException("Invalid type: $type");
        }
        return $result;
    }


    public function makeBooking (string $type, array $params) {
        if ($type === 'vet') {
            return $this->makeBooking_vet($params);
        } elseif ($type === 'salon') {
            return $this->makeBooking_salon($params);
        }
    }

    private function makeBooking_vet ($params) {
        $apptModel = new AppointmentModel;
        $bookingSuccess = $apptModel->bookAppointment_andReturnID($params);

        return $bookingSuccess;
    }

    private function makeBooking_salon ($params) {
        
        // $this->beginTransaction();
        // try {
            $sessModel = new SalonSession;
            $updateSuccess = $sessModel->updateBookingsCount($params['salSessionID']);

            $apptModel = new SalonBooked;
            $insertSuccess = $apptModel->bookAppointment_andReturnID($params);
        
            if ($insertSuccess !== false && $updateSuccess !== false) {
                return true;
            }
            else return false;
                // $this->commit();
                // return ['success' => true, 'appointmentID' => $this->getLastID()];
            // $this->rollBack();
            // return ['success' => false, 'appointmentID' => ''];
        // } 
        // catch (PDOException $e) {
        //     $this->rollBack();
        //     // return ['success' => false, 'appointmentID' => ''];
        //     return false;
        // }
    }

    public function cancelAppt (string $type, $apptID) {
        if ($type === 'vet') {
            $apptModel = new AppointmentModel;
            return $apptModel->cancelAppt($apptID);
        } 
        elseif ($type === 'salon') {
            $apptModel = new SalonBooked;
            return $apptModel->cancelAppt($apptID);
        }
    }

    public function rescheduleAppt ($params) {
        $po = new PetOwner;
        $petOwnerID = $params['petOwnerID'];
        $canReschedule = $po->canReschedule($petOwnerID);
        $type = $params['type'];

        if ($canReschedule) {
            if ($type === 'vet') {
                $this->beginTransaction();
                try {
                    $apptModel = new AppointmentModel;
                    $cancelDone = $apptModel->cancelAppt($params['cancellingApptID']);

                    $insertSuccess = $this->makeBooking_vet($params);
                    $lessened = $po->lessenRescheduleCount($petOwnerID);
                
                    if ($insertSuccess !== false && $cancelDone !== false && $lessened !== false) {
                        $this->commit();
                        return ['status' => 'success', 'msg' => 'Reschedule successful.'];
                    }
                    $this->rollBack();
                    return ['status' => 'failure', 'msg' => 'Unexpected error!'];
                } 
                catch (PDOException $e) {
                    $this->rollBack();
                    return ['status' => 'failure', 'msg' => 'Unexpected error!'];
                }
            } 
            elseif ($type === 'salon') {
                $this->beginTransaction();
                try {
                    $apptModel = new SalonBooked;
                    $cancelDone = $apptModel->cancelAppt($params['cancellingApptID']);

                    $insertSuccess = $this->makeBooking_salon($params);
                    $lessened = $po->lessenRescheduleCount($petOwnerID);
                
                    if ($insertSuccess !== false && $cancelDone !== false && $lessened !== false) {
                        $this->commit();
                        return ['status' => 'success', 'msg' => 'Reschedule successful.'];
                    }
                    $this->rollBack();
                    return ['status' => 'failure', 'msg' => 'Unexpected error!'];
                } 
                catch (PDOException $e) {
                    $this->rollBack();
                    return ['status' => 'failure', 'msg' => 'Unexpected error!'];
                }
            }
        }
        else {
            return ['status' => 'failure', 'msg' => 'Rescheduling limit reached!'];
        }
    }
}