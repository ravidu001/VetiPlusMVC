<?php

class SalonBooked
{
    use Model;

    protected $table = 'groomingsession';

    public function FindBookedDetails()
    {
        $this->order_column = 'groomingID';
        return $this->FindAll();
    }

}