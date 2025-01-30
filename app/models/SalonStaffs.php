<?php

class SalonStaffs
{
    use Model;

    protected $table  = 'salonstaff';

    // public function servicevalidation()
    // {
        
    // }

    public function staffadd($data)
    {
        $this->insert($data);
    }

    // public function servicedelete()
    // {

    // }

    // public function serviceupdate()
    // {

    // }

    // public function serviceview()
    // {

    // }

    // public function servicefind()
    // {

    // }
}

?>