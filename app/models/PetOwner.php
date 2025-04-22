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

    // /**
    //  * jm -  Get all the upcoming vet and salon appointments of the petOwner, to be called from view files.
    //  */
    // public function getAllUpcomingAppts () {
    //     $myQuery = "Select type='vet', a.*, s.*, v.fullName, v.profilePicture 
    //                 From appointment a
    //                 Inner Join session s On a.sessionID = s.sessionID
    //                 Inner Join vetdoctor v On s.doctorID = v.doctorID
    //                 Inner join pet p On a.petID = p.petID
    //                 Where a.petOwnerID = :petOwnerID
    //                 And a.status = 'available'
    //                 And s.selectedDate >= CURRENT_DATE
    //                 And a.visitTime >= CURRENT_TIME
    //                 Order By s.selectedDate, a.visitTime";
    //     $params = [
    //         'petOwnerID' => $this->petOwnerID
    //     ];
    //     $result = $this->query($myQuery, $params);

    //     return $result;
    // }

    public function logout() {
        $_SESSION = [];
        return session_destroy();
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

}
