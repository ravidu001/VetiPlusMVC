<?php

class SalonRegister extends Controller
{
    //get the form registration submit data
    private function getRegistrationdata()
    {
        //create the new array to pass the data from submit form
        $arr = [];
        
        //check if the form is submit or not
        if(isset($_POST['submit'])) 
        {
            //if submit pass the data to the array
            $arr = [
                'name' => htmlspecialchars(trim($_POST['salonName'] ?? '')),
                'phoneNumber' => htmlspecialchars(trim($_POST['salonPhoneNumber'] ?? '')),
                'address' => htmlspecialchars(trim($_POST['location'] ?? '')),
                'BRNumber' => htmlspecialchars(trim($_POST['businessregnumber'] ?? '')),
                'salonID' => $_SESSION['SALON_USER'] ?? '',
                'registeredDate' => date('Y-m-d H:i:s'),
            ];

            //check the file is upload success or not
            if (isset($_FILES['brcertificate'])) 
            {
                $image = $_FILES['brcertificate']['name'] ?? '';
                $image_tmp_name = $_FILES['brcertificate']['tmp_name'] ?? '';
                $image_folder = 'assets/images/salon/register/' . $image;

                if ($_FILES['brcertificate']['error'] === UPLOAD_ERR_OK) 
                {
                    if (!move_uploaded_file($image_tmp_name, $image_folder)) 
                    {
                        $arr['error'] = 'Failed to upload the file.';
                    } 
                    else 
                    {
                        $arr['BRCertificate'] = $image_folder;
                    }
                } 
                else 
                {
                    $arr['error'] = 'File upload error.';
                }
            }

            //check the form submit data is valid or not
            if (empty($arr['error'])) {

                $error = $this->checkRegisterData(
                    $arr['name'],
                    $arr['phoneNumber'],
                    $arr['address'],
                    $arr['BRNumber']
                );

                //if it has the error then pass the error 
                if (!empty($error)) {
                    $arr['error'] = $error;
                }
            }
        }
        else
        {
            $arr['salonID'] = $_SESSION['SALON_USER'];
        }

        //return all array data
        return $arr;
    }

    //when reject again submit form update the data
    private function updateregisterdata($arr)
    {
        $data = ['success' => false, 'error' => null];

        //check the again email is has or not
        if(empty($arr['salonID'])) 
        {
            $data['error'] = "Email is required.";
            return $data;
        }

        
        // $table = new SalonRegisters;
        $salonTable = new Salons();

        //check if this is reject now should pass the status is pending
        $arr['approvedStatus'] = 'pending';
        
        $result =  $salonTable->updateSalonTimeSlots($arr['salonID'],$arr);

        if(!$result)
        {
            $data['success'] = true;
        }
        else
        {
            $data['error'] = "data insert unsuccessfully";
        }

        return $data;
    }

    //if this is new email create the new 
    private function insertregisterdata($arr, $registration_table)
    {
        // $notifications = new Notification();

        $data = ['success' => false, 'error' => null];

        //if cannot catch the email error or can redirect the login page
        if (empty($arr['salonID'])) {
            $data['error'] = "Email is required.";
            return;
        }

        show($arr);
       //check the BR number has or not
       $BRnumber = $registration_table->fetchByBrNumber($arr['BRNumber']);

       if(!empty($BRnumber))
       {
            $data['error'] = "Your BR number is invalid!.";
       }
       else
       {
            $results = $registration_table->insertData($arr);

            if(!$results)
            {
                $data['success'] = true;
                // $notifications->show("data insert successfully!.",'success');
            }
            else
            {
                $data['error'] = "data insert unsuccessfully";
                // $notifications->show("data insert unsuccessfully",'error');
            }

       }

        return $data;
    }

    //_________________________________________________________________________________________________________________________________
    public function index()
    {
        // Validate email 
        if(empty($_SESSION['SALON_USER']) || !filter_var($_SESSION['SALON_USER'], FILTER_VALIDATE_EMAIL)) 
        {
            redirect('Login');
            exit();
        }

        // Use the salon registration model 
        $registration_table = new Salons;
        $notifications = new Notification();

        // Check if same login email exists
        $existingRecord = $registration_table->FindUser($_SESSION['SALON_USER']);

        $data = [];
        
        // If existing record exists
        if($existingRecord) 
        {
            $data['oldemaildata'] = $existingRecord;
           
            $status = $existingRecord->approvedStatus;
            
            if($status === 'rejected')
            {
                if(isset($_POST['submit']))
                {
                    $formdata = $this->getRegistrationdata();

                    if(empty($formdata['error'])) 
                    {
                        $result = $this->updateregisterdata($formdata);

                        if($result) 
                        {
                            $notifications->show("Re-Application submitted successfully.", 'success');
                            redirect('Pending');
                            exit();
                        }
                        else
                        {
                            $data['error'] = $result['error'];
                        }
                    }
                    else
                    {
                        $data['error'] = $formdata['error'];
                    }
                }

               $data['oldemaildata'] = $existingRecord;
            //    show($data['oldemaildata']);
            }
            else if($status === 'pending')
            {
                redirect('Pending');
            }
            else if($status === 'approved')
            {
                redirect('Salon');
            }            
        }
        else 
        {
            //check the form submitted
            if(isset($_POST['submit']))
            {
                 // New registration
                 $data = $this->getRegistrationdata();

                //  show($data['error']);
                if(empty($data['error'])) 
                {
                    // show('hi');
                    $result = $this->insertregisterdata($data, $registration_table);
                    show($result);
                    if ($result['success']) 
                    {
                        $notifications->show("Registration Successfully!.",'success');
                        redirect('Pending');
                    }
                    else 
                    {
                        $notifications->show("Registration Unsuccessfully!.",'error');
                        exit();
                        // $data['errors'][] = $result['error'];
                    }
                }
                else
                {
                    $notifications->show($data['error'],'error');
                    exit();
                }
            }
            else
            {
                $data['salonID'] = $_SESSION['SALON_USER'];
            }
        }

        $this->view('Salon/salonregister', $data);
    }

    private function checkRegisterData($salonName, $salonPhoneNumber, $location, $businessregnumber)   
    {
        $errors = [];

        // Validate salon name
        if (empty(trim($salonName))) {
            $errors['name'] = "Salon name is required.";
        }

        // Validate mobile number (Sri Lankan format example: 10 digits)
        if (empty(trim($salonPhoneNumber)) || !preg_match('/^\d{10}$/', $salonPhoneNumber)) {
            $errors['phoneNumber'] = "Invalid mobile number. Please enter a 10-digit number.";
        }

        // Validate location
        if (empty(trim($location))) {
            $errors['address'] = "Location is required.";
        }

        // Validate business registration number (example: alphanumeric, 8-12 characters)
        if (empty(trim($businessregnumber))) {
            $errors['businessregnumber'] = "Invalid business registration number is empty.";
        }

        return $errors;
    }


}
