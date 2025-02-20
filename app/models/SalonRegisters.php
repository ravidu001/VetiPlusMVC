<?php

class SalonRegisters {
    use Model;

    protected $table = 'salonregistrations';

    public function checkRegisterData($salonName, $salonPhoneNumber, $location, $socialmedia, $businessregnumber, $image_size = null)   
    {
        $errors = [];

        // Validate salon name
        if (empty(trim($salonName))) {
            $errors['salonName'] = "Salon name is required.";
        }

        // Validate mobile number (Sri Lankan format example: 10 digits)
        if (empty(trim($salonPhoneNumber)) || !preg_match('/^\d{10}$/', $salonPhoneNumber)) {
            $errors['salonPhoneNumber'] = "Invalid mobile number. Please enter a 10-digit number.";
        }

        // Validate location
        if (empty(trim($location))) {
            $errors['location'] = "Location is required.";
        }

        // Validate social media URL
        if (!empty($socialmedia) && !filter_var($socialmedia, FILTER_VALIDATE_URL)) {
            $errors['socialmedia'] = "Invalid social media URL.";
        }

        // Validate business registration number (example: alphanumeric, 8-12 characters)
        // if (empty(trim($businessregnumber)) || !preg_match('/^[A-Za-z0-9]{8,12}$/', $businessregnumber)) {
        //     $errors['businessregnumber'] = "Invalid business registration number. It must be 8-12 alphanumeric characters.";
        // }

        // Validate image size (if provided)
        if (!is_null($image_size) && $image_size < 100000) 
        { // 1MB limit
            $errors['image_size'] = "File size too large. Please upload an image less than 1MB.";
        }

        return $errors;
    }

    public function getSalonRegisterStatus($email) 
    {

        return $this->first(['email' => $email]);
        // unset($result->)   
    }


    // public function updateCount($id, $loginCount) 
    // {
    //     $this->update($id, ['loginCount' => $loginCount], 'email');
    // }
    
    public function updateStatus($id, $status) 
    {
        $this->update($id, ['status' => $status] , 'email');
    }

    //insert data
    public function insertData($arr)
    {
        $this->insert($arr);
    }
}

?>
