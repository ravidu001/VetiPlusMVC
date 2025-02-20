<?php

class SalonTimeSlotView extends Controller
{
    public function index()
    {
        $data = [];

        $salonSession = new SalonTimeSlots();
        $detail = $salonSession->finAllDetails();
        
        //send to show the open days details in to the front page
       
        //check the salon is open days select or not
        //______________________________________________________________________________________
        if ($detail === false) {
            $data['empty'] = "You do not mark the any days to open your salon";
            $data['slot_details'] = [];
        } 
        else 
        {
            $data['slot_details'] =  $detail;
        }

        //check the any date select to the holidays
        //______________________________________________________________________________________
        if (isset($_POST['AddtoHoliday']) && isset($_POST['markholiday'])) {
            $marktoholiday = $_POST['markholiday'];
            $this->MarktoHoliday($marktoholiday);
        }

        $this->view('Salon/salontimeslotview',$data);
    }


    //______________________________________________________________________________________________
    private function MarktoHoliday($marktoholiday)
    {
        $salonSession = new SalonTimeSlots();
        
        // Find all slots for the selected open day
        $slots = $salonSession->findSlotsbyDate($marktoholiday);

        if (!empty($slots)) {
            $bookingExists = false;
            $bookedSlots = [];

            foreach ($slots as $slot) {
                if ($slot->status === 'booked') {
                    $bookingExists = true;
                    $bookedSlots[] = $slot;
                }
            }

            if ($bookingExists) {
                foreach ($bookedSlots as $bookedSlot) {
                    // Send email notification to the pet owner
                    // $this->sendCancellationEmail($bookedSlot->owner_email, $marktoholiday, $bookedSlot->time_slot);
                    show($bookedSlot);
                    echo "<script>alert('This day has this booked time slot please consider about it!');</script>";
                    // Refund logic can be implemented here if needed
                    $salonSession->updateSlotStatus($bookedSlot->salSessionID, 'blocked');
                }
                
                echo "<script>alert('Bookings exist for this date. Pet owners have been notified, and slots are blocked.');</script>";
            }
            else 
            {
                // If no bookings exist, delete all slots for the day
                foreach ($slots as $slot) {
                    $salonSession->deleteAllSlots($slot->salSessionID);
                }
                echo "<script>alert('All slots have been deleted for the selected holiday.');</script>";
            }
        }
    }


        // if (!empty($slots)) {
        //     // Loop through each slot and delete it
        //     foreach ($slots as $slot) {
        //         $salonSession->deleteAllSlots($slot->salSessionID);
        //     }
        // }
    

}