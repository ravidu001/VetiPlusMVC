<?php

class Assistant extends Controller {
    public function index() {
        // Check if the user is logged in
        if (!isset($_SESSION['assis_id'])) {
            header('Location: ' . ROOT . '/login');
            $notification = new Notification();
            $_SESSION['notification'] = [
                'message' => 'You are not authorized to access this page.',
                'type' => 'error',
            ];
            exit;
        }

        if ($_SESSION['type'] != 'Vet Assistant') {
            header('Location: ' . ROOT . '/login');
            $notification = new Notification();
            $_SESSION['notification'] = [
                'message' => 'You are not authorized to access this page.',
                'type' => 'error',
            ];
            exit;
        }

        $assistantID = $_SESSION['assis_id'];

        // Load the model
        $assistant = new AssisModel();
        $assistantData = $assistant->find($assistantID);
        // Check if the assistant data is found
        if (!$assistantData) {
            // Handle the case where the assistant data is not found
            // You can redirect or show an error message
            header('Location: /login');
            exit();
        }

        $session = new AssistantSessionModel();
        $sessionData = $session->getSessionByAssistant($assistantID);
        $acceptedCount = 0;
        $pendingCount = 0;
        $reviewCount = 0;
        if(is_array($sessionData)) {
            foreach ($sessionData as $sessionItem) {
                if ($sessionItem->action == 'accept') {
                    $acceptedCount++;
                }
                if ($sessionItem->action == 'pending') {
                    $pendingCount++;
                }
                if ($sessionItem->status == '1') {
                    $reviewCount++;
                }
            }   
        }
        // show($sessionData);
        // show($acceptedCount);
        // show($pendingCount);


        // Get all the assistants' sessions
        $assisSession = new AssistantSessionModel();
        $assisSessionData = $assisSession->getSessionByAssistant($assistantID);
        // show($assisSessionData);

        $consolidatedData = [];
        if (is_array($assisSessionData)) {
            foreach ($assisSessionData as $assisSessionItem) {
                if ($assisSessionItem->action == 'accept') {
                    $session = new DoctorSessionModel();
                    $sessionData = $session->getsessionBySession($assisSessionItem->sessionID);
    
                    foreach ($sessionData as $sessionItem) {
                        // check session is a future session
                        $endTime = new DateTime($sessionItem->endTime); // Create a DateTime object for the session start time
                        $currentTime = new DateTime(); // Get the current time
                        if ($sessionItem->selectedDate == date('Y-m-d')) {
                            if ($endTime >= $currentTime) {
                                $doctor = new DoctorModel();
                                $doctorData = $doctor->find($sessionItem->doctorID);
                                $consolidatedData[] = [
                                    'doctor' => $doctorData,
                                    'session' => $sessionItem,
                                    'assisSession' => $assisSessionItem
                                ];
                            }   
                        } elseif ($sessionItem->selectedDate > date('Y-m-d') ){
                            $doctor = new DoctorModel();
                            $doctorData = $doctor->find($sessionItem->doctorID);
                            $consolidatedData[] = [
                                'doctor' => $doctorData,
                                'session' => $sessionItem,
                                'assisSession' => $assisSessionItem
                            ];
                        }
                    }
                }
            }
            
        }


        // create vetfeedback model
        $feedback = new AssistantSessionModel();

        // Fetch the reviews for the logged-in doctor
        $reviews = $feedback->getReviewsByAssisId($assistantID);
        // Check if the reviews were fetched successfully
        // if ($reviews === false) {
        //     // Handle the error (show an error message)
        //     die('Error fetching reviews.');
        // }

        // Initialize an array to hold consolidated session data
        $consolidatedReviews = [];
        // Fetch assistant's name 
        $assis = new AssisModel(); 
        $assisData = $assis->find($assistantID); 
        $assisName = $assisData->fullName; 
        // Check if there are any reviews
        if (empty($reviews)) {
            echo "<script>console.log('No reviews found for this assistant.');</script>";
        } else {
            // Iterate over each review to get petowner data
            foreach ($reviews as $reviewsItem) {
                $session = new DoctorSessionModel();
                $sessionData = $session->getsessionBySession($reviewsItem->sessionID);
                foreach ($sessionData as $sessionItem) {
                    $doctor = new DoctorModel();
                    $doctorData = $doctor->find($sessionItem->doctorID);
                    // print_r($doctorData->fullName);
    
                    if ($doctorData && $reviewsItem->status === 1) {
                        // Consolidate session data
                        $consolidatedReviews[] = [
                            'reviewData' => $reviewsItem,
                            'doctor' => $doctorData
                        ];
                    }  
                }   
            }
        }

        $this->view('assistant/home', [
            'assistantData' => $assistantData,
            'consolidatedData' => $consolidatedData,
            'reviews' => $consolidatedReviews,
            'acceptedCount' => $acceptedCount,
            'pendingCount' => $pendingCount,
            'reviewCount' => $reviewCount,
            'assisName' => $assisName
        ]);
    }

}
