<?php

class SalonSlotCreate extends Controller
{
    public function index()
    {
        $salonuser = $_SESSION['SALON_USER'];

        $holidays = new SalonHoliday();
        $timeslotconfig = new SalonTImeSLotConfig();
        $SalonweekdaySchedules = new SalonWeekdaySchedules();

        show($salonuser);
        
        if(empty($salonuser))
        {
            redirect('Login/login');
        }

        //_________________________________________________________________________
        //bget the back end data
        if(isset($_POST['postdata']))
        {
            
            $data = [];

            $duration = $_POST['duration'];
            $noappointments = $_POST['appointments'];
            
            $slotfor = $_POST['period'];

            $result = $this->ValidateTimeSlotConfigData($duration, $noappointments, $slotfor);

            if(empty($result['errors']))
            {

                $data['salonID'] = $salonuser;
                $data['slot_duration_minutes'] = $result['duration']; 
                $data['appointments_per_slot'] = $result['noappointments'];
                $data['slot_creation_frequency'] =  $result['slotfor'];
                $data['modify_date'] =  Date('Y-m-d H:i:s');

                 $isinsert=$timeslotconfig->insertData($data);

                if($isinsert['success'])
                {

                    $result = $timeslotconfig->getLastInsertedID($salonuser);
                    if (!empty($result)) {
                        $configID = $result[0]->config_id;
                    }
                    else 
                    {
                        echo "Error: No config ID found.";
                    }
                    
                    if($configID)
                    {
                        // $this->insertHolidays($configID);
                        $this->insertWeekdays($configID, $salonuser);
                    }
                    else
                    {
                        echo "Failed too get the config ID";
                        $data['error'] = "Failed to get the configID" ;
                    }

                    
                }
                else
                {
                    echo $isinsert['message'];
                }

            }   
           
        }

        $this->view('salon/salonslotcreate');
    }



        //_____________________________________________________________________________________________________________________
        //validation function for timeslot config data table
        private function ValidateTimeSlotConfigData($duration, $noappointments, $slotfor)
        {
            $arr = [];
                            
            if (!is_numeric($duration) || $duration <= 0) 
            {
                $arr['errors'] = "Duration must be a positive number.";
            }

            
            if (!is_numeric($noappointments) || $noappointments <= 0) 
            {
                $arr['errors'] = "Number of appointments must be a positive number.";
            }

            
            $validSlots = ['week','month'];
            if (!in_array($slotfor, $validSlots)) 
            {
                $arr['errors'] = "Invalid time period selected.";
            }

            if(empty($arr['errors']))
            {
                $arr['duration'] = $duration;
                $arr['noappointments'] = $noappointments;
                $arr['slotfor'] = $slotfor;

            }
            return $arr;
        }


        //________________________________________________________________________________________________________________________
        //insert the weekdays
        private function insertWeekdays($configID, $salonuser)
        {
            $salonweekdayschedules = new SalonWeekdaySchedules();
            $weekdays = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];

            //get slot frequency from timeslot table
            $timeslotconfig = new SalonTImeSLotConfig();
            $result = $timeslotconfig->getLastInsertedID($salonuser);
            // $config = $result[0]->config_id;
            show($result);
            $slotfor = $result[0] -> slot_creation_frequency;

            // set the date range based on slot frequency
            $startDate = new DateTime('tomorrow');
            $daysToAdd = ($slotfor == 'week') ? 7 : 30;

            //Generate an array of dates
            $dates = [];

            for ($i = 0; $i < $daysToAdd; $i++) {
                $currentDate = clone $startDate;//clone used to get the copy of the startDate
                $currentDate->modify("+$i day");//modify function used to changed and adjust the dates/time/months
                $dates[strtolower($currentDate->format('l'))] = $currentDate->format('Y-m-d'); // Store day name as key
            }

            foreach($weekdays as $day)
            {
                if((isset($_POST["start_$day"]) && isset($_POST["close_$day"])) || $_POST["closed_$day"])
                {
                    //Insert data into the salonweekdayschedules table 
                    
                        $data = [
                            'config_id' => $configID,
                            'day_of_week' => $day,
                            'date' => $dates[$day] ?? null, // Get the date from the array
                            'start_time' => $_POST["start_$day"] ?? null,
                            'end_time' => $_POST["close_$day"] ?? null,
                            'is_closed' => isset($_POST["closed_$day"]) ? 1 : 0
                        ];

                        $salonweekdayschedules->InsertData($data);

                }
                else 
                {
                    // Error message if neither start_time/end_time nor checkbox is provided
                    $error_message = "Please provide the start and end times or mark the day as closed for $day.";
                    echo $error_message; // You can replace this with your own error handling logic (e.g., add to an array, etc.)
                }
            }
        
            
        }


        //________________________________________________________________________________________________________________________
        // //insert holidays
        // private function insertHolidays($configID)
        // {
        //     $holiday = new SalonHolidays();
        //     $holidays = $_POST['holidays'] ?? [];

        //     foreach ($holidays as $date) {
        //         $holiday->insertData([
        //             'config_id' => $configID,
        //             'date' => $date
        //         ]);
        //     }
        // }
}