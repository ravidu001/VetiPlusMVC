<?php

class PetOwner {
    use Model;

    protected $table = 'petowner'; 
    protected $allowedColumns = [ 
        'petOwnerID', 'fullName', 'profilePicture', 'contactNumber', 'gender', 'DOB', 'NIC',
        'houseNo', 'streetName', 'city'
        ,'lastLogin'
    ];
    
    public function __construct() {
        $this->order_column = 'petOwnerID ';  
    }

    public $petOwnerID;
   
    public function setPetOwnerID () {
        isset($_SESSION['petOwnerID']) && $this->petOwnerID = $_SESSION['petOwnerID'];
    }

    
    public function getUserDetails () {
        $userDetails = $this->first(['petOwnerID' => $this->petOwnerID]);
        return $userDetails;
    }

    public function getUserDetailsByID ($petOwnerID) {
        $userDetails = $this->first(['petOwnerID' => $petOwnerID]);
        return $userDetails;
    }

    public function getDetails_forOtherListings ($petOwnerID) {
        $query = "SELECT contactNumber, district from petOwner WHERE petOwnerID = :poID";
        
        $result = $this->query($query, ['poID' => $petOwnerID]);
        return $result;
    }

    public function getReschedulesAvailableCount ($petOwnerID) {
        $query = "SELECT monthlyReschedulesAvailable as rescheduleCount from petOwner WHERE petOwnerID = :poID";
        
        $result = $this->query($query, ['poID' => $petOwnerID]);
        return $result[0];
    }

    public function canReschedule ($petOwnerID) {
        return ($this->getReschedulesAvailableCount($petOwnerID) > 0);
    }
   
    public function register ($data) {
        $data['petOwnerID'] = $this->petOwnerID;

        $registerSuccess = $this->insert($data);
        return empty($registerSuccess) ? true : false;
    }
    
    public function uploadProfilePicture ($data) {
        $uploadSuccess = $this->update($this->petOwnerID, $data, 'petOwnerID');
        return empty($uploadSuccess) ? true : false;
    }

    public function editProfileDetails ($petOwnerID, $data) {
        $updateSuccess = $this->update($petOwnerID, $data, 'petOwnerID');
        return empty($updateSuccess) ? true : false;
    }

    public function logout() {
        $_SESSION = [];
        return session_destroy();
    }

    public function getStatistics_po () {
        $query = "SELECT * FROM 

                ";
        $this->query("");
    }

    public function checkUser($email)
    {
        $this->order_column = 'petOwnerID';
        return $this->where(['petOwnerID' => $email]); 
       
    }

    public function petownercount()
    {
        $count = $this->getCount();
        return $count;  

    }

}
