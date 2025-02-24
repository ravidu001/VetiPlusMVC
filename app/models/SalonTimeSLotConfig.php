<?php

class SalonTImeSLotConfig 
{
    use Model;

    protected $table = 'timeslotconfig';

    //insert the data in to the table
    public function insertData($arr)
    {
        return $this->insert($arr);
    }





}    