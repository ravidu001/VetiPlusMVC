<?php

class Doctor extends Controller {
    public function index() {
        // Check if the user is logged in
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . ROOT . '/login');
            $notification = new Notification();
            $_SESSION['notification'] = [
                'message' => 'You are not authorized to access this page.',
                'type' => 'error',
            ];
            exit;
        }

        // if ($_SESSION['type'] != 'Vet Doctor') {
        //     header('Location: ' . ROOT . '/login');
        //     $notification = new Notification();
        //     $_SESSION['notification'] = [
        //         'message' => 'You are not authorized to access this page.',
        //         'type' => 'error',
        //     ];
        //     exit;
        // }

        $doctorID = $_SESSION['user_id'];

        // Load the model
        $doctor = new DoctorModel();
        $doctorData = $doctor->find($doctorID);
        // Check if the doctor data is found
        if (!$doctorData) {
            // Handle the case where the doctor data is not found
            // You can redirect or show an error message
            header('Location: ' . ROOT . '/login');
            exit();
        }

        $session = new DoctorSessionModel();
        $sessionData = $session->getsession($doctorID);
        $appointmentData = []; // Initialize the array
        if (is_array($sessionData)) {
            foreach ($sessionData as $sessionItem) {
                $appointment = new AppointmentModel();
                $appointments = $appointment->getAppointmentBySession($sessionItem->sessionID);
                if (!empty($appointments)) {
                    $appointmentData = array_merge($appointmentData, $appointments);
                }
            }
        } else {
            error_log("getsession did not return an array for doctorID: " . $doctorID);
        }
        $appointmentCount = count($appointmentData); // Get the count of appointments
        // show($appointmentCount);

        $currentDate = date('Y-m-d');
        $currentMonth = date('m');
        $currentYear = date('Y');
        
        $monthlyappointmentData = []; // Initialize the array
        $monthlyappointmentCount = 0;

        if (is_array($sessionData)) {
            foreach ($sessionData as $sessionItem) {
                // Extract the month and year from the selectedDate
                $selectedMonth = date('m', strtotime($sessionItem->selectedDate));
                $selectedYear = date('Y', strtotime($sessionItem->selectedDate));
                if ($selectedYear == $currentYear && $selectedMonth == $currentMonth) {
                    $appointment = new AppointmentModel();
                    $monthlyappointments = $appointment->getAppointmentBySession($sessionItem->sessionID);
                    if (!empty($monthlyappointments)) {
                        foreach ($monthlyappointments as $monthlyappointment) {
                            // Check if the appointment status is 'completed'
                            if($monthlyappointment->status == 'completed'){
                                $monthlyappointmentCount++;
                                // $monthlyappointmentData = array_merge($monthlyappointmentData, $monthlyappointment); // Merge appointments into the array
                            }
                        }
                    }
                }
            }
        } else {
            error_log("getsession did not return an array for sessionID: ");
        }
        //$monthlyappointmentCount = count($monthlyappointmentData); // Get the count of appointments
        // show($monthlyappointmentCount);

        $feedback = new VetFeedbackModel();
        $feedbackData = $feedback->getReviewsByDoctorId($doctorID);

        $feedbackCount = 0;
        if (is_array($feedbackData)) {
            foreach ($feedbackData as $feedbackItem) {
                // Check if the feedback status is 'completed'
                if($feedbackItem->status == 'completed'){
                    $feedbackCount++;
                }
            }
        } else {
            // Log or handle the case where $feedbackData is not an array
            error_log("getReviewsByDoctorId did not return an array for doctorID: " . $doctorID);
        }


        $session = new DoctorSessionModel;

        // $update = $this->inserthistory();
    
        // Get all sessions for the doctor
        $sessionData = $session->getsession($doctorID);
    
        // Initialize an array to hold consolidated session data
        $consolidatedSessions = [];
    
        if (is_array($sessionData)) {
            // Iterate over each session to get assistant session data
            foreach ($sessionData as $sessionItem) {
                if($sessionItem->completeStatus == 1) {
                    continue;
                }
    
                $appointment = new AppointmentModel();
                $appointmentData = $appointment->getAppointmentBySession($sessionItem->sessionID);
                $eachappointmentCount = 0; 
                if (is_array($appointmentData)) {
                    foreach ($appointmentData as $appointmentItem) {
                        // Check if the appointment status is 'available'
                        if ($appointmentItem->status == 'available') {
                            $eachappointmentCount++;
                        }
                    }
                } else {
                    // Log or handle the case where $appointmentData is not an array
                    error_log("getAppointmentBySession did not return an array for sessionID: " . $sessionItem->sessionID);
                }
    
                $assisSession = new AssistantSessionModel;
                $assisSessionData = $assisSession->getAssistantsession($sessionItem->sessionID);
        
                // Prepare assistant data for this session
                $sessionAssistants = [];
        
                // Check if assistant session data is found
                if ($assisSessionData) {
                    foreach ($assisSessionData as $assisSessionItem) {
                        $assistant = new AssisModel;
                        $assistantData = $assistant->getAssistant($assisSessionItem->assistantID);
        
                        if ($assistantData) {
                            $sessionAssistants[] = $assistantData;
                        }
                    }
                }
        
                // Consolidate session data
                $consolidatedSessions[] = [
                    'session' => $sessionItem,
                    'assistants' => $sessionAssistants,
                    'appointmentCount' => $eachappointmentCount
                ];
            }
            
        }

        // create vetfeedback model
        $feedback = new VetFeedbackModel();

        // Fetch the reviews for the logged-in doctor
        $reviews = $feedback->getReviewsByDoctorId($doctorID);
        // Check if the reviews were fetched successfully

        // if ($reviews === false) {
        //     // Handle the error (e.g., show an error message)
        //     die('Error fetching reviews.');
        // }


        // Initialize an array to hold consolidated session data
        $consolidatedReviews = [];
        // Check if there are any reviews
        if (empty($reviews)) {
            echo "<script>console.log('No reviews found for this doctor.');</script>";
        } else {
            // Fetch doctor's name 
            $doctor = new DoctorModel(); 
            $doctorData = $doctor->find($doctorID); // Fetch doctor data
            $doctorName = $doctorData->fullName; 

            // Iterate over each review to get petowner data
            foreach ($reviews as $reviewsItem) {
                $petOwner = new PetOwner();
                $petOwnerData = $petOwner->getUserDetailsByID($reviewsItem->petOwnerID);
                // print_r($petOwnerData->fullName);

                if ($petOwnerData) {
                    // Consolidate session data
                    $consolidatedReviews[] = [
                        'reviewData' => $reviewsItem,
                        'petOwner' => $petOwnerData
                    ];
                }
                
            }
        }


        $this->view('vetDoctor/home', [
            'doctorData' => $doctorData,
            'sessions' => $consolidatedSessions,
            'appointmentCount' => $appointmentCount,
            'appointmentData' => $appointmentData,
            'monthlyappointmentCount' => $monthlyappointmentCount,
            'feedbackCount' => $feedbackCount,
            'reviews' => $consolidatedReviews,
            'doctorName' => isset($doctorName) ? $doctorName : null
        ]);
    }


    public function sendReply() {
        // Check if the user is logged in
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['success' => false, 'message' => 'User  not logged in.']);
            exit();
        }

        // Get the posted data
        $data = json_decode(file_get_contents('php://input'), true);
        $feedbackID = $data['feedbackID'] ?? null;
        $replyContent = $data['replyContent'] ?? null;

        // Validate the input
        if (empty($feedbackID) || empty($replyContent)) {
            echo json_encode(['success' => false, 'message' => 'Invalid input.']);
            exit();
        }

        // Create vetfeedback model
        $feedback = new VetFeedbackModel();

        // Save the reply (you need to implement this method in your model)
        $result = $feedback->saveReply($feedbackID, $replyContent);

        if (!($result) ) {
            echo json_encode(['success' => true, 'message' => 'Reply sent successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to save reply.']);
        }

        // $this->view('vetDoctor/doctorreview');
    }

}
