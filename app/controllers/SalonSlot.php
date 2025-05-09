<?php

class SalonSlot extends Controller
{
    public function index()
    {
        $data = [];

        // $holidays = new SalonHoliday();
        $salontimeslotconfig = new SalonTImeSLotConfig();
        $SalonweekdaySchedules = new SalonWeekdaySchedules();
        $notifications = new Notification();

        $salonID = $_SESSION['SALON_USER'];

        if(empty($salonID))
        {
            redirect('Login/login');
        }

        //__________________________________________________________________________________________________________________
            //fetch and get the holiday details data from the databse to show the view file
            // $resultsforholidays = $holidays->FindHolidays();

            // $futureHolidays = [];  // Array to store future holidays
            
            // $today = strtotime(date('Y-m-d'));  // Get today's date as a timestamp

            // if(isset($resultsforholidays) && $resultsforholidays != false)
            // {
            //     foreach ($resultsforholidays as $resultsforholiday) 
            //     {
            //         $oneholiday = $resultsforholiday->date;
                
            //         // Check if the holiday date is today or in the future
            //         if (strtotime($oneholiday) >= $today) 
            //         {
            //             $futureHolidays[] = $oneholiday;  // Store the future holiday
            //         }
            //     }
            //     $data['holidays'] = $futureHolidays;
            // }

        //_________________________________________________________________________________________________________________________
        //get the latest update details in the table

        $result =  $salontimeslotconfig -> getLastInsertedID($salonID);
        
        if($result)
        {
            $latestUpdateID = $result[0] -> config_id;
            // show($latestUpdateID);

            if($latestUpdateID != null)
            {

                $TimseSlotConfigDatas = $salontimeslotconfig->findById($latestUpdateID, $salonID);

                // show($TimseSlotConfigDatas);

                if(empty($TimseSlotConfigDatas))
                {
                    // $data['message'] = "No data create for slots yet";
                    $notifications->show("No data create for slots yet!.",'error');
                }
                else
                {
                   $data ['ConfigDetails'] =  $TimseSlotConfigDatas;
                   $WeekDaysDetails = $SalonweekdaySchedules->FindByConfigId($latestUpdateID);

                //    show($WeekDaysDetails);

                   if(empty($WeekDaysDetails))
                   {
                    // $data['message'] = "Cannot be happen but cannot find the Weekdays details for this config file";
                    $notifications->show("Cannot be happen but cannot find the Weekdays details for this config file!.",'error');

                   }
                   else
                   {
                        $data['WeekdayDetails'] = $WeekDaysDetails;
                   }
                }
            }
            else
            {
                // $data['message'] = "Not yet Upload the details"
                $notifications->show("Not yet Upload the details",'error');

            }
        }
    
        $this->view('salon/salonslot', $data);
    }

}