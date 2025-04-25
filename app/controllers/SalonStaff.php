<?php

class SalonStaff extends Controller
{

    public function index()
    {
        $data = [];
        $stafftable = new SalonStaffs;

        $data = $stafftable->findAllstaff();
        $this->view('Salon/salonstaff',$data);
    }

    //_____________________________________________________________________________________________________________________________
    //delete staff member 
    public function deleteStaff()
    {
        $staffID = [];
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);
        $staffID['staffID'] = $data;
        
        $salonstaffID =  $staffID['staffID'] ?? null;

        if($salonstaffID === null)
        {
            echo json_encode([
                'success' => false,
                'message' => 'No offer ID provided.'
            ]);
        }

        $stafftable = new SalonStaffs;
        
        $data = $stafftable->deletestaff($salonstaffID);
        
        if ($data) 
        {
            echo json_encode([
                'success' => true,
                'message' => 'Offer deleted successfully.'
            ]);
        } 
        else 
        {
            echo json_encode([
                'success' => false,
                'message' => 'Failed to delete the offer.'
            ]);
        }

        exit;
    }

    //________________________________________________________________________________________________________________________________
    //update staff member 
    public function edit($staffID)
    {
        $staffID = (int)$staffID; // Convert to integer
        // Create the array to pass the form data
        $data = [];

        $staffModel = new SalonStaffs;
        $notifications = new Notification();

        $serviceData = $staffModel->wherestaff($staffID);
        $data['olddata'] = $serviceData;

        // show($data['olddata']);

        // Check if the submit button is clicked
        if (isset($_POST['update'])) 
        {
            show('hi');
            // Get the form data as the data array index
            $data = [
                'fullName' => htmlspecialchars(trim($_POST['MemberName'] ?? '')),
                'mobileNumber' => htmlspecialchars(trim($_POST['PhoneNumber'] ?? '')),
                'address' => htmlspecialchars(trim($_POST['memberAddress'] ?? '')),
                'NIC' => htmlspecialchars(trim($_POST['memberId'] ?? '')),
                'workingType' => htmlspecialchars(trim($_POST['job'] ?? '')),
                'salonID' => $_SESSION['SALON_USER'] ?? ''
            ];

            show($data);

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

            show($validateresult);

            if (empty($validateresult['errors'])) 
            {
                // Prepare file upload logic
                $validateresult['profilePicture']= "";
            
                if ($validateresult['photoname']) 
                {
                    $image = $validateresult['photoname'];
                    $validateresult['profilePicture'] = 'assets/images/salon/staff/' . $image;
                
                    if (!move_uploaded_file($validateresult['tempphoto'], $validateresult['profilePicture'])) 
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
                    $notifications = new Notification();

                        $result=$stafftable->updatestaff($staffID,$validateresult);

                        if($result)
                        {
                            $notifications->show("update Staff Details Successfully!",'success');
                            redirect('SalonStaff');
                        }
                        else
                        {
                            $notifications->show("update Staff details unsuccessfully.!",'error');
                        }
                } 
                else 
                {
                    // $data['errors'] = $validateresult['errors'];
                    $notifications->show("update Staff Profile picture cannot upload.!",'error');
                }
            }
            else 
            {
                // $data['errors'] = $validateresult['errors'];
                $notifications->show("updated some details incorrect update unsuccessfully.!",'error');
            }
        }

        $this->view('Salon/salonstaffedit', $data);
    }


    // Add salon service form data
    //______________________________________________________________________________________________________________________________________________
    public function add() 
    {
        // Create the array to pass the form data
        $data = [];

        $notifications = new Notification;

        // Check if the submit button is clicked
        if (isset($_POST['submit'])) 
        {
            // Get the form data as the data array index
            $data = [
                'fullName' => htmlspecialchars(trim($_POST['MemberName'] ?? '')),
                'mobileNumber' => htmlspecialchars(trim($_POST['PhoneNumber'] ?? '')),
                'address' => htmlspecialchars(trim($_POST['memberAddress'] ?? '')),
                'NIC' => htmlspecialchars(trim($_POST['memberId'] ?? '')),
                'workingType' => htmlspecialchars(trim($_POST['job'] ?? '')),
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

            // show($data);
            // Validate the data
            $validateresult = $this->SalonDataValidation($data);

            // show($validateresult);

            if (empty($validateresult['errors'])) 
            {
                // Prepare file upload logic
                $validateresult['profilePicture']= "";
            
                if ($validateresult['photoname']) 
                {
                    $image = $validateresult['photoname'];
                    $validateresult['profilePicture'] = 'assets/images/salon/staff/' . $image;
                
                    if (!move_uploaded_file($validateresult['tempphoto'], $validateresult['profilePicture'])) 
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

                    // show($stafftable);
                    try {
                        // Call the insert method
                        $stafftable->staffadd($validateresult);
                        $notifications->show("Insert Staff details successfully.!",'success');
                        // show($result);
                        // show('hi');
                
                        // If no exceptions occur, assume success
                        redirect('SalonStaff');
                    } catch (Exception $e) {
                        // show('ddf');
                        // Handle the exception if something goes wrong
                        // $data['errors'] = 'Data insert unsuccessful: ' . $e->getMessage();
                        // show( $data['errors']);
                        $notifications->show("update Staff details unsuccessfully.!",'error');
                    }
                } 
                else 
                {
                    // $data['errors'] = $validateresult['errors';
                    $notifications->show("Insert profile image unsuccessfully.!",'error');

                }
            }
            else 
            {
                // $data['errors'] = $validateresult['errors'];
                $notifications->show("Insert Staff details unsuccessfully.!",'error');
            }
        }

        $this->view('Salon/salonstaffadd', $data);
    }

    private function SalonDataValidation($arr) 
    {
        $arr['errors'] = []; // Initialize errors as an array

        // Validate PhoneNumber
        if (empty($arr['mobileNumber'])) 
        {
            $arr['errors'][] = 'Phone Number is required.';
        } 
        elseif (!preg_match('/^\d{10}$/', $arr['mobileNumber'])) 
        {
            $arr['errors'][] = 'Phone Number must be a valid 10-digit number.';
        }

        // Validate MemberName
        if (empty($arr['fullName'])) 
        {
            $arr['errors'][] = 'Member Name is required.';
        }


        // Validate memberAddress
        if (empty($arr['address'])) 
        {
            $arr['errors'][] = 'Member Address is required.';
        }

        // Validate job
        if (empty($arr['workingType'])) 
        {
            $arr['errors'][] = 'Job is required.';
        }

        // Validate NIC
        if (empty($arr['NIC'])) 
        {
            $arr['errors'][] = 'National Identity Card (NIC) is required.';
        } 
        elseif (!preg_match('/^\d{9}[vVxX]|\d{12}$/', $arr['NIC'])) 
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
