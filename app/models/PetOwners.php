<?php

class PetOwners 
{
    use Model;

    protected $table = 'petowner';

    public function getPetOnwerDetailsByID($petOwnerID)
    {
        $this->order_column = 'petOwnerID';
        return $this->first(['petOwnerID' => $petOwnerID]);
    }

    
}

