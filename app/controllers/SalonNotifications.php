<?php

class SalonNotifications extends Controller 
{
    public function index()
    {
        // $data = [];
        // $response = [];

        $salonID = $_SESSION['SALON_USER'];
        $type = $_SESSION['type'];

        //check the user is login or not
        if(!isset($salonID) || !isset($type))
        {
            redirect('Login/login');
        }

        $this->view('Salon/salonnotifications');
    }
   
    public function findUpComing()
    {
        $salonID = $_SESSION['SALON_USER'];
        $type = $_SESSION['type'];
    
        if (!isset($salonID) || !isset($type)) {
            redirect('Login/login');
        }
    
        $appointmentTable = new SalonBooked();
        $sessionTable = new SalonTimeSlots();
        $petOwner = new PetOwners();
    
        $status = 0;
        $count = 0;
        $upcomingData = [];
    
        // Get all bookings with status = 0
        $bookingdetails = $appointmentTable->getDetailsByStatus($status);
    
        if (!empty($bookingdetails)) {
            foreach ($bookingdetails as $booking) {

                $bookingdate = new  DateTime($booking->dateTime);

                $currentDate = new DateTime(); // This gives 2025-04-18 14:53:10.123456

                
                //skip the past and future dates
                if($bookingdate->format('Y-m-d') !== $currentDate->format('Y-m-d'))
                {
                    continue;
                }
    
                // Get session details (we need salonID from here)
                $session = $sessionTable->getSlotDetails($booking->salSessionID);
    
                if ($session && $session->salonID == $salonID) {
                    $owner = $petOwner->getPetOnwerDetailsByID($booking->petOwnerID);

                    $today = strtotime(date('Y-m-d'));

                    $openday = strtotime($session->openday);
                    $period =  ($openday - $today) / (60 * 60 * 24);
    
                    $upcomingData[] = [
                        'BookingDateTime' => $booking->dateTime,
                        'ownername' => $owner ? $owner->fullName : 'Unknown',
                        'service' => $booking->service,
                        'slot' => $session->time_slot,
                        'period' => $period,
                        'count' => $count + 1,
                        'today' => $today,
                    ];
                }
            }
        }
        header('Content-Type: application/json');
        echo json_encode($upcomingData);
        exit;
    }
    
}