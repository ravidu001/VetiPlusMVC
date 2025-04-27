<?php

class AppointmentModel
{
    use Model;

    protected $table = 'appointment';

    protected $allowedColumns = ['appointmentID', 'bookedDateTime', 'visitTime', 'status', 'petID', 'petOwnerID', 'sessionID'];

    public function getalldata()
    {
        $this->order_column = 'bookedDateTime';
        $this->order_type = 'DESC';
        return $this->findAll();
    }

    // get appointment by sessionID
    public function getAppointmentBySession($sessionID) {
        $this->limit = 1000;
        $this->order_column = 'visitTime';
        $this->order_type = 'ASC';

        $result = $this->where(['sessionID' => $sessionID]);
        return $result;
    }


    public function getAppointmentBySessionwithEmpty($sessionID) {
        $this->limit = 1000;
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
    public function updateAppointmentStatus($appointmentID, $status)
    {
        $this->update($appointmentID, ['status' => $status], 'appointmentID');
    }

    public function appointmentcount()
    {
        $count = $this->getCount();
        return $count;
    }

    public function getAppointmentBypetownerID($petOwnerID)
    {
        $this->limit = 100;
        $this->order_column = 'bookedDateTime';
        $this->order_type = 'DESC';

        $result = $this->where(['petOwnerID' => $petOwnerID]);
        return $result;
    }

    public function bookAppointment($data)
    {
        $bookingSuccess = $this->insert($data);
        return empty($bookingSuccess) ? true : false;
    }

    public function dailyappointment()
    {
        $currentDate = date('Y-m-d'); // Get current date in 'YYYY-MM-DD' format
        $count = $this->getCount($currentDate);
        return $count;
    }

    public function cancelappointmentcount()
    {
        $query = "SELECT COUNT(*) as total FROM $this->table WHERE status = 'cancelled'";
        $result = $this->query($query);
        return $result[0]->total;
    }
    public function pendingappointmentcount()
    {
        $query = "SELECT COUNT(*) as total FROM $this->table WHERE status = 'available'";
        $result = $this->query($query);
        return $result[0]->total;
    }
    public function completeappointmentcount()
    {
        $query = "SELECT COUNT(*) as total FROM $this->table WHERE status = 'completed'";
        $result = $this->query($query);
        return $result[0]->total;
    }

    public function bookAppointment_andReturnID ($data) {

        $bookingSuccess = $this->insert($data);
        return empty($bookingSuccess) ? true : false;
        
        // if (empty($bookingSuccess)) {
        //     return ['success' => true, 'appointmentID' => $this->getLastID()];
        // } else {
        //     return ['success' => false, 'appointmentID' => ''];
        // }
    }

    public function cancelAppt ($apptID) {
        $cancelSuccess = $this->update($apptID, ['status' => 'cancelled'], 'appointmentID');
        return empty($cancelSuccess) ? true : false;
    }
}
