<?php

class SalonNewAppointment extends Controller
{
    public function index()
    {
        $data = [];
        $grooming_table = new SalonBooked();
        $session_table = new SalonTimeSlots();
        $pet_table = new Pet();
        $petowner_table = new PetOwners();

        $data['bookeddata'] = $grooming_table->FindBookedDetails();
        
        $appointments = [];

        $upcomingappointments = [];

        $selectedSessions =  $session_table->findSlotsbyDate('2025-02-27');

        // show($selectedSessions);

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


                    }
                }
            }
        }
        
        // foreach ($selectedSessions as $selectedSession)
        // {
            
        //     $sessionID = $selectedSession->salSessionID;
           
        //     $bookedsessions = $grooming_table->getSlotDetailsByID($sessionID);
        //     show($bookedsessions);

            
        // }

        

        foreach ($data['bookeddata'] as $bookeddata) {
            $salId = $bookeddata->salSessionID;
            $petId = $bookeddata->petID;
            $petOwnerId = $bookeddata->petOwnerID;
            $bookedSessionID = $bookeddata->groomingID;

            $session = $session_table->getSlotDetails($salId);
            $petdetails = $pet_table->getOnePet($petId);
            $petownerdetails = $petowner_table->getPetOnwerDetailsByID($petOwnerId);

           

            



            // show($selectedSession);


            // Ensure variables contain objects before accessing properties
            if (!is_object($session) || !is_object($petownerdetails)) {
                continue; // Skip this iteration if any data is missing
            }

            // Store relevant details in an array for the view
            $appointments[] = [
                'bookedDate' => $bookeddata->dateTime,
                'slotDate' => $session->openday ?? 'N/A',  // Use 'N/A' if slot date is missing
                'timeSlot' => $session->time_slot ?? 'N/A',
                'fullName' => $petownerdetails->fullName ?? 'Unknown',
                'service' => $bookeddata->service,
                'contactNumber' => $petownerdetails->contactNumber ?? 'N/A',
                'groomingID' => $bookedSessionID 
            ];
        }

        $data['appointments'] = $appointments;
        $this->view('Salon/salonnewappointment', $data);
    }

    //_______________________________________________________________________________________________________________________________________
    public function updateStatus() 
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') 
        {
            // Get form data
            $groomingID = $_POST['groomingID'];
            $action = $_POST['action'];

            // Determine status based on action
            $status = ($action === 'complete') ? 1 : 2;

            // Update status in the grooming table
            $grooming_table = new SalonBooked();
            if ($grooming_table->updateStatus($groomingID, $status)) {
                // Redirect with success message
                header('Location: ' . ROOT . '/SalonTimeSlot?status=success');
                exit;
            } else {
                // Redirect with error message
                header('Location: ' . ROOT . '/SalonTimeSlot?status=error');
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
        
                // Sanitize input to prevent security issues
                $selectedDate = htmlspecialchars(trim($_POST['selectedDate']));


                $selectedSessions =  $session_table->findSlotsbyDate($selectedDate);

                foreach ($selectedSessions as $selectedSession)
                {

                }



                // show($sessionDetails);

                // Example: Insert or process data_________________________________________________________________________-
                // You can add your database insertion or logic here
                // For example:
                // $this->insertDateIntoDB($selectedDate);

                // Send a success response as JSON___________________________________________________________________________
                echo json_encode(['success' => true, 'message' => 'Date selected: ' . $selectedSession]);
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
