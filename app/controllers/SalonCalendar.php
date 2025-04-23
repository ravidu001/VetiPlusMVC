<?php

class SalonCalendar extends Controller {

    public function index() {
        $data = [];

        $salsession = new SalonTimeSlots();

        // Get date from request (if sent via POST)
        // $date = $_POST['date'] ?? date('Y-m-d'); // Default to today if not provided

        $date = '2025-02-28';

        $result = $salsession->findSlotsbyDate($date);

        // Log result for debugging (optional)
        show($result);

        // Pass data to view
        $data['slots'] = $result;
        $this->view('Salon/test', $data);
    }

    // API endpoint to handle AJAX requests- get the appointments details
    //______________________________________________________________________________________________________________________________
    public function getSlots() 
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST') 
        {
            $data = json_decode(file_get_contents('php://input'), true);

            $date = $data['date'] ?? null;
            $salonID = $data['salonID'] ?? null;


            if ($date && $salonID) 
            {
                $salsession = new SalonTimeSlots();//get the salon sessions
                $groomingsession = new SalonBooked();//get the appoinments booking details
                $petowner = new PetOwners();//get the pet owners details
                $SalonWeekDaysSchedule = new SalonWeekdaySchedules();//get the week days
                $TimeSlotConfig = new SalonTImeSLotConfig();//get the salonID,month or week, slot time duration

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

                        //pass the above shceduleID and get the configID 
                        $salonWeekDaysDetails = $SalonWeekDaysSchedule->FindSlotByScheduleID($sheduleID);

                        //get the config ID 
                        $configID = $salonWeekDaysDetails->config_id;

                        //GET THE CONFIG DETAILS for get salon ID
                        $configDetails = $TimeSlotConfig->FindByConfigID($configID);

                        //get the salon ID for appoinments searching
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

                                //Extract the start time (before dash)
                                list($startTime, $endTime) = explode('-', $slotTime);
                                $slotDateTimeStr = $slotDate. ' ' . trim($endTime);// "2025-04-07 10:00"

                                //Convert to DateTime Object
                                $slotDateTime = new DateTime($slotDateTimeStr);
                                $today = new DateTime();

                                // $dateTimeBoth = date('Y-m-d H:i:s', strtotime($dateAndTime));
                                
                                $sendDate = date('Y-m-d', strtotime($dateAndTime)); 
                                $sendTime = date('H:i', strtotime($dateAndTime));    
                                
                                //check the upcoming appointmetns and update 
                                // if($statusVal == 0 && $slotDateTime < $today)
                                // {
                                //     $result = $groomingsession->updateStatus($bookingdetails->groomingID, 1);
                                //     $statusVal = 1;

                                //     if($result)
                                //     {
                                //         echo json_encode(['success' => true]);
                                //     }
                                //     else
                                //     {
                                //         echo json_encode(['success' =>false, 'message' => 'Update failed']);
                                //     }
                                // }

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

                // Send actual final response
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
