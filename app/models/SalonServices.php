<?php

class SalonServices
{
    use Model;

    protected $table  = 'salonservice';

    // public function servicevalidation()
    // {
        
    // }

    public function serviceadd($data)
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