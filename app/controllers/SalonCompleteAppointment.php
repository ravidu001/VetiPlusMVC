<?php

class SalonCompleteAppointment extends Controller{

    public function index(){
        $this->view('Salon/saloncompleteappointment');
    }

    public function findDataTab2() 
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

                        $bookeddatas = $grooming_table->getCompleteDetailsByID($salID);
                       
                        if(isset($bookeddatas) && $bookeddatas != NULL)
                        {
                            foreach($bookeddatas as $bookeddata)
                            {
                                $petownerID = $bookeddata -> petOwnerID;
                                // $petID = $bookeddata -> petOwnerID;
                                $sessionID = $bookeddata -> salSessionID;
                                $bookedSessionID = $bookeddata->groomingID;

                                // show($petownerID);

                                $petownerdetails = $petowner_table->getPetOnwerDetailsByID($petownerID);
                                $sessiondetails = $session_table->getSlotDetails($sessionID);

                                // show($bookeddata);
                                // show($sessiondetails);
                                // show($petownerdetails);

                                $upcomingappointments[] = [
                                    'bookedDate' => $bookeddata->dateTime,
                                    'slotDate' => $sessiondetails->openday ?? 'N/A',  // Use 'N/A' if slot date is missing
                                    'timeSlot' => $sessiondetails->time_slot ?? 'N/A',
                                    'fullName' => $petownerdetails->fullName ?? 'Unknown',
                                    'service' => $bookeddata->service,
                                    'contactNumber' => $petownerdetails->contactNumber ?? 'N/A',
                                    'groomingID' => $bookedSessionID 
                                ];

                                // show( $upcomingappointments);
                                
                            }
                        }
                    }
                }
        
                // Send a success response as JSON___________________________________________________________________________
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
                // If 'selectedDate' is missing
                echo json_encode(['success' => false, 'message' => 'Date not received.']);
            }
        } 
        else 
        {
            // If the request method is not POST
            echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
        }
    }
}

?>