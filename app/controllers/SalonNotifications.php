<?php

class SalonNotifications extends Controller 
{
    public function index()
    {
        $data = [];
        // $response = [];

        $salonID = $_SESSION['SALON_USER'];

        //check the user is login or not
        if(empty($salonID))
        {
            redirect('Login/login');
        }

        //get the upcoming data
        // $data['upcoming'] = $this->FindUpcoming($salonID);
        // $data['upcoming'] = $this->FindUpcoming();

        // if(!empty($data['upcoming']))
        // {
        //     redirect('Salon/salon',$data);
        // }
        
        // $response = $data['upcoming'];

        $this->view('Salon/salonnotifications');
    }

    //function to get the upcoming data
    public function FindUpcoming()

    {
        $array = [];

        $salonID = $_SESSION['SALON_USER'];

        //check the user is login or not
        if(empty($salonID))
        {
            redirect('Login/login');
        }


        $appointmentTable = new SalonBooked();
        $SessionTable = new SalonTimeSlots();
        $petOwner = new PetOwner();

        $status = 0;
        $count = 0;
        $date = date('Y-m-d');

        $bookingdetails = $appointmentTable->getDetailsByStatus($status);

        if($bookingdetails)
        {
            foreach($bookingdetails as $bookingdetail)
            {
                //give the slot booking slot details ID
                $salsessionID = $bookingdetail->salSessionID;

                //upcoming, this salon, today
                $slotDetails = $SessionTable->fetchSessionByDate($salonID,$salsessionID, $date);

                //has today (the day) upcoming this salon
                if($slotDetails)
                {
                    foreach ($slotDetails as $slotDetail) 
                    {
                        $sessionID = $slotDetail->salSessionID;
                        $day = $slotDetail->openday;
                        $slot = $slotDetail->time_slot;

                        $period = $day - $date;

                        //Now get details using salonID,salsessionID
                        $groomingDetails = $appointmentTable->getSlotDetailsByID($sessionID);

                        $service = $groomingDetails[0]->service;
                        $petID = $groomingDetails[0] ->petOwnerID;
                        $appoinmentDate = $groomingDetails[0]->dateTime;
                    
                        $petOwnerDetail = $petOwner->getUserDetailsByID($petID);

                        $petOwnerName = $petOwnerDetail->fullName;

                        if($period > 0)
                        {   
                            $array[] = [
                                'slotday' => $day,
                                'slot' => $slot,
                                'service' => $service,
                                'ownername' => $petOwnerName,
                                'BookingDate' => $appoinmentDate,
                                'period' => $period
                            ];
                           $count ++;
                        }
                    }
                }
            }
        }
        
        
        //  return $count;
        header('Content-Type: application/json');
        echo json_encode($array);
        exit;

    }

}