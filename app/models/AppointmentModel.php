<?php

class AppointmentModel {
    use Model;

    protected $table = 'appointment';

    protected $allowedColumns = ['appointmentID', 'bookedDateTime', 'visitTime', 'status','petID', 'petOwnerID', 'sessionID'];

    // get appointment by sessionID
    public function getAppointmentBySession($sessionID) {
        $this->limit = 100;
        $this->order_column = 'visitTime';
        $this->order_type = 'ASC';

        $result = $this->where(['sessionID' => $sessionID]);
        return $result;
    }

    public function getAppointmentBySessionwithEmpty($sessionID) {
        $this->limit = 100;
        $this->order_column = 'visitTime';
        $this->order_type = 'ASC';
    
        // Assuming the where method returns false on failure
        $result = $this->where(['sessionID' => $sessionID]);
    
        // Check if the result is valid
        if ($result === false) {
            // Log the error or handle it as needed
            error_log("Failed to retrieve appointments for session ID: $sessionID");
            return []; // Return an empty array instead of false
        }
    
        return $result; // Return the result if valid
    }

    // update the status of an appointment
    public function updateAppointmentStatus($appointmentID, $status) {
        $this->update($appointmentID, ['status' => $status], 'appointmentID');
    }

}