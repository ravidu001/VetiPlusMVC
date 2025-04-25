<?php

$notifications = new Notification();

class SalonService extends Controller 
{

    public function index() 
    {
        $data = [];
        $servicedata = new SalonServices;

        $salonID = $_SESSION['SALON_USER'];

        //check the user login
        if(!$salonID)
        {
            redirect('Login');
        }
       
        $data = $servicedata->findAllServiceId($salonID);
        
        $this->view('Salon/salonservice', $data);
    }

    //__________________________________________________________________________________________________________________________
    //delete service function
    public function delete($serviceID)
    {
        $servicetable = new SalonServices;
        $servicetable->servicedelete($serviceID);
        
        // header('Content-Type: application/json');
        
        // if($result !== false)
        // {
        //     echo json_encode([
        //         'success' => true,
        //         'message' => 'Service deleted successfully.'
        //     ]);
        // }
        // else
        // {
        //     echo json_encode([
        //         'success' => false,
        //         'message' => 'Failed to delete the service.'
        //     ]);
        // }
        
        // exit;

    }
    //________________________________________________________________________________________________________________________________
    //update service details function

    public function edit($serviceID)
    {
        $serviceID = (int)$serviceID; // Convert to integer
        //fetch the all data in the database and push it in to the edit form for values
        $data = [];
        $serviceModel = new SalonServices;

        $serviceData = $serviceModel->whereservice($serviceID);
        $data['olddata'] = $serviceData;

        if(isset($_POST['update']))
        {
            // Get the form data as the data array index
            $data = [
                'serviceName' => htmlspecialchars(trim($_POST['serviceName'] ?? '')),
                'serviceCharge' => htmlspecialchars(trim($_POST['serviceCharge'] ?? '')),
                'serviceDescription' => htmlspecialchars(trim($_POST['serviceDescription'] ?? '')),
                'salonID' => $_SESSION['SALON_USER'] ?? ''
            ];

            // Check if photo1 is uploaded
            if (isset($_FILES['photo1']) && $_FILES['photo1']['error'] === UPLOAD_ERR_OK) 
            {
                $data = array_merge($data, [
                    'photoname1' => $_FILES['photo1']['name'],
                    'tempphoto1' => $_FILES['photo1']['tmp_name'],
                    'photo1size' => $_FILES['photo1']['size']
                ]);
                
            }
            else 
            {
                // Assign null values if photo1 is not uploaded
                $data = array_merge($data, [
                    'photoname1' =>  "",
                    'tempphoto1' =>  "",
                    'photo1size' =>  ""
                ]);
                show($data);
            }

            // Check if photo2 is uploaded
            if (isset($_FILES['photo2']) && $_FILES['photo2']['error'] === UPLOAD_ERR_OK) 
            {
                $data = array_merge($data, [
                    'photoname2' => $_FILES['photo2']['name'],
                    'tempphoto2' => $_FILES['photo2']['tmp_name'],
                    'photo2size' => $_FILES['photo2']['size']
                ]);
            }
            else 
            {
                // Assign null values if photo2 is not uploaded
                $data = array_merge($data, [
                    'photoname2' => "",
                    'tempphoto2' =>  "",
                    'photo2size' =>  ""
                ]);
            }

            // Validate the data
            $validateresult = $this->SalonDataValidation($data);

            show($validateresult);
            if (empty($validateresult['errors'])) 
            {
                // Prepare file upload logic
                $validateresult['photo1']= "";
                $validateresult['photo2']= "";

                if ($validateresult['photoname1']) 
                {
                    $image1 = $validateresult['photoname1'];
                    $validateresult['photo1'] = 'assets/images/salon/service/' . $image1;
                
                    if (!move_uploaded_file($validateresult['tempphoto1'], $validateresult['photo1'])) 
                    {
                        $validateresult['errors'] = "Failed to upload photo1.";
                    }
                }

                if ($validateresult['photoname2'])
                {
                    $image2 = $validateresult['photoname2'];
                    $validateresult['photo2'] = 'assets/images/salon/service/' . $image2;
                
                    if (!move_uploaded_file($validateresult['tempphoto2'], $validateresult['photo2'])) 
                    {
                        $validateresult['errors'] = "Failed to upload photo2.";
                    }
                }

                // Save service data if no errors
                if (empty($validateresult['errors'])) 
                {

                    $keysToRemove = ['tempphoto1', 'photo1size', 'tempphoto2', 'photo2size', 'photoname1', 'photoname2'];

                    foreach ($keysToRemove as $key) 
                    {
                        unset($validateresult[$key]);
                    }

                    $servicetable = new SalonServices;
                    try {
                        // Call the insert method
                        $result=$servicetable->serviceupdate($serviceID, $validateresult);

                        show($result);
                
                        // If no exceptions occur, assume success
                        redirect('SalonService');
                    } catch (Exception $e) {
                        // Handle the exception if something goes wrong
                        $data['errors'] = 'Data update unsuccessful: ' . $e->getMessage();
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

        $this->view('Salon\salonserviceedit', $data);  

    }

    //__________________________________________________________________________________________________________________________
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
                'serviceName' => htmlspecialchars(trim($_POST['serviceName'] ?? '')),
                'serviceCharge' => htmlspecialchars(trim($_POST['serviceCharge'] ?? '')),
                'serviceDescription' => htmlspecialchars(trim($_POST['serviceDescription'] ?? '')),
                'salonID' => $_SESSION['SALON_USER'] ?? ''
            ];

            // Check if photo1 is uploaded
            if (isset($_FILES['photo1']) && $_FILES['photo1']['error'] === UPLOAD_ERR_OK) 
            {
                $data = array_merge($data, [
                    'photoname1' => $_FILES['photo1']['name'],
                    'tempphoto1' => $_FILES['photo1']['tmp_name'],
                    'photo1size' => $_FILES['photo1']['size']
                ]);
            }
            else 
            {
                // Assign null values if photo1 is not uploaded
                $data = array_merge($data, [
                    'photoname1' =>  "",
                    'tempphoto1' =>  "",
                    'photo1size' =>  ""
                ]);
            }

            // Check if photo2 is uploaded
            if (isset($_FILES['photo2']) && $_FILES['photo2']['error'] === UPLOAD_ERR_OK) 
            {
                $data = array_merge($data, [
                    'photoname2' => $_FILES['photo2']['name'],
                    'tempphoto2' => $_FILES['photo2']['tmp_name'],
                    'photo2size' => $_FILES['photo2']['size']
                ]);
            }
            else 
            {
                // Assign null values if photo2 is not uploaded
                $data = array_merge($data, [
                    'photoname2' => "",
                    'tempphoto2' =>  "",
                    'photo2size' =>  ""
                ]);
            }

            // Validate the data
            $validateresult = $this->SalonDataValidation($data);

            if (empty($validateresult['errors'])) 
            {
                // Prepare file upload logic
                $validateresult['photo1']= "";
                $validateresult['photo2']= "";

                if ($validateresult['photoname1']) 
                {
                    $image1 = $validateresult['photoname1'];
                    $validateresult['photo1'] = 'assets/images/salon/service/' . $image1;
                
                    if (!move_uploaded_file($validateresult['tempphoto1'], $validateresult['photo1'])) 
                    {
                        $validateresult['errors'] = "Failed to upload photo1.";
                    }
                }

                if ($validateresult['photoname2'])
                {
                    $image2 = $validateresult['photoname2'];
                    $validateresult['photo2'] = 'assets/images/salon/service/' . $image2;
                
                    if (!move_uploaded_file($validateresult['tempphoto2'], $validateresult['photo2'])) 
                    {
                        $validateresult['errors'] = "Failed to upload photo2.";
                    }
                }

                // Save service data if no errors
                if (empty($validateresult['errors'])) 
                {

                    $keysToRemove = ['tempphoto1', 'photo1size', 'tempphoto2', 'photo2size', 'photoname1', 'photoname2'];

                    foreach ($keysToRemove as $key) 
                    {
                        unset($validateresult[$key]);
                    }

                    $servicetable = new SalonServices;
                    try {
                        // Call the insert method
                        $servicetable->serviceadd($validateresult);
                
                        // If no exceptions occur, assume success
                        redirect('SalonService');
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

        $this->view('Salon/salonserviceadd', $data);
    }

    //validate the data
    //____________________________________________________________________________________________________

    private function SalonDataValidation($arr) 
    {
        $arr['errors'] = []; // Initialize errors as an array

        if (empty($arr['serviceName'])) 
        {
            $arr['errors'][] = 'Service Name is required.';
        }

        if (!is_numeric($arr['serviceCharge']) || $arr['serviceCharge'] < 0) 
        {
            $arr['errors'][] = 'Service Charge must be a valid non-negative number.';
        }

        if (isset($arr['photo1size']) && $arr['photo1size'] > 1000000) 
        {
            $arr['errors'][] = 'Photo1 uploaded file is too large.';
        }

        if (isset($arr['photo2size']) && $arr['photo2size'] > 1000000) 
        {
            $arr['errors'][] = 'Photo2 uploaded file is too large.';
        }

        if (empty($arr['errors'])) 
        {
            unset($arr['errors']); // Remove errors key if no errors exist
        }

        return $arr;
    }

   
}
?>
