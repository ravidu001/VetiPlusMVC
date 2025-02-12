<?php

class SalonTimeSlotEdit extends Controller
{
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])) {
            show('hii');
            $salonID = $_SESSION['SALON_USER'];
            $open_time = $_POST['openTime'];
            $close_time = $_POST['closeTime'];
            $slot_duration = $_POST['slotDuration'];
            
            // Initialize model
            $salonModel = new Salons();
            
            // Update database
            $updateData = [
                'open_time' => $open_time,
                'close_time' => $close_time,
                'slot_duration' => $slot_duration,
            ];
            
            $salonModel->updateSalonTimeSlots($salonID, $updateData);
            
            // Redirect to the SalonTimeSlot page after update
            redirect('SalonTimeSlot');
            exit();
        }
        
        $this->view('Salon/salontimeslotedit');
    }
}

?>
