<?php

class SalonRegister extends Controller
{
    //get the form registration submit data
    private function getRegistrationdata($registration_table)
    {
        //create the new array to pass the data from submit form
        $arr = [];
        
        //check if the form is submit or not
        if(isset($_POST['submit'])) 
        {
            //if submit pass the data to the array
            $arr = [
                'salonName' => htmlspecialchars(trim($_POST['salonName'] ?? '')),
                'salonPhoneNumber' => htmlspecialchars(trim($_POST['salonPhoneNumber'] ?? '')),
                'location' => htmlspecialchars(trim($_POST['location'] ?? '')),
                'socialmedia' => htmlspecialchars(trim($_POST['socialmedia'] ?? '')),
                'businessregnumber' => htmlspecialchars(trim($_POST['businessregnumber'] ?? '')),
                'email' => $_SESSION['SALON_USER'] ?? ''
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
                        $arr['brcertificate'] = $image_folder;
                    }
                } 
                else 
                {
                    $arr['error'] = 'File upload error.';
                }
            }

            //check the form submit data is valid or not
            if (empty($arr['error'])) {

                $error = $registration_table->checkregisterdata(
                    $arr['salonName'],
                    $arr['salonPhoneNumber'],
                    $arr['location'],
                    $arr['socialmedia'],
                    $arr['businessregnumber']
                );

                //if it has the error then pass the error 
                if ($error) {
                    $arr['error'] = $error;
                }
              
            }
        }
        else
        {
            $arr['email'] = $_SESSION['SALON_USER'];
        }

        //return all array data
        return $arr;
    }

    //when reject again submit form update the data
    private function updateregisterdata($arr)
    {
        $data = ['success' => false, 'error' => null];

        //check the again email is has or not
        if(empty($arr['email'])) 
        {
            $data['error'] = "Email is required.";
        }

        $email = $arr['email'];
        // show($arr);
        //check if this is reject now should pass the status is pending
        $arr['status'] = 'pending';
        show($arr);

        $table = new SalonRegisters;

        if($table->update($email, $arr, 'email'))
        {
            // show($email);
            show($arr);
            $data['success'] = true;
        }
        else
        {
            show($email);
            show('ishan');
            show($email);
            $data['error'] = "data insert unsuccessfully";
        }

        return $data;
    }

    //if this is new email create the new 
    private function insertregisterdata($arr, $registration_table)
    {
        $data = ['success' => false, 'error' => null];

        //if cannot catch the email error or can redirect the login page
        if (empty($arr['email'])) {
            $data['error'] = "Email is required.";
            return;
        }

        if($registration_table->insert($arr))
        {
            $data['success'] = true;
        }
        else
        {
            $data['error'] = "data insert unsuccessfully";
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
        $registration_table = new SalonRegisters;

        // Check if same login email exists
        $existingRecord = $registration_table->where(['email' => $_SESSION['SALON_USER']]);
        
        // If existing record exists
        if($existingRecord) 
        {
            $data['oldemaildata'] = $existingRecord;
            $status = $existingRecord[0]->status;

            if($status === 'rejected' && isset($_POST['submit']))
            {
                $data = $this->getRegistrationdata($registration_table);

                if(empty($data['errors'])) 
                {
                    $result = $this->updateregisterdata($data);
                
                    if($result['success']) 
                    {
                        redirect('Pending');
                    }
                    else
                    {
                        $data['errors'][] = $result['error'];
                    }
                }
                $data['oldemaildata'] = $existingRecord[0];
            }
            elseif($status === 'pending')
            {
                redirect('Pending');
            }
            elseif($status === 'approved')
            {
                redirect('SalonDashboard');
            }            
        }
        else
        {
            // New registration
            $data = $this->getRegistrationdata($registration_table);

            if (empty($data['errors'])) {
                $result = $this->insertregisterdata($data, $registration_table);
                
                if ($result['success']) {
                    redirect('Pending');
                }
                else 
                {
                    $data['errors'][] = $result['error'];
                }
            }
        }

        $this->view('Salon/salonregister', $data);
    }

}
