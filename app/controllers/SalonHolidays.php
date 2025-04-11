<?php

class SalonHolidays extends Controller 
{

    public function index() 
    {
        $data = [];
        $salonuser = $_SESSION['SALON_USER'];

        if (isset($_POST['saveholidays'])) 
        {
            $holiday = new SalonHoliday();
            $holidays = $_POST['holidays'] ?? [];
            $errors = [];

            foreach ($holidays as $date) 
            {
                // Check if the date is at least 3 days in the future
                if (strtotime($date) <= strtotime('+3 days', strtotime(date('Y-m-d')))) 
                {
                    $errors[] = "The date $date must be selected at least 3 days in advance.";
                    continue;
                }

                // Check if the date already exists
                $result = $holiday->findHolidayByDate($date);
                if (empty($result)) 
                {
                    $holiday->insertData([
                        'salonID' => $salonuser,
                        'date' => $date
                    ]);

                    redirect('SalonSlot');
                }
                else 
                {
                    $errors[] = "The date $date has already been selected as a holiday.";
                }
            }

            // Store errors if any
            if (!empty($errors)) 
            {
                $data['errors'] = $errors;
            }
            else 
            {
                $data['success'] = "Holidays successfully saved.";
            }
        }

        $this->view('Salon/salonholidays', $data);
    }
}
?>
