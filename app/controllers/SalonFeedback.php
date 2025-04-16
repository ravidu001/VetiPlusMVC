<?php

class SalonFeedback extends Controller
{

    public function index()
    {
        // Check if the user is logged in
        if(!isset($_SESSION['SALON_USER']))
        {
            //Ridirect to the login page if not logged in 
            header('Location: '. ROOT . '/users/login' );
            exit();
        }

        //create salon feedback model
        $feedbacktable = new SalonFeedbacks;

        //create  the logged-in user's ID
        $salonID = $_SESSION['SALON_USER'];

        // show($salonID);

        // Initialize these variables regardless of review results
        $consolidatedReviews = [];
        $averageRating = 0;
        $unreadCount = 0;
        $salonName = "";

        //Fetch the reviews for the logged-in doctor
        $reviews = $feedbacktable->getReviewsBySalonID($salonID);

        // show($reviews);

        //Check if the reviews were fetched successfully
        if($reviews == false)
        {
            //Handle the error (eg- show an error message)
            die('Error fetching reviews');
        }

        //Check if there are any reviews
        if(empty($reviews))
        {
            echo 'No reviews found for this salon .';
        }
        else
        {
            //Intialize varibles for average rating calculation
            $totalRating = 0;
            $reviewCount = count($reviews);
            $unreadCount = 0; // Initialize unread count

            // Check if there are any reviews 
            if($reviewCount > 0)
            {
                foreach($reviews as $reviewItem)
                {
                    $totalRating += $reviewItem->rating; //Assume rating is a property of the review
                    if($reviewItem->status === 0)
                    {
                        $unreadCount++; //Count unread reviews
                    }
                }
                $averageRating = $totalRating / $reviewCount; //Calculate average
            }
            else
            {
                $averageRating = 0; //No reviews , set average to 0
            }

            // Fetch salon's name(assuming you have a method to get it)
            $salon = new Salons();
            $salonData = $salon->FindUser($salonID); // Fetch salon data
            $salonName = $salonData->name;
            
            // Initialize an array to hold consolidated session data
            $consolidatedReviews = [];

            //Iterate over each review to get petowner data
            foreach ($reviews as $reviewItem) 
            {
                $petOwner = new PetOwner();
                $petOwnerData = $petOwner->getUserDetailsByID($reviewItem->petOwnerID);

                if($petOwnerData)
                {
                    //Considate session data
                    $consolidatedReviews[] = [
                        'reviewData' =>$reviewItem,
                        'petOwner' => $petOwnerData
                    ];
                }
            }
        }

        $this->view('Salon/salonfeedback',
            ['reviews' => $consolidatedReviews,
            'averageRating' => $averageRating,
            'unreadCount' => $unreadCount,
            'salonName' => $salonName]);

    }

    public function sendReply()
    {
        //Check if the user is logged in 
        if(!isset($_SESSION['SALON_USER']))
        {
            echo json_encode(['success' => false, 'message' =>'User not logged in.']);
            exit();
        }

        //get the posted data
        $data = json_decode(file_get_contents('php://input'), true);
        $feedbackID = $data['feedbackID'] ?? null;
        $replyContent = $data['replyContent'] ?? null;

        //Validate the input
        if(empty($feedbackID) || empty($replyContent))
        {
            echo json_encode(['success' => false, 'message' => 'Invalid input.']);
            exit();
        }

        //Create Salon Feedback model
        $feedback = new SalonFeedbacks();

        // Save the reply (you need to implemet this mehtod in your model)
        $result = $feedback->saveReply($feedbackID, $replyContent);

        if(!($result))
        {
            echo json_encode(['success' => true, 'message' => 'Reply sent successfully.']);
        }
        else
        {
            echo json_encode(['success' => false, 'message' => 'Failed to save reply.']);
        }
    }
}

?>