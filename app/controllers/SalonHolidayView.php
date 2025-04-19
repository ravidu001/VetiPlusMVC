<?php

class SalonHolidayView extends Controller
{
    public function index()
    {
        $data = [];

        $holidays = new SalonHoliday();
      
        $salonID = $_SESSION['SALON_USER'];

        if(empty($salonID))
        {
            redirect('Login/login');
        }

        //__________________________________________________________________________________________________________________
        //fetch and get the holiday details data from the databse to show the view file
        $resultsforholidays = $holidays->FindHolidays();

        $futureHolidays = [];  // Array to store future holidays
        
        $today = strtotime(date('Y-m-d'));  // Get today's date as a timestamp

        if(isset($resultsforholidays) && $resultsforholidays != false)
        {
            foreach ($resultsforholidays as $resultsforholiday) 
            {
                $oneholiday = $resultsforholiday->date;
            
                // Check if the holiday date is today or in the future
                if (strtotime($oneholiday) >= $today) 
                {
                    $futureHolidays[] = $oneholiday;  // Store the future holiday
                }
            }
            $data['holidays'] = $futureHolidays;
        }

        
        $this->view('Salon/salonholidays', $data);
    }

     //__________________________________________________________________________________________________________________________
    //remove the holiday
    public function removeHoliday()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove'])) 
        {
            $holiday = $_POST['remove'];
            $salonID = $_SESSION['SALON_USER'];

            // Load model and remove the holiday
            $holidayModel = new SalonHoliday(); 
            $salonSession = new SalonTimeSlots();
            $result = $holidayModel->findDateAndID($salonID,$holiday);

            if($result && isset($result[0]))
            {
                $holidayID=$result[0]->holiday_id;
                $response = $holidayModel->deleteHoliday($holidayID);

                if($response)
                {
                    $status = 'available';
                    $salonSession->updateStatus($salonID, $holiday, $status);
                }
            }
            
            // Redirect back to the same page to refresh view
            redirect('SalonHolidayView');
        }
    }
}
