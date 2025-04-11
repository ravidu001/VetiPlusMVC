<?php

class DoctorReview extends Controller {
    public function index() {
        // Check if the user is logged in
        if (!isset($_SESSION['user_id'])) {
            // Redirect to the login page if not logged in
            header('Location: ' . URLROOT . '/users/login');
            exit();
        }

        // create vetfeedback model
        $feedback = new VetFeedbackModel();
        
        // Get the logged-in user's ID
        $doctorId = $_SESSION['user_id'];

        // Fetch the reviews for the logged-in doctor
        $reviews = $feedback->getReviewsByDoctorId($doctorId);
        // Check if the reviews were fetched successfully
        if ($reviews === false) {
            // Handle the error (e.g., show an error message)
            die('Error fetching reviews.');
        }

        // Check if there are any reviews
        if (empty($reviews)) {
            echo 'No reviews found for this doctor.';
        } else {
            // Proceed to access the reviews
            //print_r($reviews[0]->feedbackID); // This will work if there are reviews

            // Initialize variables for average rating calculation
            $totalRating = 0;
            $reviewCount = count($reviews);
            $unreadCount = 0; // Initialize unread count

            // Check if there are any reviews
            if ($reviewCount > 0) {
                foreach ($reviews as $reviewItem) {
                    $totalRating += $reviewItem->rating; // Assuming rating is a property of the review
                    if ($reviewItem->status === 0) {
                        $unreadCount++; // Count unread reviews
                    }
                }
                $averageRating = $totalRating / $reviewCount; // Calculate average
            } else {
                $averageRating = 0; // No reviews, set average to 0
            }

            // Fetch doctor's name (assuming you have a method to get it)
            $doctor = new DoctorModel(); // Assuming you have a Doctor model
            $doctorData = $doctor->find($doctorId); // Fetch doctor data
            $doctorName = $doctorData->fullName; // Assuming fullName is a property

            // Initialize an array to hold consolidated session data
            $consolidatedReviews = [];
        
            // Iterate over each review to get petowner data
            foreach ($reviews as $reviewsItem) {
                $petOwner = new PetOwner();
                $petOwnerData = $petOwner->getUserDetails($reviewsItem->petOwnerID);
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

        // show($reviews);

        $this->view('vetDoctor/doctorreview', 
            ['reviews' => $consolidatedReviews, 
            'averageRating' => $averageRating, 
            'unreadCount' => $unreadCount, 
            'doctorName' => $doctorName]);
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
