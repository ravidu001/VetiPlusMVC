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

    // update the status of an appointment
    public function updateAppointmentStatus($appointmentID, $status) {
        $this->update($appointmentID, ['status' => $status], 'appointmentID');
    }

}