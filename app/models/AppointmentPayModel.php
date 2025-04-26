<?php

class AppointmentPayModel {
    use Model;

    protected $table = 'appointmentpay';

    protected $allowedColumns = ['appointmentID', 'paymentID', 'amount', 'dateTime', 'petownerID', 'paymentInfoID'];

    public function getalldata() {
        $this->order_column = 'dateTime';
        $this->order_type = 'DESC';
        return $this->findAll();
    }

    public function getdatabypetowner($petownerID) {
        $this->order_column = 'dateTime';
        $this->order_type = 'DESC';
        return $this->where(['petownerID' => $petownerID]);
    }

    public function CalRevenue() {
        $query = "SELECT SUM(amount) as total FROM $this->table";
        $result = $this->query($query);
        return $result[0]->total;  //  the result is an array of objects and 'total' is a field
    }

    public function CalTodayRevenue() {
        $query = "SELECT SUM(amount) as total FROM $this->table WHERE DATE(dateTime) = CURDATE()";
        $result = $this->query($query);
        return  $result[0]->total;
    }
    
    


}
