<?php

class SalonOffers 
{
    use Model;

    protected $table = 'specialoffers';

     

    public function addoffer($data)
    {
        return $this->insert($data);
    }

    

    public function offerupdate($offerID, $data)
    {
        return $this->update($offerID, $data, 'specialOfferID');
    }

     
    public function offerdelete($specialOfferID)
    {
        try {
            $result = $this->delete($specialOfferID, 'specialOfferID');
            if ($result) {

                return true; 
    
            } else {
    
                throw new Exception('Deletion failed');
    
            }
    
        } catch (Exception $e) {
            return false; 
        }
    }

     

    public function whereoffer($specialOfferID)
    {
        $this->order_column = 'specialOfferID';
        return $this->where(['specialOfferID' => $specialOfferID]);
    }

     
    public function findAllOfferId()
    {
        $this->limit = 1000;
        $this->order_type = 'DESC';
        $this->order_column = 'specialOfferID';
        return $this->findAll('specialOfferID');
    }

    
    public function findByService($serviceID)
    {
        $this->order_column = 'specialOfferID';
        return $this->where(['serviceID' => $serviceID]);
    }
    
}

?>