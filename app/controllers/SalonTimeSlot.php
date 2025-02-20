<?php

class SalonTimeSlot extends Controller 
{
    
    public function index() 
    {
        //get the variable to the time slot module
        $salonSession = new SalonTimeSlots();

        $data = [];

        //assign to todayDate to today current date caompare and create the rules 
        $todayDate = date('Y-m-d');

        //(condition ? true_value : false_value)
        //want to show the time slot if it select then it show else show the today time slots
        $selectedDate = isset($_POST['slotDate']) ? $_POST['slotDate'] : $todayDate;

        

        //get the details about select date/today
        $detail = $salonSession->findSlotsbyDate($selectedDate);

        //if not pass the slot it means no any time slots create / actullay like the close day
        if ($detail === false) {
            $data['empty'] = "Today has no time slot allocation for your salon";
            $data['time_slot'] = [];
        } 
        //if has details has time slots put the details in to data array
        else 
        {
            $data['time_slot'] = $detail;
        }
    
        //_________________________________________________________________________________________________________________________
        //if pass the date range to create the time slots 
        if (isset($_POST['date_range'])) {
            $this->handleDateRangeSubmission();
        }

        //pass the one date to create the time slots
        if (isset($_POST['onedate'])) {
            $this->handleSingleDateSubmission();
        }

        //if any one want to block the slot 
        // want to check the time or date 
        if (isset($_POST['SlotBlock']) && isset($_POST['salSessionID'])) {
            $salSessionID = $_POST['salSessionID'];
            $this->attemptUpdateSlotStatus($salSessionID, 'blocked');
        }

        //if any one want to availble the block time slot
        //want to check the time or date 
        if (isset($_POST['SlotAvailable']) && isset($_POST['salSessionID'])) {
            $salSessionID = $_POST['salSessionID'];
            $this->attemptUpdateSlotStatus($salSessionID, 'available');
        }

        //get the Salon start time, close time, duration from the salons table
        //____________________________________________________________________________________________________________________________
        $salonID = $_SESSION['SALON_USER'];
        if(isset($salonID))
        {
            $data['salondetails'] = $this->getSalonDetails($salonID);
        }
        else
        {
            echo "the salon id not found";
        }



        $this->view('Salon/salontimeslot', $data);
    }

    //_________________________________________________________________________________________________________________________

    private function handleDateRangeSubmission()
    {
        //get the all details in to varible->range start date, close date , holidays
        $start = $_POST['startDate'];
        $end = $_POST['endDate'];
        $holidays = isset($_POST['holidays']) ? $_POST['holidays'] : []; //if we want to store the holidays can get // ask this
        $today = date('Y-m-d');
        $salonID = $_SESSION['SALON_USER'] ?? '';

        //can store the range without start today and issarahata tyana dawass oni ekk 
        if ($start <= $today || $end <= $start) {
            echo "<script>alert('Error: Invalid date selection!');</script>";
            return;
        }

        //filter the days without holiday
        $filteredDates = $this->filterDates($start, $end, $holidays);
        //pass the filter days to create the time slots
        $timeSlots = $this->generateTimeSlots($filteredDates, $salonID);
        //save the time slots in to the database
        $this->saveTimeSlots($timeSlots, $salonID);
    }

    
    //_________________________________________________________________________________________________________________________
    private function handleSingleDateSubmission()
    {
        $date = $_POST['date'];
        $salonID = $_SESSION['SALON_USER'] ?? '';
        $today = date('Y-m-d');

        if (empty($salonID) || $date <= $today) {
            echo "<script>alert('Error: Invalid salon ID or date!');</script>";
            return;
        }

        $timeSlots = $this->generateTimeSlots([$date], $salonID);
        $this->saveTimeSlots($timeSlots, $salonID);
    }

    //_________________________________________________________________________________________________________________________

    private function attemptUpdateSlotStatus($slotID, $status)
    {
        $salonSession = new SalonTimeSlots();
        $currentDateTime = date("Y-m-d H:i:s");  // Get current date and time
        $currentDate = date("Y-m-d"); // Get only the current date
        $currentTime = date("H:i");  // Get only the current time

        // Get slot details
        $slotDetails = $salonSession->getSlotDetails($slotID);
        if (!$slotDetails) {
            echo "<script>alert('Slot not found!');</script>";
            return;
        }

        $slotDate = $slotDetails->openday; // Date of the slot (Assumed column exists)
        $timeSlot = $slotDetails->time_slot; // "09:00 - 09:30" format

        // Extract the start time from "09:00 - 09:30"
        $timeParts = explode(' - ', $timeSlot);
        if (count($timeParts) < 2) 
        {
            echo "<script>alert('Invalid slot format!');</script>";
            return;
        }

        $slotStartTime = $timeParts[0]; // "09:00"

        // Check if the slot is for today
        if ($slotDate == $currentDate) {
            // Convert slot time to full datetime
            $slotDateTime = strtotime("$slotDate $slotStartTime"); // Example: "2024-11-10 09:00"
            $timeLimit = 2 * 60 * 60; // 2 hours in seconds

            // Check if it's too late to update
            if ($slotDateTime - strtotime($currentDateTime) <= $timeLimit) 
            {
                echo "<script>alert('You cannot update this slot! Less than 2 hours remain.');</script>";
                return;
            }
        }

        // If conditions are met, update slot status
        $salonSession->updateSlotStatus($slotID, $status);
        echo "<script>alert('Slot status updated successfully!');</script>";
    }

    //___________________________________________________________________________________________________________________________

    private function filterDates($start, $end, $holidays)
    {
        $filteredDates = [];
        $currentDate = strtotime($start);
        $endDate = strtotime($end);

        while ($currentDate <= $endDate) {
            $dateString = date('Y-m-d', $currentDate);
            if (!in_array($dateString, $holidays)) {
                $filteredDates[] = $dateString;
            }
            $currentDate = strtotime("+1 day", $currentDate);
        }
        return $filteredDates;
    }


    //_________________________________________________________________________________________________________________________

    private function generateTimeSlots($dates, $salonID) 
    {
        $salon = new Salons();
        $salondata = $salon->FindUser($salonID);
        $salon_open_time = $salondata->open_time;
        $salon_close_time = $salondata->close_time;
        $slot_duration = $salondata->slot_duration;
        $timeSlots_per_day = [];

        foreach ($dates as $date) {
            $start_time = strtotime($salon_open_time);
            $end_time = strtotime($salon_close_time);
            $slots = [];

            while ($start_time < $end_time) {
                $slot_start = date("H:i", $start_time);
                $slot_end = date("H:i", strtotime("+$slot_duration minutes", $start_time));
                if (strtotime($slot_end) <= $end_time) {
                    $slots[] = "$slot_start - $slot_end";
                }
                $start_time = strtotime("+$slot_duration minutes", $start_time);
            }
            $timeSlots_per_day[$date] = $slots;
        }
        return $timeSlots_per_day;
    }

    //_________________________________________________________________________________________________________________________

    private function saveTimeSlots($timeSlots, $salonID) 
    {
        $salonSession = new SalonTimeSlots();

        foreach ($timeSlots as $date => $slots) {
            $existingSlots = $salonSession->findSlotsbyDate($date);
            if (!empty($existingSlots)) {
                echo "<script>alert('Error: Time slots for $date already exist!');</script>";
                return;
            }

            foreach ($slots as $slot) {
                $salonSession->addSession([
                    'openday' => $date,
                    'time_slot' => $slot,
                    'status' => 'available',
                    'salonID' => $salonID
                ]);
            }
        }
        echo "<script>alert('Salon time slots successfully added!');</script>";
    }


    //________________________________________________________________________________________________________________________
    //function create to get the salon start time, close time, duration
    private function getSalonDetails($salonID)
    {
        $salon = new Salons();

        //put the salon data so create the array
        $salondetails = [];

        //find the first details in the user match for the salon id cannot be duplicate
        $salondetails = $salon->FindUser($salonID);

        //check can find the data 
        if(isset($salondetails))
        {
            return $salondetails;
        }
        else
        {
            echo "the salon details cannot find";
        }
    }
}
?>
