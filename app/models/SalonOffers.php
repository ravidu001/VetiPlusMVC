<?php

class SalonOffers 
{
    use Model;

    protected $table = 'specialoffers';

    //__________________________________________________________________________________________
    //insert offers 

    public function addoffer($data)
    {
        return $this->insert($data);
    }

     //__________________________________________________________________________________________
    //edit offers 

    public function offerupdate($offerID, $data)
    {
        return $this->update($offerID, $data, 'specialOfferID');
    }

     //__________________________________________________________________________________________
    //delete offers 
    public function offerdelete($specialOfferID)
    {
        try {
            $result = $this->delete($specialOfferID, 'specialOfferID');
            if ($result) {

                return true; // Successful deletion
    
            } else {
    
                throw new Exception('Deletion failed');
    
            }
    
        } catch (Exception $e) {
            // Log the error if needed
            return false; // Deletion failed
        }
    }

     //__________________________________________________________________________________________
    //search offers 

    public function whereoffer($specialOfferID)
    {
        $this->order_column = 'specialOfferID';
        return $this->where(['specialOfferID' => $specialOfferID]);
    }

     //__________________________________________________________________________________________
    //findall offers 
    public function findAllOfferId()
    {
        $this->limit = 1000;
        $this->order_type = 'DESC';
        $this->order_column = 'specialOfferID';
        return $this->findAll('specialOfferID');
    }

     //__________________________________________________________________________________________
    //findall services to show the special offer add colunm
    
    public function findByService($serviceID)
    {
        $this->order_column = 'specialOfferID';
        return $this->where(['serviceID' => $serviceID]);
    }
    
}

?>