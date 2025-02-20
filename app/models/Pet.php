<?php

class Pet 
{
    use Model;
    
    protected $table = 'petowner';
    

    public function findPetDetailsByID($petID)
    {
        $this->order_colunm = 'petID';
        return $this->first(['petID' => $petID ]);
    }


}




    

   