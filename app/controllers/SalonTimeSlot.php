<?php

class SalonTimeSlot extends Controller 
{
    
    public function index() 
    {
        //get the salon ID from the salon table 
        $salonID = $_SESSION['SALON_USER'];

        if(empty($salonID))
        {
            redirect('Login/login');
        }

        $this->view('Salon/salontimeslot');
    }

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

    //get the dates to show the calendar
    public function getDates()
    {
        $data = [];

        $data = json_decode(file_get_contents('php://input'), true);

        $salonuser = $data['salonID'] ?? null;

        //closedates,past dates,open days,holidays
        $timeTable = new SalonTImeSLotConfig();
        $WeekDaysTable = new SalonWeekdaySchedules();
        $holidaysTable = new SalonHoliday();
        $holidayresults = $holidaysTable->findHolidayByID($salonuser);

        if($holidayresults)
        {
            foreach($holidayresults as $holidayresult)
            {
                $data['holidays'][] = $holidayresult->holiday_id;
            }
        }
        else
        {
            $data['holidayempty'] = "Not added the holidays yet";
        }

        //get the configID(get oepn and close days) and other details by the salon ID 
        $timeDetails = $timeTable->findBySalonID($salonuser);

        if($timeDetails)
        {
            foreach($timeDetails as $timeDetail)
            {
                //check the weekdays table when open and close days using status
                //close = 1, open = 0
                $configID = $timeDetail->config_id;//get the foreign key in other table
                //get the status == 0
                $openStatus = 0;
                $closedStatus = 1;
                $weekdaysDetails = $WeekDaysTable->findByConfigIDStatus($configID,$openStatus);
                $closeDetails = $WeekDaysTable->findByConfigIDStatus($configID,$closedStatus);

                //check the open days has 
                if($weekdaysDetails)
                {
                    foreach($weekdaysDetails as $weekdaysDetail)
                    {
                        $data['opendays'][] = $weekdaysDetail->date;
                    }
                }
                else
                {
                    $data['opendayempty'] = "Not yet the opendays";
                }

                 //check the open days has 
                if($closeDetails)
                {
                    foreach($closeDetails as $closeDetail)
                    {
                        $data['closedays'][] = $closeDetail->date;
                    }
                }
                else
                {
                    $data['closedayempty'] = "Not yet the opendays";
                }
            }
        }
        else
        {
            //not create the time slot yet
            $data['opendays'] = "Not yet create the slots";
            $data['closedays'] = "Not yet create the slots";
        }

        if(!$data)
        {
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true, 
                'results' => $data
            ]);
            exit;
        }
    }
}    



