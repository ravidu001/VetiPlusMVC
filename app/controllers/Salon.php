<?php

class Salon extends Controller
{
    public function index() 
    {
        $salonsessions = new SalonTimeSlots();
        $groomingSessions = new SalonBooked();
        $petowner = new PetOwners();
        $notifications = new Notification();

        $salonID = $_SESSION['SALON_USER'];

        if(empty($salonID))
        {
            redirect('Login/login');
        }

        $today = date('Y-m-d');
       
        $data = [];

        $status = 'booked';
        
        $data['slotdetails'] = $this->fetchTimeSlotData($salonID, $today);

        $data['reviews'] = $this->fetchTotalReviews($salonID);

        $data['count'] = $this->fetchAppointmentsCount($salonID);

        $data['customers'] = $this->fetchCustomerCount($salonID);

        $data['completedCount'] = $groomingSessions->getCompletedAppointmentsCount($salonID);

        $data['salonDetails'] = $this->fetchSalonDetails($salonID);

        $results = $salonsessions->fetchUpcomingAppointments($salonID, $today, $status);

        if($results)
        {
            foreach($results as $result)
            {
                $salsessionID = $result->salSessionID;
                
                $bookings = $groomingSessions->getSlotDetailsByID($salsessionID);
                
                if(!empty($bookings))
                {
                    $ownerID = $bookings[0] -> petOwnerID;
                    $owner = $petowner->getPetOnwerDetailsByID($ownerID);

                    $dateAndTime = $bookings[0]->dateTime;

                    $sendDate = date('Y-m-d', strtotime($dateAndTime)); 
                    $sendTime = date('H:i', strtotime($dateAndTime));  
                    
                    $appointment = [
                        'petOwner' => $owner->fullName ?? 'Unknown',
                        'contactNumber' => $owner->contactNumber ?? 'N/A',
                        'bookedDate' => $sendDate,
                        'bookedTime' => $sendTime,
                        'slotDate' => $result->openday,
                        'timeSlot' => $result->time_slot,
                        'service' => $bookings[0]->service,
                        'groomingID' => $bookings[0]->groomingID
                    ];
                    
                    $data['upcoming'][] = $appointment;

                }
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['markComplete'])) 
        {
            $bookingID = $_POST['bookingID'];

            $result = $groomingSessions->updateStatus($bookingID, ['status' => 2]);

            if($result == true)
            {
                $notifications->show("Booking Complete successfully!", 'success');
                header("Location: " . $_SERVER['PHP_SELF']);
                exit;
            }
            else
            {
                $notifications->show("Booking complete unsuccessfully!", 'error');
            }
            
        }

        $this->view('Salon/salon', $data);
    }

    //get the today details 
    private function fetchTimeSlotData($salonID, $today)
    {
        $salonSession = new SalonTimeSlots();//salsession
        $salonBooked = new SalonBooked();//grooming

        $results = $salonSession->slotsByDateAndSalon($salonID, $today);

        $slotDetails = [];

        if($results)
        {
            foreach ($results as $result) 
            {
                $slotDetails[] = [
                    'completeAppointments' => $salonBooked->getCompletedCountBySlot($result->salSessionID),
                    'time_slot' => $result->time_slot,
                    'noOfBookings' => $result->noOfBookings,
                    'status' => $result->status
                ];
            }
        }

        return $slotDetails;
    }

    //get the total appointments
    private function fetchAppointmentsCount($salonID)
    {
        $count = 0;

        $groomingSessions = new SalonBooked;
        $salsessiontable = new SalonTimeSlots;

        $results = $groomingSessions->FindBookedDetails();

        if (!$results || !is_array($results)) 
        {
            return 0;
        }

        foreach($results as $result)
        {
            $salsessionID =  $result->salSessionID;

            $saldetails = $salsessiontable->getSlotDetails($salsessionID);

            if($saldetails && $saldetails->salonID == $salonID)
            {
                $count++; 
            }

        }

        return $count;
    }

    //function to get the customer counts
    private function fetchCustomerCount($salonID)
    {
        $uniqueCustomers = [];
        
        $groomingSessions = new SalonBooked;
        $salsessiontable = new SalonTimeSlots;

        $results = $groomingSessions->FindBookedDetails();

        if (!$results || !is_array($results)) 
        {
            return 0;
        }

        foreach($results as $result)
        {
            $salsessionID =  $result->salSessionID;
            $ownerID = $result->petOwnerID;

            $saldetails = $salsessiontable->getSlotDetails($salsessionID);

            if($saldetails && $saldetails->salonID == $salonID)
            {
                if (!in_array($ownerID, $uniqueCustomers)) {
                    $uniqueCustomers[] = $ownerID; // Add only if not already in array
                }
            }
        }
        return count($uniqueCustomers);
    }

    //find the total reviews in the site
    private function fetchTotalReviews($salonID)
    {
        $feedbackModel = new SalonFeedbacks();
        
        $ratingCount = 0;

        $feedbackdetails = $feedbackModel->getAllDetails($salonID);

        if($feedbackdetails)
        {
            foreach($feedbackdetails as $feedbackdetail)
            {
                $rating = $feedbackdetail->rating;

                if($rating > 5)
                {
                    $rating = $rating/5;
                }

                $ratingCount += $rating;
            }
        
        }
        return $ratingCount;
    }

    //find the salon details
    private function fetchSalonDetails($salonID)
    {
        $salonModel = new Salons();

        $salonDetails = $salonModel->FindUser($salonID);
        
        if($salonDetails)
        {
            $OwnerName = $salonDetails->ownerName;
        }
        return $OwnerName;
    }
}


?>