<?php

class SalonCalendar extends Controller {

    public function index() {
        $data = [];

        $salsession = new SalonTimeSlots();

        $date = '2025-02-28';

        $result = $salsession->findSlotsbyDate($date);

        show($result);

        $data['slots'] = $result;
        $this->view('Salon/test', $data);
    }

    public function getSlots() 
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST') 
        {
            $data = json_decode(file_get_contents('php://input'), true);

            $date = $data['date'] ?? null;
            $salonID = $data['salonID'] ?? null;


            if ($date && $salonID) 
            {
                $salsession = new SalonTimeSlots();
                $groomingsession = new SalonBooked();
                $petowner = new PetOwners();
                $SalonWeekDaysSchedule = new SalonWeekdaySchedules();
                $TimeSlotConfig = new SalonTImeSLotConfig();

                $status = 'booked';
                $results = $salsession->findSlotsbyDateAndStatus($date, $status);

                $upcoming = [];
                $incomplete = [];
                $complete = [];

                if(!empty($results))
                {   
                    foreach($results as $booking)
                    {
                        $salsessionID = $booking->salSessionID;

                        $sheduleID = $booking->schedule_id;

                        $salonWeekDaysDetails = $SalonWeekDaysSchedule->FindSlotByScheduleID($sheduleID);

                        $configID = $salonWeekDaysDetails->config_id;

                        $configDetails = $TimeSlotConfig->FindByConfigID($configID);

                        $salon = $configDetails->salonID;


                        if($salonID == $salon)
                        {
                            $bookingdetails = $groomingsession->getSlotDetails($salsessionID);

                            if ($bookingdetails) 
                            {
                                $ownerID = $bookingdetails->petOwnerID;
                                $owner = $petowner->getPetOnwerDetailsByID($ownerID);

                                $dateAndTime = $bookingdetails->dateTime;

                                $statusVal = $bookingdetails->status;
                                $slotDate = $booking->openday;
                                $slotTime = $booking->time_slot;

                                list($startTime, $endTime) = explode('-', $slotTime);
                                $slotDateTimeStr = $slotDate. ' ' . trim($endTime);// "2025-04-07 10:00"

                                //Convert to DateTime Object
                                $slotDateTime = new DateTime($slotDateTimeStr);
                                $today = new DateTime();

                                // $dateTimeBoth = date('Y-m-d H:i:s', strtotime($dateAndTime));
                                
                                $sendDate = date('Y-m-d', strtotime($dateAndTime)); 
                                $sendTime = date('H:i', strtotime($dateAndTime));    
                               
                                $appointment = [
                                    'petOwner' => $owner->fullName ?? 'Unknown',
                                    'contactNumber' => $owner->contactNumber ?? 'N/A',
                                    'bookedDate' => $sendDate,
                                    'bookedTime' => $sendTime,
                                    'slotDate' => $booking->openday,
                                    'timeSlot' => $booking->time_slot,
                                    'service' => $bookingdetails->service,
                                    'groomingID' => $bookingdetails->groomingID
                                ];

                                if($statusVal  == 1)
                                {
                                    $incomplete[] = $appointment;
                                }
                                else if($statusVal  == 2)
                                {
                                    $complete[] = $appointment;
                                }
                                else if($statusVal  == 0)
                                {
                                    $upcoming[] = $appointment;
                                }
                            }
                        }

                        else
                        {
                            continue;
                        }
                        
                    }
                }

                header('Content-Type: application/json');
                echo json_encode([
                    'success' => true, 
                    'upcoming' => $upcoming,
                    'complete' => $complete,
                    'incomplete' => $incomplete,
                    'resss' => $results
                ]);
                exit;
            } 
            else 
            {
                header('Content-Type: application/json');
                echo json_encode([
                    'success' => false, 
                    'message' => 'Date not provided'
                ]);
                exit;
            }
        }
        else
        {
            echo json_encode([
                'success' => false, 
                'message' => 'Invalid request method'
            ]);
            exit;
        }
    }

}

?>
