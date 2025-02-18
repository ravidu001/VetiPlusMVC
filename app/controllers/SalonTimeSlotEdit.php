<?php

class SalonTimeSlotEdit extends Controller
{
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])) {
           
           
            $salonID = $_SESSION['SALON_USER'];
            $open_time = gmdate("H:i:s", $_POST['openTime'] * 3600);
            $close_time = gmdate("H:i:s", $_POST['closeTime'] * 3600);
            $open_time = gmdate("H:i:s", $_POST['openTime'] * 3600);
            $close_time = gmdate("H:i:s", $_POST['closeTime'] * 3600);
            $slot_duration = $_POST['slotDuration'];
            
            // show($salonID);
            // show($salonID);
            // Initialize model
            $salonModel = new Salons();
            
            // Update database
            $data = [
                'open_time' => $open_time,
                'close_time' => $close_time,
                'slot_duration' => $slot_duration,
                'salonID' => $salonID
                'salonID' => $salonID
            ];

            // show($data);

            // show($data);
            
           $result =  $salonModel->updateSalonTimeSlots($salonID, $data);
            show($result);
            // Redirect to the SalonTimeSlot page after update
            redirect('SalonTimeSlot');
            exit();
        }
        
        $this->view('Salon/salontimeslotedit');
    }
}



