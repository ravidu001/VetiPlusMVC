<?php

class SalonNewAppointment extends Controller
{
    public function index()
    {
        
        $this->view('Salon/salonnewappointment');
    }

    //_______________________________________________________________________________________________________________________________________
    
    public function updateStatus() 
    {
        $grooming_table = new SalonBooked();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') 
        {
            // Get form data
            $groomingID = $_POST['groomingID'];
            $arr = [];

            show($groomingID);
            $details = $grooming_table->getDEtailsByGroomingID($groomingID);

            show($details);
            show($details->status);

            $arr['groomingID'] = $details->groomingID;
            $arr['service'] = $details -> service;
            $arr['dateTime'] =  $details -> dateTime;
            $arr['petID'] =  $details -> petID;
            $arr['petOwnerID'] =  $details -> petOwnerID;
            $arr['salSessionID'] =  $details -> salSessionID;


            if (!empty($groomingID)) 
            {
                // Determine status based on action
                if (isset($_POST['complete'])) 
                {
                    // $data = ['status' => 1, 'groomingID' => $groomingID];
                    $arr['status'] = 1; // Completed
                } 
                else if (isset($_POST['cancel'])) 
                {
                    // $data = ['status' => 2, 'groomingID' => $groomingID];
                    $arr['status'] = 2; // Cancelled
                } 
                else 
                {
                    // $data = ['status' => 0, 'groomingID' => $groomingID];
                    $arr['status'] = 0; // Default (No Change)
                }

                show($arr);
                // Update status in the database
                $result = $grooming_table->updateStatus($groomingID, $arr);

                show($result);
                if (!$result) 
                {
                    
                    header('Location: ' . ROOT . '/SalonNewAppointment?=success');
                } 
                else 
                {
                    // alert('cannot update');
                    show('error');
                    header('Location: ' . ROOT . '/SalonNewAppointment>=error');

                }
            } 
            else 
            {
                // If groomingID is empty
                header('Location: ' . ROOT . '/SalonNewAppointment');
                exit;
            }

        }
        
    }    
        
   
    public function findDataTab1() 
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') 
        {
            // Check if 'selectedDate' is received from the frontend
            if (isset($_POST['selectedDate'])) 
            {
                $grooming_table = new SalonBooked();
                $session_table = new SalonTimeSlots();
                $pet_table = new Pet();
                $petowner_table = new PetOwners();
                // $data = [];
                $upcomingappointments = [];

        
                // Sanitize input to prevent security issues
                $selectedDate = htmlspecialchars(trim($_POST['selectedDate']));


                $selectedSessions =  $session_table->findSlotsbyDate($selectedDate);

                if(isset($selectedSessions) && $selectedSessions != NULL)
                {
                    foreach($selectedSessions as $selectedSession)
                    {
                        // show($selectedSession);

                        $salID = $selectedSession->salSessionID;

                        $bookeddatas = $grooming_table->getSlotDetailsByID($salID);
                        // show($bookeddatas);
                        

                        if(isset($bookeddatas) && $bookeddatas != NULL)
                        {
                            foreach($bookeddatas as $bookeddata)
                            {
                                // show($bookeddata);

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
