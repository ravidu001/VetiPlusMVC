<?php

class SalonProfile extends Controller
{
    public function index()
    {
       $data = [];
        $salon = new Salons();
        $salonId = $_SESSION['SALON_USER'];
        $data['salon_details'] = $salon->FindUser($salonId);
        $this->view('Salon/salonprofile', $data);
    }

    //___________________________________________________________________________________________________________
    //Profile update and delete 
    public function profiledelete() {
        header('Content-Type: application/json');
    
        $salonTable = new Salons();
        $salonID = $_SESSION['SALON_USER'];
    
        // Set the profile picture field to NULL
        $data = ['ProfilePicture' => null];
        $updateProfile = $salonTable->DeleteProfile($salonID, $data);
    
        if ($updateProfile) {
            echo json_encode(["status" => "success"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to remove profile picture."]);
        }
        exit;
    }
    

    //update the profile
    public function profileupdate()
    {
        header('Content-Type: application/json');
        
        if (isset($_FILES['profilePicture']) && $_FILES['profilePicture']['error'] === UPLOAD_ERR_OK) 
        {
            $file = $_FILES['profilePicture'];
            $fileName = time() . "_" . basename($file['name']); // Unique filename
            $targetDir = "assets/images/salon/profile/";
            $targetFile = $targetDir . $fileName;
        }

        if (move_uploaded_file($file['tmp_name'], $targetFile)) {
           
            $data1 = [];
            //update the database
            $salonTable = new Salons();
            $salonID = $_SESSION['SALON_USER'];

            $data1['ProfilePicture'] = $targetFile;
            $updateprofile = $salonTable ->updateSalonTimeSlots($salonID, $data1);

            if ($updateprofile) 
            {
                echo json_encode(["status" => "success", "image" => $fileName]);
            } 
            else 
            {
                echo json_encode(["status" => "error", "message" => "Database update failed."]);
            }
        }
        else 
        {
            echo json_encode(["status" => "error", "message" => "Failed to upload image."]);
        }
        
        exit;
    }


    public function update()
    {
        // Set JSON response header - undestanding the client the data is JSON format not html
        header('Content-Type: application/json');

        // Read the raw JSON input
        //The function file_get_contents() is used to read a file or get the contents of a stream.
        //php://input is allow to read request the body data
        $rawData = file_get_contents("php://input"); 

        //json_decode() converts the JSON string into a PHP array.
        //The second parameter true ensures it is converted into an associative array instead of an object.
        $data = json_decode($rawData, true);

        if($data) 
        {
            if($data['sectionId']== 'salon-info')
            {
                // Debugging log
                error_log('Data received in Salontest controller'); 

                // Check if the user is logged in
                if(!isset($_SESSION['SALON_USER'])) 
                {
                    echo json_encode(["status" => "error", "message" => "Unauthorized access"]);
                    exit();
                }

                //check the email is correct format or not
                if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                    echo json_encode([
                        "status" => "error",
                        "message" => "Invalid email format."
                    ]);
                }

                //check the phone number is correct or not
                if (!preg_match("/^[0-9]{10}$/", $data['phone'])) {
                    echo json_encode([
                        "status" => "error",
                        "message" => "Phone number must be exactly 10 digits."
                    ]);
                }

                //get the salon ID
                $salonID = $_SESSION['SALON_USER'];
    
                //input the data array to filter correct data
                $data1 = [
                    'name' => htmlspecialchars($data['salonName']),
                    'ownerName' => htmlspecialchars($data['ownerName']),
                    'phoneNumber' => htmlspecialchars($data['phone']),
                    'email' => htmlspecialchars($data['email']),
                    'address' => htmlspecialchars($data['address']),
                    'GMapLocation' => htmlspecialchars($data['location']),
                    'salonDetails' => htmlspecialchars($data['description']),
                    'salonID' => $salonID
                ];
    
                try 
                {
                    $salon = new Salons();
                    $updateSuccess = $salon->updateSalonTimeSlots($salonID, $data1);
                    
                    if($updateSuccess) 
                    {
                        echo json_encode([
                            "status" => "success",
                            "message" => "Salon details updated successfully",
                            "received_data" => $data1
                        ]);
                    } 
                    else 
                    {
                        echo json_encode([
                            "status" => "error",
                            "message" => "Failed to update salon details"
                        ]);
                    }
                } 
                catch(Exception $e) 
                {
                    error_log("Error updating salon details: " . $e->getMessage());
                    echo json_encode(["status" => "error", "message" => "Server error"]);
                }
                exit();
            }
            else if($data['sectionId']== 'schedule')
            {
                error_log('Data received in Salontest controller'); // Debugging log

                //check the salon time slot is created 

                // Check if the user is logged in
                if(!isset($_SESSION['SALON_USER'])) 
                {
                    echo json_encode(["status" => "error", "message" => "Unauthorized access"]);
                    exit();
                }
    
                //not yet create the validation part
                $salonID = $_SESSION['SALON_USER'];
                $opentime =  $data['openTime'] ;
                $closetime = $data['closeTime'] ;
                $duration = $data['slotDuration'] ?? '';


                //get the data in tot he array
                $data1 = [
                    'open_time' => $opentime,
                    'close_time' => $closetime,
                    'slot_duration' => $duration,
                    'salonID' => $salonID
                ];
    

                try 
                {
                    $salon = new Salons();
                    $updateSuccess = $salon->updateSalonTimeSlots($salonID, $data1);
                   
                    if($updateSuccess) 
                    {
                        echo json_encode([
                            "status" => "success",
                            "message" => "Salon details updated successfully",
                            "received_data" => $data1
                        ]);
                    } 
                    else 
                    {
                        echo json_encode([
                            "status" => "error",
                            "message" => "Failed to update salon details"
                        ]);
                    }
                } 
                catch(Exception $e) 
                {
                    error_log("Error updating salon details: " . $e->getMessage());
                    echo json_encode(["status" => "error", "message" => "Server error"]);
                }
                exit();
            }
        } 
        else 
        {
            echo json_encode(["status" => "error", "message" => "No data received"]);
            exit();
        }
    }


    //_____________________________________________________________________________________________________________________________________________________
    //Changed the password
    public function changePassword()
    {
        $userTable = new User();
        $salonID = $_SESSION['SALON_USER'];

        $result=$userTable->checkUser($salonID);

        show($result);
    }



}
?>