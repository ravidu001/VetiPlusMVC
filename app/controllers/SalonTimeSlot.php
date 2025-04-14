<?php

class SalonTimeSlot extends Controller 
{
    
    public function index() 
    {
        //all table I want this 
        $timeslotconfig = new SalonTImeSLotConfig();
        $salonweekdays = new SalonWeekdaySchedules();
        $holidays = new SalonHoliday();
        $salsession = new SalonTimeSlots();

        $data = [];

        //get the salon ID from the salon table 
        $salonID = $_SESSION['SALON_USER'];

        if(empty($salonID))
        {
            redirect('Login/login');
        }

        // show( $salonID);

        //find the latest update colunm in the timeslotconfig table
        $result = $timeslotconfig ->getLastInsertedID($salonID);

        if($result)
        {
            // show($result);
      
            $configID = $result[0]->config_id;  //put the config ID
            $duration = $result[0] -> slot_duration_minutes; //put the time slot duration time(min)

            // show($configID );
            show($duration);

            //find the data from the salonweekdays table passing the config ID
            $weekdaysDetails =  $salonweekdays->FindByConfigId($configID);

            // show($weekdaysDetails);

            //catch the is_closed if it == 1 do not create the slots for them
            foreach($weekdaysDetails as $day)
            {
                $closeStatus = $day->is_closed;

                // show($closeStatus);
                // opendays only
                if($closeStatus == 0)
                {
                    $date = $day->date;
                    $startTime = strtotime($day->start_time);
                    $endTime = strtotime($day->end_time);
                    $slotDuration = $duration * 60; // Convert minutes to seconds
                    $sheduleID = $day->schedule_id;

                    //want to check the date in the holiday table
                    $checkholiday = $holidays->findHolidayByDate($date);

                    $slotStatus = empty($checkholiday) ? 'available' : 'block';//if has the holiday then status == block

                    // Generate time slots
                    
                        for ($time = $startTime; $time < $endTime; $time += $slotDuration) 
                        {
                            $timeSlot = date('H:i:s', $time) . " - " . date('H:i:s', min($time + $slotDuration, $endTime));
                            $data = [
                                'openday' => $date,
                                'status' => $slotStatus,
                                'time_slot' => $timeSlot, // Store as "HH:MM:SS - HH:MM:SS"
                                'salonID' => $salonID,
                                'schedule_id' => $sheduleID
                            ];
                            $salsession->addSession($data);
                        }

                }
                else if($closeStatus == 1)
                {
                    continue;
                }
                else
                {
                    $data['error'] = "Config Status cannot find";
                }

            }
            
        }
        
        $this->view('Salon/salontimeslot');
    }


    // public function RetriveTimeSlotsDataByDate()
    // {

    //     // if($_SESSION['REQUEST_METHOD'] === 'POST')
    //     // {
    //     //     // $postData = json_decode(file_get_contents('php://input'), true);
    //     //     if(isset($_POST['selectedDate']))
    //     //     {
    //     //         $date = isset($_POST['selectedDate']);
    //     //     }
    //     //     else
    //     //     {
    //     //         $date = date('y-m-d');
    //     //     }

    //     //     // Check if 'selectData' is received from the frontend
    //     //     if(isset($date))
    //     //     {
    //     //         $session_table = new SalonTimeSlots();

    //     //         $sessiondata = [];

    //     //             $salsessions = $session_table->findSlotsbyDate($date);

    //     //             if(isset($salsessions) && $salsessions != NULL)
    //     //             {
    //     //                 foreach($salsessions as $salsession)
    //     //                 {
    //     //                     $sessiondata[] = [
    //     //                         'status' => $salsession->status,
    //     //                         'time-slot' => $salsession->time_slot
    //     //                     ];
    //     //                 }
    //     //             }

    //     //             if($sessiondata != NULL)
    //     //             {
    //     //                 echo json_encode(['success' => true, 'message' => 'Date selected: ', 'sessiondata' => $sessiondata]);
    //     //             }
    //     //             else
    //     //             {
    //     //                 echo json_encode(['success' => false, 'message' => 'Data not found']);
    //     //             }               
    //     //     }
    //     //     else
    //     //     {
    //     //         echo json_encode(['success' => false, 'message' => 'Date not find']);
    //     //     }
    //     // }
    // }


    public function RetriveTimeSlotsDataByDate()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST') 
        {
            $data = json_decode(file_get_contents('php://input'), true);

            $date = $data['date'] ?? null;
            $salonID = $data['salonID'] ?? null;

            if($date && $salonID)
            {
                $salsession = new SalonTimeSlots();//slot details 

                $results = $salsession -> slotsByDateAndSalon($salonID, $date);

                if(!empty($results))
                {
                    header('Content-Type: application/json');
                    echo json_encode([
                        'success' => true,
                        'result' => $results
                    ]);
                    exit;
                }
                else
                {
                    header('Content-Type: application/json');
                    echo json_encode([
                        'success' => true,
                        'result' => [],
                        'message' => 'No slots created for this day.'
                    ]);
                    exit;
                }
            }
            else
            {
                header('Content-Type: application/json');
                echo json_encode([
                    'success' => false, 
                    'message' => 'Date  not provided OR user Cannot find'
                ]);
                exit;
            }
        }
    }
}    



