<?php

class SalonSlot extends Controller
{
    public function index()
    {
        $data = [];

        $holidays = new SalonHoliday();

        //__________________________________________________________________________________________________________________
            //fetch and get the data from the databse to show the view file
            $resultsforholidays = $holidays->FindHolidays();

            show($resultsforholidays);
            $futureHolidays = [];  // Array to store future holidays
            
            $today = strtotime(date('Y-m-d'));  // Get today's date as a timestamp

            if(isset($resultsforholidays) && $resultsforholidays != false)
            {
                show('ddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd');
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
            
        $this->view('salon/salonslot', $data);
    }
}