<?php

class SalonSlotCreate extends Controller
{
    public function index()
    {        
        $timeslotconfig = new SalonTImeSLotConfig();

        $data = [];
       
        $salonuser = $_SESSION['SALON_USER'];

        //check the 2salon user login or not
        if(empty($salonuser))
        {
            redirect('Login/login');
        }

        //_________________________________________________________________________
        //bget the back end data
        if(isset($_POST['postdata']))
        {
            $duration = $_POST['duration'];
            $noappointments = $_POST['appointments'];
            $slotfor = $_POST['period'];

            if(isset( $_POST['startDate']))
            {
                $startDate = $_POST['startDate'];
            }
            else
            {
                $startDate = Date('Y-m-d');
            }

            if (!$startDate && !$slotfor) 
            {
                echo('select the time or date');
                $data['error'] = "Start date and period must be selected.";
            }

            

            //_____________________________check the slots dates open time and close time will added before
            if (isset( $slotfor) && isset($startDate))
            {
                $validDates = [];

                if($slotfor == 'week')
                {
                    for ($i = 0; $i < 7; $i++) 
                    {
                        $validDates[] = date('Y-m-d', strtotime("$startDate +$i days"));
                    }
                }
                else if($slotfor == 'month')
                {
                    $start = new DateTime($startDate);
                    $end = new DateTime($start->format('Y-m-t')); // end of month
                   
                    while ($start <= $end) 
                    {
                        $validDates[] = $start->format('Y-m-d');
                        $start->modify('+1 day');
                    }
                }
                else
                {
                    $data['error'] = "cannot catch the slotfor type";
                }

                $validInput = false;

                foreach ($validDates as $date) 
                {
                    $dayName = strtolower(date('l', strtotime($date))); // e.g., 'wednesday'

                    // Skip if marked closed
                    if (isset($_POST['closed'][$dayName])) 
                    {
                        continue;
                    }

                    // Check for missing times
                    $startTime = $_POST['startTime'][$dayName] ?? null;
                    $closeTime = $_POST['closeTime'][$dayName] ?? null;

                    if ($startTime && $closeTime) {
                        $validInput = true; // At least one valid day configured
                    }
                    else 
                    {
                        $data['error'] = "Missing start/close time for $dayName";
                    }
                }

                if (!$validInput) 
                {
                    $data['error'] = "Please configure at least one day's time slot properly.";
                }

            }

            $result = $this->validateTimeSlotConfigData($duration, $noappointments, $slotfor, $startDate);

            if(empty($result['errors']))
            {

                $insertData = [];
                $insertData['salonID'] = $salonuser;
                $insertData['slot_duration_minutes'] = $result['duration']; 
                $insertData['appointments_per_slot'] = $result['noappointments'];
                $insertData['slot_creation_frequency'] = $result['slotfor'];
                $insertData['modify_date'] = Date('Y-m-d H:i:s');
                $insertData['startDate'] = $result['startDate'];

                if($slotfor == 'week')
                {
                    $insertData['endDate'] = date('Y-m-d', strtotime($result['startDate'] . ' +6 days'));
                }
                else if($slotfor == 'month')
                {
                    $insertData['endDate'] = date('Y-m-d', strtotime($result['startDate'] . ' +29 days'));
                }

                 $isinsert=$timeslotconfig->insertData($insertData);

                if($isinsert['success'])
                {

                    $result = $timeslotconfig->getLastInsertedID($salonuser);

                    show($result);

                    if (!empty($result)) 
                    {
                        $configID = $result[0]->config_id;
                    }
                    else 
                    {
                        $data['error'] = "Error: No config ID found.";
                    }
                    
                    if($configID)
                    {
                        // $this->insertHolidays($configID);
                        $results = $this->insertWeekdays($configID, $salonuser);

                        if (empty($results['error'])) {
                            //All good, redirect now
                            redirect('SalonSlot');
                            exit;
                        } 
                        else 
                        {
                            $data['error'][] = $results;
                        }
                    }
                    else
                    {
                        $data['error'] = "Failed to get the configID" ;
                    }

                    
                }
                else
                {
                    $data['error'] = $isinsert['message'];
                }
            }
            else
            {
                $data['error'] = $result;
            }   
           
        }

        $this->view('salon/salonslotcreate', $data);
    }



        //_____________________________________________________________________________________________________________________
        //validation function for timeslot config data table
        private function validateTimeSlotConfigData($duration, $noappointments, $slotfor, $startDate)
        {
            $arr = [];

            $today = Date('Y-m-d');

            $timeslotconfig = new SalonTImeSLotConfig();

            $startDates = [];

            $timeslotdetails = $timeslotconfig->finAllDetails();

            foreach($timeslotdetails as $timeslotdetail)
            {
                $startDates[] = $timeslotdetail->startDate;
            }

            if(in_array($startDate, $startDates))
            {
                $arr['errors'] = "The date select before as the start date and created slots";
            }

            if($startDate < $today)
            {
                $arr['errors'] = "The select Date should not be a past Date.";
            }
                            
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
                $arr['startDate'] = $startDate;

            }
            return $arr;
        }


        //________________________________________________________________________________________________________________________
        //insert the weekdays
        private function insertWeekdays($configID, $salonuser)
        {
            //get the results
            $array = [];

            $salonSessions = new SalonTimeSlots();

            $holidays = new SalonHoliday();

            $salonweekdayschedules = new SalonWeekdaySchedules();
            $weekdays = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];

            //get slot frequency from timeslot table
            $timeslotconfig = new SalonTImeSLotConfig();
            $result = $timeslotconfig->getLastInsertedID($salonuser);
            // $config = $result[0]->config_id;
            $today = Date('Y-m-d');

            // show($result);

            $slotfor = $result[0] -> slot_creation_frequency;
            $startingDate = $result[0] -> startDate;
            $configId = $result[0] -> config_id;
            $duration = $result[0] -> slot_duration_minutes;
            $maxAppointments = $result[0] -> appointments_per_slot;

            if($startingDate == $today)
            {
                $startDate = new DateTime('tomorrow');
            }
            else if ($startingDate > $today)
            {
                 $startDate = new  DateTime($startingDate);
            }

            // set the date range based on slot frequency
            // $startDate = new DateTime('tomorrow');
            $daysToAdd = ($slotfor == 'week') ? 7 : 30;

            //Generate an array of dates
            $dates = [];

            //Generate an array of slots create before
            $addeddates = [];

            for ($i = 0; $i < $daysToAdd; $i++) {
                $currentDate = clone $startDate;//clone used to get the copy of the startDate
                $currentDate->modify("+$i day");//modify function used to changed and adjust the dates/time/months
                // $dates[strtolower($currentDate->format('l'))] = $currentDate->format('Y-m-d'); // Store day name as key

                $date =  $currentDate->format('Y-m-d');
                $dayName = strtolower($currentDate->format('l'));

                $matchingdate =  $salonweekdayschedules->findByDayANdConfidID($configId, $date);

                if(empty($matchingdate))
                {
                    $dates[$dayName] = $date;
                }
                else
                {
                    $addeddates[$dayName] = $date;
                }
                
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

                        $insertweekdays = $salonweekdayschedules->InsertData($data);

                        if($insertweekdays == false && $data['is_closed'] == 0)
                        {
                            $insertedweekdays = $salonweekdayschedules->getLastInsertedWeekday($data['config_id']);

                            $sheduleId = $insertedweekdays[0] -> schedule_id; 
                            $openday = $insertedweekdays[0] -> date; 
                            $startTime = strtotime($insertedweekdays[0] -> start_time);
                            $endTime = strtotime($insertedweekdays[0] -> end_time);
                            $slotDuration = $duration * 60;

                            //want to check the date in the holiday table
                            $checkholiday = $holidays->findHolidayByDate($openday);

                            $slotStatus = empty($checkholiday) ? 'available' : 'block';//if has the holiday then status == block

                             // Generate time slots
                   
                            for ($time = $startTime; $time < $endTime; $time += $slotDuration) 
                            {
                                $timeSlot = date('H:i:s', $time) . " - " . date('H:i:s', min($time + $slotDuration, $endTime));
                                $data = [
                                    'openday' => $openday,
                                    'status' => $slotStatus,
                                    'time_slot' => $timeSlot, // Store as "HH:MM:SS - HH:MM:SS"
                                    'salonID' => $salonuser,
                                    'schedule_id' => $sheduleId,
                                    'noOfBookings' => 0,
                                    'noOfAvailable' => $maxAppointments
                                ];
                                $salonSessions->addSession($data);
                            }

                        }
                        else
                        {
                            if($data['is_closed'] == 1)
                            {
                                continue;
                            }

                            if($insertweekdays == true)
                            {
                                $array['error'] = "Data cannot be insert";
                            }
                        }
                }
                else 
                {
                    // Error message if neither start_time/end_time nor checkbox is provided
                    $array['error'] = "Please provide the start and end times or mark the day as closed for $day.";
                }
            }
        
            return $array;    
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