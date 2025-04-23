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

    //Profile update and delete___________________________________________________________________________________________________________________________ 
    public function profiledelete() 
    {
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
    
    //update the profile___________________________________________________________________________________________________________________________
    public function profileupdate()
    {
        header('Content-Type: application/json');
        
        $data = json_decode(file_get_contents('php://input'), true);

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
        header('Content-Type: application/json');

        $data = json_decode(file_get_contents('php://input'), true);

        if($data) 
        {
            if($data['sectionId'] == 'salon-info')
            {
                // Debugging log
                error_log('Data received in Salontest controller'); 

                // Check if the user is logged in
                if(!isset($_SESSION['SALON_USER'])) 
                {
                    echo json_encode(["status" => "error", "message" => "Unauthorized access"]);
                    exit();
                }

                //check the phone number is correct or not
                if (!preg_match("/^[0-9]{10}$/", $data['data']['phoneNumber'])) {
                    echo json_encode([
                        "status" => "error",
                        "message" => "Phone number must be exactly 10 digits."
                    ]);
                }

                //get the salon ID
                $salonID = $_SESSION['SALON_USER'];
    
                //input the data array to filter correct data
                $data1 = [
                    'name' => htmlspecialchars($data['data']['name']),
                    'ownerName' => htmlspecialchars($data['data']['ownerName']),
                    'phoneNumber' => htmlspecialchars($data['data']['phoneNumber']),
                    'salonType' => htmlspecialchars($data['data']['salonType']),
                    // 'salonID' => htmlspecialchars($data['salonID']),
                    'address' => htmlspecialchars($data['data']['address']),
                    'GMapLocation' => htmlspecialchars($data['data']['GMapLocation']),
                    'salonDetails' => htmlspecialchars($data['data']['salonDetails']),
                    'salonID' => $salonID
                ];
    
                try 
                {
                    $salon = new Salons();
                    $updateSuccess = $salon->updateSalonTimeSlots($salonID, $data1);
                    
                    if(!$updateSuccess) 
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

    //Changed the password___________________________________________________________________________________________________________________________
    public function changePassword()
    {
        $userTable = new User();
        $salonID = $_SESSION['SALON_USER'];
        $userType = $_SESSION['type'];

        header('Content-Type: application/json');

        //get the post data
        $data = json_decode(file_get_contents('php://input'), true);
        $formData = $data['data'] ?? [];

        // show($formData);

        // Check if salonID and userType are set
        if(isset($salonID) && isset($userType))
        {

            $salonDetails = $userTable->checkLoginUser($salonID);

            $currentPasswordHash = $salonDetails->password;

            // Get the form data from the POST request
            $password = $formData['currentPassword'] ?? '';
            $newPassword = $formData['newPassword'] ?? '';
            $confirmPassword = $formData['confirmPassword'] ?? '';
 
            if(empty($newPassword) || empty($confirmPassword))
            {
                echo json_encode(["status" => "error", "message" => "Both password fields are required."]);
                return;
            }

            if($newPassword != $confirmPassword)
            {
                echo json_encode(["status" => "error", "message" => "Confirm Password and NewPassword do not match."]);
                return;
            }

            if(!password_verify($password, $currentPasswordHash))
            {
                echo json_encode(["status" => "error", 'message' => 'You enter incorrect Password!']);
                return;
            }

            // // check the length greater than 8
            // if(strlen($data['newPassword']) < 8)
            // {
            //     echo json_encode(["status" => "error", "message" => "Password must at least 8 characters long"]);
            //     return;
            // }

            // //check the password include UpperCase, LowerCase, Number, Special Character
            // if(
            //     !preg_match('/[A-Z]/', $newPassword) || // at least one uppercase
            //     !preg_match('/[a-z]/', $newPassword) || // at least one lowercase
            //     !preg_match('/[0-9]/', $newPassword) || // at least one number
            //     !preg_match('/[\W_]/', $newPassword)    // at least one special char
            // ){
            //     echo json_encode([
            //         "status" => "error",
            //         "message" => "Password must include at least one uppercase letter, one lowercase letter, one number, and one special character."
            //     ]);
            //     return;
            // }

            // //check if the new password same as current
            // if(password_verify($newPassword, $currentPasswordHash))
            // {
            //     echo json_encode([
            //         "status" => "error",
            //         "message" => "New password must be different from the current password."
            //     ]);
            //     return;
            // }

            // //Check the Using the common Password
            // $commonPasswords = ['12345678', 'password', '11111111','abc12345'];

            // if(in_array(strtolower($newPassword), $commonPasswords)) 
            // {
            //     echo json_encode([
            //         "status" => "error",
            //         "message" => "Password is too common. Please choose a more secure one."
            //     ]);
            //     return;
            // }

            // Hash the new password
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            // Update the password in the usertable
            $updateResult = $userTable->updatePassword($salonID, $hashedPassword);

            if(empty($updateResult))
            {
                echo json_encode(["status" => "success", "message" => "Password changed successfully!"]);
                return;
            }
            else
            {
                echo json_encode(["status" => "error", "message" => "Failed to change password.Please try again."]);
                return;
            }
        }
        else
        {
            if(empty($salonID))
            {
                //User ID cannot find
                echo json_encode(["status" => "error", "message" => "User ID cannot be found."]);
                return;
            }
            if(empty($userType))
            {
                //user type cannot find
                echo json_encode(["status" => "error", "message" => "User type cannot be found."]);
                return;
            }
        }

    }

    //Delete account___________________________________________________________________________________________________________________________
    public function deleteAccount()
    {
        $userTable = new User();
        $salonSessions = new SalonTimeSlots();
        $salonID = $_SESSION['SALON_USER'];
        $userType = $_SESSION['type'];

        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);
        $formData = $data['data'] ?? [];

        if (isset($salonID) && isset($userType)) {
            $salonDetails = $userTable->checkLoginUser($salonID);
            $currentPasswordHash = $salonDetails->password;
            $loginEmail = $salonDetails->email;

            if ($salonID !== $loginEmail) 
            {
                echo json_encode(["status" => "error", "message" => "Your email does not match the login email."]);
                return;
            }

            $enterPassword = $formData['enterPassword'] ?? '';
           
            if (!password_verify($enterPassword, $currentPasswordHash)) 
            {
                echo json_encode(["status" => "error", "message" => "You entered an incorrect password!"]);
                return;
            }

            //check the last day in the openopenday in the salonsession table
            $SessionDetails = $salonSessions->slotsBySalonID($salonID);

            //check the user create the slots
            if(!empty($SessionDetails))
            {
                $lastday = date('Y-m-d');
                // $lastDate = null;

                foreach ($SessionDetails as $SessionDetail) 
                {
                    $date = $SessionDetail->openday;
                    if( $lastday === null || $date > $lastday)
                    {
                        $lastday = $date;
                    }
                }

                $lastdayDateTime = new DateTime($lastday);

                // Loop through the next 30 days to find slots
                $today = new DateTime();
                $interval = new DateInterval('P1D');// 1 Day interval -> we want one hour $interval = new DateInterval('PT1H'); // PT = period time, 1H = 1 hours//minute M,seconds S
                $period = new DatePeriod($today, $interval, $lastdayDateTime);//
                $latestSlotDate = null;

                foreach ($period as $date) 
                {
                    $dateStr = $date->format('Y-m-d');
                    $slots = $salonSessions->slotsByDateAndSalon($salonID, $dateStr);

                    if (!empty($slots)) {
                        foreach ($slots as $slot) {
                            $noOfBookings = $slot->noOfBookings;
                            $openDay = $slot->openday;

                            if (!empty($noOfBookings) && intval($noOfBookings) > 0 && $today <= $openDay
                            ) 
                            
                            {
                                echo json_encode([
                                    "status" => "error",
                                    "message" => "You have existing bookings on " . $openDay . ". So you cannot delete this account until complete them."
                                ]);
                                return;
                            }

                            // Track latest open day with a slot (even if no bookings)
                            if ($latestSlotDate === null || $openDay > $latestSlotDate) 
                            {
                                $latestSlotDate = $openDay;
                            }
                        }
                    }
                }

                // If no bookings but still have created slots
                if ($latestSlotDate !== null) 
                {
                    echo json_encode([
                        "status" => "error",
                        "message" => "You have created time slots until " . $latestSlotDate . ". You can delete the account after that day."
                    ]);
                    return;
                }
            }

            // No future slots or bookings - safe to delete
            $userDeleted = $this->deleteSalonAccount($salonID);

            if ($userDeleted) 
            {
                session_destroy();
                echo json_encode(["status" => "success", "message" => "Account deleted successfully."]);
            } 
            else 
            {
                echo json_encode(["status" => "error", "message" => "Failed to delete the account. Try again later."]);
            }
        } 
        else 
        {
            echo json_encode(["status" => "error", "message" => "Unauthorized access."]);
        }
    }

    private function deleteSalonAccount($salonID)
    {
        $userTable = new User();

        $status = 'deactive';

        $result = $userTable->updateActiveStatus($salonID,$status);

        if(empty($result))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

}
?>