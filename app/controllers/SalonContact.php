<?php

class SalonContact extends Controller
{
    public function index()
    {
        $data = [];

        $systemfeedbackTable = new systemfeedbackModel();
        $systemComplainTable = new systemcomplainModel();
        $notifications = new Notification();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contactSubmit'])) {
            $name = htmlspecialchars($_POST['name']);
            $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
            $contact = htmlspecialchars($_POST['contact']);
            $type = htmlspecialchars($_POST['type']);
            $message = htmlspecialchars($_POST['message']);
            $status = 'Pending';
            $dateTime = date('Y-m-d H:i:s');
            //how get the admin mail ??????????????????????
            
      
            if ($type === 'Feedback') 
            {
                $rating = isset($_POST['rate']) ? intval($_POST['rate']) : null;

                $array = [
                    'name' => $name,
                    'email' => $email,
                    'contactNumber' => $contact,
                    'comment' => $message,
                    'feedbackDateTime' => $dateTime,
                    'status' => $status,
                    'rating' => $rating
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
                        // redirect('SalonContact');
                        // $data['success'] = "Successfully inserted";
                         $notifications->show("Successfully inserted!",'success');
                         exit();
                    }
                    else 
                    {
                        // $data['error'] = "Data cannot be inserted successfully"
                        $notifications->show("Data cannot be inserted successfully!",'error');
                        exit();
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
                                'image' => $destination
                            ];

                            $result = $systemComplainTable->create($complaintData);

                            if(!$result)
                            {
                                // $data['success'] = "Successfully inserted"
                                $notifications->show("Successfully inserted!",'success');
                                exit();
                            }
                            else 
                            {
                                // $data['error'] = "Data cannot be inserted successfully";
                                $notifications->show("Data cannot be inserted successfully!",'error');
                                exit();
                            }

                        } 
                        else 
                        {
                            // $data['error'] = "Failed to upload the image.";
                            $notifications->show("Failed to upload the image.!",'error');
                            exit();
                        }
                    } 
                    else 
                    {
                        // $data['error'] = $imageValidation['errors'];
                        $notifications->show("Uploaded image is too large!",'error');
                        exit();
                    }
                }

                else
                {
                    $array = [
                        'name' => $name,
                        'email' => $email,
                        'contact' => $contact,
                        'issue' => $message,
                        'dateTime' => $dateTime,
                        'status' => $status
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
                            // $data['success'] = "Successfully inserted";
                            $notifications->show("Successfully inserted!",'success');
                            exit();
                        }
                        else 
                        {
                            // $data['error'] = "Data cannot be inserted successfully";
                            $notifications->show("Data cannot be inserted successfully!",'error');
                            exit();
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
