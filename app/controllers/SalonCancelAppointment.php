<?php

class SalonCancelAppointment extends Controller{

    public function index(){
        $this->view('Salon/saloncancelappointment');
    }

    public function findDataTab3() 
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') 
        {
            
            if (isset($_POST['selectedDate'])) 
            {
                $grooming_table = new SalonBooked();
                $session_table = new SalonTimeSlots();
                $pet_table = new Pet();
                $petowner_table = new PetOwners();
                $upcomingappointments = [];

                $selectedDate = htmlspecialchars(trim($_POST['selectedDate']));


                $selectedSessions =  $session_table->findSlotsbyDate($selectedDate);

                if(isset($selectedSessions) && $selectedSessions != NULL)
                {
                    foreach($selectedSessions as $selectedSession)
                    {
                        $salID = $selectedSession->salSessionID;

                        $bookeddatas = $grooming_table->getCancelDetailsByID($salID);
                 
                        if(isset($bookeddatas) && $bookeddatas != NULL)
                        {
                            foreach($bookeddatas as $bookeddata)
                            {
    
                                $petownerID = $bookeddata -> petOwnerID;
                                $sessionID = $bookeddata -> salSessionID;
                                $bookedSessionID = $bookeddata->groomingID;

                                $petownerdetails = $petowner_table->getPetOnwerDetailsByID($petownerID);
                                $sessiondetails = $session_table->getSlotDetails($sessionID);

                                $upcomingappointments[] = [
                                    'bookedDate' => $bookeddata->dateTime,
                                    'slotDate' => $sessiondetails->openday ?? 'N/A',  
                                    'timeSlot' => $sessiondetails->time_slot ?? 'N/A',
                                    'fullName' => $petownerdetails->fullName ?? 'Unknown',
                                    'service' => $bookeddata->service,
                                    'contactNumber' => $petownerdetails->contactNumber ?? 'N/A',
                                    'groomingID' => $bookedSessionID 
                                ];
    
                            }
                        }
                    }
                }
        
                if($upcomingappointments != NULL)
                {
                    echo json_encode(['success' => true, 'message' => 'Date selected: ', 'gotdata'=> $upcomingappointments]);
                }
                else
                {
                    echo json_encode(['success' => false, 'message' => 'Date selected: ', 'gotdata'=> $upcomingappointments]);
                }
            } 
            else 
            {
                
                echo json_encode(['success' => false, 'message' => 'Date not received.']);
            }
        } 
        else 
        {
            
            echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
        }
    }
}

?>