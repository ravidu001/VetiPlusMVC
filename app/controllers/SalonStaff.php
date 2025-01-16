<?php

class SalonStaff extends Controller{

    public function index()
    {
        $this->view('Salon/salonstaff');
    }

    // Add salon service form data
    public function add() 
    {
        // Create the array to pass the form data
        $data = [];

        // Check if the submit button is clicked
        if (isset($_POST['submit'])) 
        {
            // Get the form data as the data array index
            $data = [
                'MemberName' => htmlspecialchars(trim($_POST['MemberName'] ?? '')),
                'PhoneNumber' => htmlspecialchars(trim($_POST['PhoneNumber'] ?? '')),
                'memberAddress' => htmlspecialchars(trim($_POST['memberAddress'] ?? '')),
                'memberId' => htmlspecialchars(trim($_POST['memberId'] ?? '')),
                'job' => htmlspecialchars(trim($_POST['job'] ?? '')),
                'salonID' => $_SESSION['SALON_USER'] ?? ''
            ];

            // Check if photo1 is uploaded
            if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) 
            {
                $data = array_merge($data, [
                    'photoname' => $_FILES['photo']['name'],
                    'tempphoto' => $_FILES['photo']['tmp_name'],
                    'photosize' => $_FILES['photo']['size']
                ]);
            }
            else 
            {
                // Assign null values if photo1 is not uploaded
                $data = array_merge($data, [
                    'photoname' =>  "",
                    'tempphoto' =>  "",
                    'photosize' =>  ""
                ]);
            }

            // Validate the data
            $validateresult = $this->SalonDataValidation($data);

            if (empty($validateresult['errors'])) 
            {
                // Prepare file upload logic
                $validateresult['photo']= "";
            
                if ($validateresult['photoname']) 
                {
                    $image = $validateresult['photoname'];
                    $validateresult['photo'] = 'assets/images/salon/staff/' . $image;
                
                    if (!move_uploaded_file($validateresult['tempphoto'], $validateresult['photo'])) 
                    {
                        $validateresult['errors'] = "Failed to upload photo.";
                    }
                }

                // Save service data if no errors
                if (empty($validateresult['errors'])) 
                {

                    $keysToRemove = ['tempphoto', 'photosize',  'photoname'];

                    foreach ($keysToRemove as $key) 
                    {
                        unset($validateresult[$key]);
                    }

                    $stafftable = new SalonStaffs;
                    try {
                        // Call the insert method
                        $stafftable->staffadd($validateresult);
                
                        // If no exceptions occur, assume success
                        redirect('SalonStaff');
                    } catch (Exception $e) {
                        // Handle the exception if something goes wrong
                        $data['errors'] = 'Data insert unsuccessful: ' . $e->getMessage();
                    }
                } 
                else 
                {
                    $data['errors'] = $validateresult['errors'];
                }
            }
            else 
            {
                $data['errors'] = $validateresult['errors'];
            }
        }

        $this->view('Salon/salonstaffadd', $data);
    }

    private function SalonDataValidation($arr) 
    {
        $arr['errors'] = []; // Initialize errors as an array

        // Validate PhoneNumber
        if (empty($arr['PhoneNumber'])) 
        {
            $arr['errors'][] = 'Phone Number is required.';
        } 
        elseif (!preg_match('/^\d{10}$/', $arr['PhoneNumber'])) 
        {
            $arr['errors'][] = 'Phone Number must be a valid 10-digit number.';
        }

        // Validate MemberName
        if (empty($arr['MemberName'])) 
        {
            $arr['errors'][] = 'Member Name is required.';
        }


        // Validate memberAddress
        if (empty($arr['memberAddress'])) 
        {
            $arr['errors'][] = 'Member Address is required.';
        }

        // Validate job
        if (empty($arr['job'])) 
        {
            $arr['errors'][] = 'Job is required.';
        }

        // Validate NIC
        if (empty($arr['nationalId'])) 
        {
            $arr['errors'][] = 'National Identity Card (NIC) is required.';
        } 
        elseif (!preg_match('/^\d{9}[vVxX]|\d{12}$/', $arr['nationalId'])) 
        {
            $arr['errors'][] = 'National Identity Card (NIC) must be a valid 9-digit with V/X or 12-digit number.';
        }

        if (isset($arr['photosize']) && $arr['photosize'] > 1000000) 
        {
            $arr['errors'][] = 'Photo uploaded file is too large.';
        }

        if (empty($arr['errors'])) 
        {
            unset($arr['errors']); // Remove errors key if no errors exist
        }

        return $arr;
    }
}
?>
