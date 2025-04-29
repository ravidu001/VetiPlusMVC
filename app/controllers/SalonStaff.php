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

    public function deleteStaff()
    {
        $staffID = [];
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);
        $staffID['staffID'] = $data;

        $notifications = new Notification();
        
        $salonstaffID =  $staffID['staffID'] ?? null;

        if($salonstaffID === null)
        {
            echo json_encode([
                'success' => false,
                'message' => 'No offer ID provided.'
            ]);
        }

        $stafftable = new SalonStaffs;
        
        $result = $stafftable->deletestaff($salonstaffID);
        
        if (!$result) 
        {
            // echo json_encode([
            //     'success' => true,
            //     'message' => 'Offer deleted successfully.'
            // ]);
            $notifications->show("Successfully delete staff member",'success');
        } 
        else 
        {
            // echo json_encode([
            //     'success' => false,
            //     'message' => 'Failed to delete the staff member.'
            // ]);
            $notifications->show("Cannot delete",'error');
        }

        exit;
    }

    public function edit($staffID)
    {
        $staffID = (int)$staffID; 
        
        $data = [];

        $staffModel = new SalonStaffs;
        $notifications = new Notification();

        $serviceData = $staffModel->wherestaff($staffID);
        $data['olddata'] = $serviceData;

        if (isset($_POST['update'])) 
        {
            $data = [
                'fullName' => htmlspecialchars(trim($_POST['MemberName'] ?? '')),
                'mobileNumber' => htmlspecialchars(trim($_POST['PhoneNumber'] ?? '')),
                'address' => htmlspecialchars(trim($_POST['memberAddress'] ?? '')),
                'age' => htmlspecialchars(trim($_POST['age'] ?? '')),
                'NIC' => htmlspecialchars(trim($_POST['memberId'] ?? '')),
                'workingType' => htmlspecialchars(trim($_POST['job'] ?? '')),
                'salonID' => $_SESSION['SALON_USER'] ?? ''
            ];

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
                $data = array_merge($data, [
                    'photoname' =>  "",
                    'tempphoto' =>  "",
                    'photosize' =>  ""
                ]);
            }

            $validateresult = $this->SalonDataValidation($data);

            show($validateresult);

            if (empty($validateresult['errors'])) 
            {
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
                            redirect('SalonStaff');
                           
                        }
                } 
                else 
                {
                    $notifications->show("update Staff Profile picture cannot upload.!",'error');
                    redirect('SalonStaff');
                    
                }
            }
            else 
            {
                $notifications->show("updated some details incorrect update unsuccessfully.!",'error');
                redirect('SalonStaff');
                
            }
        }

        $this->view('Salon/salonstaffedit', $data);
    }

    public function add() 
    {
        $data = [];

        $notifications = new Notification;

        if (isset($_POST['submit'])) 
        {
            $data = [
                'fullName' => htmlspecialchars(trim($_POST['MemberName'] ?? '')),
                'mobileNumber' => htmlspecialchars(trim($_POST['PhoneNumber'] ?? '')),
                'address' => htmlspecialchars(trim($_POST['memberAddress'] ?? '')),
                'age' => htmlspecialchars(trim($_POST['age'] ?? '')),
                'NIC' => htmlspecialchars(trim($_POST['memberId'] ?? '')),
                'workingType' => htmlspecialchars(trim($_POST['job'] ?? '')),
                'salonID' => $_SESSION['SALON_USER'] ?? ''
            ];

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
                $data = array_merge($data, [
                    'photoname' =>  "",
                    'tempphoto' =>  "",
                    'photosize' =>  ""
                ]);
            }

            $validateresult = $this->SalonDataValidation($data);

            if (empty($validateresult['errors'])) 
            {
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

                if (empty($validateresult['errors'])) 
                {

                    $keysToRemove = ['tempphoto', 'photosize',  'photoname'];

                    foreach ($keysToRemove as $key) 
                    {
                        unset($validateresult[$key]);
                    }

                    $stafftable = new SalonStaffs;

                       $result =  $stafftable->staffadd($validateresult);

                       if(!$result)
                       {
                            $notifications->show("Insert Staff details successfully.!",'success');
                            redirect('SalonStaff');
                       }
                       else
                       {
                            $notifications->show("update Staff details unsuccessfully.!",'error');
                            redirect('SalonStaff');
                       }
                } 
                else 
                {
                    $notifications->show("Insert profile image unsuccessfully.!",'error');
                    redirect('SalonStaff');
                }
            }
            else 
            {
                $notifications->show("Insert Staff details unsuccessfully.!",'error');
                redirect('SalonStaff');

            }
        }

        $this->view('Salon/salonstaffadd', $data);
    }

    private function SalonDataValidation($arr) 
    {
        $arr['errors'] = []; 

        if (empty($arr['mobileNumber'])) 
        {
            $arr['errors'][] = 'Phone Number is required.';
        } 
        elseif (!preg_match('/^\d{10}$/', $arr['mobileNumber'])) 
        {
            $arr['errors'][] = 'Phone Number must be a valid 10-digit number.';
        }

        if(!empty($arr['age']))
        {
            $age = $arr['age'];

            if( $age <= 18 || $age >= 50)
            {
                 $arr['errors'][] = 'Age cannot be a less than 18 or greater than 50.';
            }
        }

        if (empty($arr['fullName'])) 
        {
            $arr['errors'][] = 'Member Name is required.';
        }

        if (empty($arr['address'])) 
        {
            $arr['errors'][] = 'Member Address is required.';
        }

        if (empty($arr['workingType'])) 
        {
            $arr['errors'][] = 'Job is required.';
        }

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
            unset($arr['errors']); 
        }

        return $arr;
    }
}
?>
