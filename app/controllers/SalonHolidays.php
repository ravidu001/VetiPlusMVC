<?php

class SalonHolidays extends Controller 
{
    public function index() 
    {
        $data = [];
        $salonuser = $_SESSION['SALON_USER'];

        if(empty($salonuser))
        {
            redirect('Login/login');
        }

        if (isset($_POST['saveholidays'])) 
        {
            $holiday = new SalonHoliday();
            $TimeslotTable = new SalonTImeSLotConfig();
            $SalonWeekdays = new SalonWeekdaySchedules();
            $salonSessions = new SalonTimeSlots();
            $notifications = new Notification();

            $holidays = $_POST['holidays'] ?? [];
            $errors = [];
            $status = 'booked';

            //check if the select holiday has bookings
            foreach ($holidays as $holiDate) 
            {
                $result = $salonSessions->FindBooking($salonuser, $holiDate, $status);

                if(!empty($result))
                {
                    $errors[] = "The date $holiDate cannot be marked as a holiday because it has bookings.";
                    // $notifications->show("The date $holiDate cannot be marked as a holiday because it has bookings.",'error');
                }
            }

            // 2. Get valid open days for salon
            $results = $TimeslotTable->findBySalonID($salonuser);

            $alldays = [];

            
            foreach($results as $result)
            {
               $configID = $result->config_id;

               $weekdays = $SalonWeekdays->FindByConfigId($configID);

               foreach($weekdays as $weekday)
               {
                    $alldays[] = $weekday-> date;
               }
            }

            // 3. Check for invalid days
            foreach($holidays as $holidayDate)
            {
                if(!in_array($holidayDate, $alldays))
                {
                    $errors[] = "Date $holidayDate is not a valid working day.";
                    // $notifications->show("Date $holidayDate is not a valid working day",'error');
                }
            }

            // 4. Check advance days and duplications
            $validDates = [];

            foreach ($holidays as $date) 
            {
                // Check if the date is at least 3 days in the future
                if (strtotime($date) <= strtotime('+3 days', strtotime(date('Y-m-d')))) 
                {
                    $errors[] = "The date $date must be selected at least 3 days in advance.";
                    // $notifications->show("The date $date must be selected at least 3 days in advance.",'error');
                    continue;
                }

                // Check if the date already exists
                $result = $holiday->findHolidayByDate($date);
                if (!empty($result)) 
                {
                    $errors[] = "The date $date has already been selected as a holiday.";
                    // $notifications->show("The date $date has already been selected as a holiday.",'error');
                    continue;
                }

                $validDates[] = $date;
            }

            // 5. Insert if no errors
            if (empty($errors)) 
            {
                foreach ($validDates as $date) 
                {
                    $holiday->insertData([
                        'salonID' => $salonuser,
                        'date' => $date
                    ]);

                    $status = 'blocked';

                    $salonSessions->updateStatus($salonuser, $date, $status);
                }

                $notifications->show("Create holidays successfully!",'success');
                // Redirect after successful insert
                redirect('SalonHolidayView');
                exit();
            } 
            else 
            {
                foreach($errors as $error)
                {
                    $notifications->show($error,'error');
                }
                redirect('SalonHolidayView');
                exit();
            }
        }

        $this->view('Salon/salonholidaysadd', $data);
    }
}
?>
