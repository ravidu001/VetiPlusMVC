<?php

class AssisReview extends Controller {
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

        // create vetfeedback model
        $feedback = new AssistantSessionModel();
        
        // Get the logged-in user's ID
        $assisId = $_SESSION['assis_id'];

        // Fetch the reviews for the logged-in doctor
        $reviews = $feedback->getReviewsByAssisId($assisId);
        // Check if the reviews were fetched successfully
        // if ($reviews === false) {
        //     // Handle the error (show an error message)
        //     die('Error fetching reviews.');
        // }

        // Check if there are any reviews
        if (empty($reviews)) {
            echo "<script>console.log('No reviews found for this Assistant.');</script>";
        } else {
            // Proceed to access the reviews
            // print_r($reviews[0]->feedbackID); // This will work if there are reviews

            // Initialize variables for average rating calculation
            $totalRating = 0;
            $reviewCount = count($reviews);
            $unreadCount = 0; // Initialize unread count
            $readCount = 0;

            // Check if there are any reviews
            if ($reviewCount > 0) {
                foreach ($reviews as $reviewItem) {
                    if ($reviewItem->status === 1) {
                        $totalRating += $reviewItem->rating; 
                        $readCount++;
                    }
                    if ($reviewItem->status === 0) {
                        $unreadCount++; // Count unread reviews
                    }
                }
                // show($totalRating);
                // show($readCount);
                // show($unreadCount);
                $averageRating = $totalRating / $readCount; // Calculate average
            } else {
                $averageRating = 0; // No reviews, set average to 0
            }

            // Fetch assistant's name 
            $assis = new AssisModel(); 
            $assisData = $assis->find($assisId); 
            $assisName = $assisData->fullName; 

            // Initialize an array to hold consolidated session data
            $consolidatedReviews = [];
        
            if (is_array($reviews)) {
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
        }
        // show($consolidatedReviews);

        $this->view('assistant/assisreview',
        ['reviews' => $consolidatedReviews ?? null, 
        'averageRating' => $averageRating ?? null, 
        'unreadCount' => $unreadCount ?? null, 
        'assisName' => $assisName ?? null,
    ]);
    }

}
