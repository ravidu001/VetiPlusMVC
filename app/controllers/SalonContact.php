<?php

class SalonContact extends Controller
{
    public function index()
    {
        $data = [];

        $systemfeedbackTable = new systemfeedbackModel();
        $systemComplainTable = new systemcomplainModel();
        $adminTable = new AdminRegistrationModel();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contactSubmit'])) {
            $name = htmlspecialchars($_POST['name']);
            $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
            $contact = htmlspecialchars($_POST['contact']);
            $type = htmlspecialchars($_POST['type']);
            $message = htmlspecialchars($_POST['message']);
            $status = 'Pending';
            $dateTime = date('Y-m-d H:i:s');
            //how get the admin mail ??????????????????????
            $adminDetails = $adminTable->GetAdminDetails();

            show($adminDetails);

            if($adminDetails)
            {
                $adminMail = $adminDetails[0]->email;
            }

            if (!$adminMail) 
            {
                $data['error'] = "Admin email not found. Cannot submit complaint.";
                $this->view('Salon/saloncontact', $data);
                return;
            }
      
            if ($type === 'Feedback') 
            {
                $rating = isset($_POST['rate']) ? intval($_POST['rate']) : null;

                $array = [
                    'name' => $name,
                    'email' => $email,
                    'contact' => $contact,
                    'comment' => $message,
                    'feedbackDateTime' => $dateTime,
                    'status' => $status,
                    'rating' => $rating,
                    'adminEmail' => $adminMail
                ];

                $results = $this->SalonDataValidation($array);
                show($results);

                if ($results['error']) 
                {
                    $data['error'] = $results['error'];
                }
                else 
                {
                    show($array);

                    $result = $systemfeedbackTable->create($array);
                   
                    if (!$result) 
                    {
                        redirect('SalonContact');
                        $data['success'] = "Successfully inserted";
                    }
                    else 
                    {
                        $data['error'] = "Data cannot be inserted successfully";
                    }
                }
            } 
            elseif ($type === 'Inquiry') 
            {
                
                // Handle image upload for complaint
                if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) 
                {
                    $imagename = $_FILES['image']['name'];
                    $tempimage = $_FILES['image']['tmp_name'];
                    $imagesize = $_FILES['image']['size'];

                    $imageData = [
                        'imagename' => $imagename,
                        'tempimage' => $tempimage,
                        'imagesize' => $imagesize
                    ];

                    $imageValidation = $this->SalonDataValidation($imageData);

                    if (empty($imageValidation['errors'])) 
                    {
                        $imageFile = basename($imagename);
                        $destination = 'assets/images/salon/contact/' . $imageFile;

                        if (move_uploaded_file($tempimage, $destination)) 
                        {
                            // Save complaint with image path
                            $complaintData = [
                                'name' => $name,
                                'email' => $email,
                                'contact' => $contact,
                                'issue' => $message,
                                'dateTime' => $dateTime,
                                'status' => $status,
                                'adminEmail' => $adminMail,
                                'image' => $destination
                            ];

                            $result = $systemComplainTable->create($complaintData);

                            if(!$result)
                            {
                                $data['success'] = "Successfully inserted";
                            }
                            else 
                            {
                                $data['error'] = "Data cannot be inserted successfully";
                            }

                        } 
                        else 
                        {
                            $data['error'] = "Failed to upload the image.";
                        }
                    } 
                    else 
                    {
                        $data['error'] = $imageValidation['errors'];
                    }
                }

                else
                {
                    show('hhhhhhhhhhhhhhhhhhhhhh');
                    $array = [
                        'name' => $name,
                        'email' => $email,
                        'contact' => $contact,
                        'issue' => $message,
                        'dateTime' => $dateTime,
                        'status' => $status,
                        'adminEmail' => $adminMail
                    ];
    
                    $results = $this->SalonDataValidation($array);

                    show($results);
    
                    if ($results['error']) 
                    {
                        $data['error'] = $results['error'];
                    }
                    else 
                    { 
                        $result = $systemComplainTable->create($array);
                        
                        if (!$result) 
                        {
                            $data['success'] = "Successfully inserted";
                        }
                        else 
                        {
                            $data['error'] = "Data cannot be inserted successfully";
                        }
                    }
                }
            }
        }

        $this->view('Salon/saloncontact', $data);
    }

    private function SalonDataValidation($arr)
    {
        $errors = [];

        if (isset($arr['name']) && empty($arr['name'])) 
        {
            $errors[] = "Name is required.";
        }

        if (isset($arr['email']) && !filter_var($arr['email'], FILTER_VALIDATE_EMAIL)) 
        {
            $errors[] = "Invalid email format.";
        }

        if (isset($arr['contact']) && (!preg_match('/^[0-9]{10}$/', $arr['contact']))) 
        {
            $errors[] = "Contact must be 10 digits.";
        }

        if (isset($arr['imagename']) && $arr['imagename']) 
        {
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            $ext = strtolower(pathinfo($arr['imagename'], PATHINFO_EXTENSION));
            if (!in_array($ext, $allowedExtensions)) {
                $errors[] = "Only image files (jpg, jpeg, png, gif) are allowed.";
            }

            if ($arr['imagesize'] > 2 * 1024 * 1024) 
            {
                $errors[] = "Image size should be less than 2MB.";
            }
        }

        return ['error' => !empty($errors) ? implode("<br>", $errors) : null];
    }
}
?>
