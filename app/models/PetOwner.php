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
        $this->order_column = 'petOwnerID ';  // Overriding order_column here
    }

    public $petOwnerID;
    /**
     * jm - Sets the value of petOwner ID from session storage.
     * Controller itself should make sure ID is set in session.
     * Call this function whenever petOwner or pet object created is created by me
     */
    public function setPetOwnerID () {
        isset($_SESSION['petOwnerID']) && $this->petOwnerID = $_SESSION['petOwnerID'];
    }

    /**
     * jm -  Get the petOwner's details from the database
     * @return array The user details.
    */
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

    public function lessenRescheduleCount ($petOwnerID) {
        $query = "UPDATE petowner SET monthlyReschedulesAvailable = monthlyReschedulesAvailable - 1 WHERE petOwnerID = :poID";
        
        $result = $this->query($query, ['poID' => $petOwnerID]);
        return empty($result) ? true : false;
    }

    public function canReschedule ($petOwnerID) {
        return ($this->getReschedulesAvailableCount($petOwnerID) > 0);
    }
    /**
     * jm -  Register and insert the user details into database
     * @param array $data The petOwner's details to be inserted
     * @return bool  whether registration successful or not.
    */
    public function register ($data) {
        $data['petOwnerID'] = $this->petOwnerID;

        $registerSuccess = $this->insert($data);
        return empty($registerSuccess) ? true : false;
    }
    /**
     * jm - 'upload' petOwner's profile pic and update database
     * @return bool Whether successful or not
     */ 
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
        // echo $email;
        $this->order_column = 'petOwnerID';
        // $result = $this->where(['email' => $email]);
        return $this->where(['petOwnerID' => $email]); // what this return is an array of user
        // if($result) {
        //     return true;
        // } else {
        //     return false;
        // } 
    }

    public function petownercount()
    {
        $count = $this->getCount();
        return $count;  // Return the count value

    }

}
