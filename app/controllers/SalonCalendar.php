<?php

class SalonCalendar extends Controller {

    public function index() {
        $data = [];

        $salsession = new SalonTimeSlots();

        // Get date from request (if sent via POST)
        // $date = $_POST['date'] ?? date('Y-m-d'); // Default to today if not provided

        $date = '2025-02-28';

        $result = $salsession->findSlotsbyDate($date);

        // Log result for debugging (optional)
        show($result);

        // Pass data to view
        $data['slots'] = $result;
        $this->view('Salon/test', $data);
    }

    // API endpoint to handle AJAX requests
    public function getSlots() 
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') 
        {
            $date = $_POST['date'] ?? null;

            if ($date) 
            {
                $salsession = new SalonTimeSlots();
                $result = $salsession->findSlotsbyDate($date);

                echo json_encode(['success' => true, 'slots' => $result]);
                exit;
            } 
            else 
            {
                echo json_encode(['success' => false, 'message' => 'Date not provided']);
                exit;
            }
        }
    }
}

?>
