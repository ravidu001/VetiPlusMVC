<?php

class SalonSlotCreate extends Controller
{
    public function index()
    {
        $salonuser = $_SESSION['SALON_USER'];
        
        if(empty($salonuser))
        {
            redirect('Login/login');
        }

        //_________________________________________________________________________
        //bget the back end data
        if(isset($_POST['postdata']))
        {
            $timeslotconfig = new SalonTImeSLotConfig();
            $data = [];

            $duration = $_POST['duration'];
            $noappointments = $_POST['appointments'];
            
            $sunday = $_POST['sunday'];
            $start_sunday = $_POST['start_sunday'];
            $close_sunday = $_POST['close_sunday'];
            $closed_sunday = $_POST['closed_sunday'];

            $monday = $_POST['monday'];
            $start_monday = $_POST['start_monday'];
            $close_monday = $_POST['close_monday'];
            $closed_monday = $_POST['closed_monday'];

            $tuesday = $_POST['tuesday'];
            $start_tuesday = $_POST['start_tuesday'];
            $close_tuesday = $_POST['close_tuesday'];
            $closed_tuesday = $_POST['closed_tuesday'];

            $wednesday = $_POST['wednesday'];
            $start_wednesday = $_POST['start_wednesday'];
            $close_wednesday = $_POST['close_wednesday'];
            $closed_wednesday = $_POST['closed_wednesday'];

            $thursday = $_POST['thursday'];
            $start_thursday = $_POST['start_thursday'];
            $close_thursday = $_POST['close_thursday'];
            $closed_thursday = $_POST['closed_thursday'];

            $friday = $_POST['friday'];
            $start_friday = $_POST['start_friday'];
            $close_friday = $_POST['close_friday'];
            $closed_friday = $_POST['closed_friday'];

            $saturday = $_POST['saturday'];
            $start_saturday = $_POST['start_saturday'];
            $close_saturday = $_POST['close_saturday'];
            $closed_saturday = $_POST['closed_saturday'];

            $slotfor = $_POST['period'];

            $holidays = $_POST['holidays'];

            $uploadedDate = date("Y-m-d"); //get the uploaded date

            show($slotfor);

            $result = $this->ValidateTimeSlotConfigData($duration, $noappointments, $slotfor);

            if($result != $arr['errors'])
            {
                $data['salonID '] = $salonuser;
                $data['slot_duration_minutes'] = $arr['duration']; 
                $data[' appointments_per_slot '] = $arr['noappointments'];
                $data['slot_creation_frequency'] =  $arr['slotfor'];

                $timeslotconfig->insertData($data);

            }
            
            $this->view('salon/salonslotcreate');
        }

            // foreach ($holidays as $holiday) {
            //     echo $holiday ;
            // }


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
            


        

      
}