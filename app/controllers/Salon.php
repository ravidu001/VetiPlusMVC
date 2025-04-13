<?php

class Salon extends Controller
{
    
        public function index() 
        {
            $salonsessions = new SalonTimeSlots();
            $groomingSessions = new SalonBooked();
            $petowner = new PetOwners();//get the pet owners details

            //get the salon ID from the salon table 
            $salonID = $_SESSION['SALON_USER'];
    
            if(empty($salonID))
            {
                redirect('Login/login');
            }
    
            //define today
            $today = Date('Y-m-d');

            $data = [];

            $status = 'booked';
          
            //get the salon time slot data for today
            $data['slotdetails'] = $this->fetchTimeSlotData($salonID, $today);

            //get the appointments count
            $data['count'] = $this->fetchAppointmentsCount($salonID);

            //get the total customers 
            $data['customers'] = $this->fetchCustomerCount($salonID);

            $results = $salonsessions->fetchUpcomingAppointments($salonID, $today, $status);

            if($results)
            {
                // show($results);
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
    
            
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['markComplete'])) {
                $bookingID = $_POST['bookingID'];

                // Update the booking status to 'complete'
                $result = $groomingSessions->updateStatus($bookingID, ['status' => 2]);

                if($result == true)
                {
                    // Refresh the page to show updated list
                    header("Location: " . $_SERVER['PHP_SELF']);
                    exit;
                }
                else
                {
                    $data['error'] = "problem occur when updating";
                }
                
            }

            $this->view('Salon/salon', $data);
        }

        //get the today details 
        private function fetchTimeSlotData($salonID, $today)
        {
            $arr = [];
    
            $salonSession = new SalonTimeSlots();//salsession
    
            $result = $salonSession->slotsByDateAndSalon($salonID, $today);
    
            $arr = $result;
    
            return $arr;
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
            show($results);

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
}


?>