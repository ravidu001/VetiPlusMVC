<?php

class SalonSlot extends Controller
{
    public function index()
    {
        $data = [];

        $holidays = new SalonHoliday();
        $salontimeslotconfig = new SalonTImeSLotConfig();
        $SalonweekdaySchedules = new SalonWeekdaySchedules();

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

        //_________________________________________________________________________________________________________________________
        //get the latest update details in the table

        $result =  $salontimeslotconfig -> getLastInsertedID($salonID);
        $latestUpdateID = $result[0] -> config_id;
        // show($latestUpdateID);

            if($latestUpdateID != null)
            {

                $TimseSlotConfigDatas = $salontimeslotconfig->findById($latestUpdateID, $salonID);

                // show($TimseSlotConfigDatas);

                if(empty($TimseSlotConfigDatas))
                {
                    $data['message'] = "No data create for slots yet";
                }
                else
                {
                   $data ['ConfigDetails'] =  $TimseSlotConfigDatas;
                   $WeekDaysDetails = $SalonweekdaySchedules->FindByConfigId($latestUpdateID);

                   if(empty($WeekDaysDetails))
                   {
                    $data['message'] = "Cannot be happen but cannot find the Weekdays details for this config file";
                   }
                   else
                   {
                        $data['WeekdayDetails'] = $WeekDaysDetails;
                   }
                }
            }
            else
            {
                $data['message'] = "Not yet Upload the details";
            }
            
        $this->view('salon/salonslot', $data);
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
                redirect('SalonSlot');
            }
        }
    
}