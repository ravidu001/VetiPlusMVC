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

        foreach ($data['bookeddata'] as $bookeddata) {
            $salId = $bookeddata->salSessionID;
            $petId = $bookeddata->petID;
            $petOwnerId = $bookeddata->petOwnerID;

            $session = $session_table->getSlotDetails($salId);
            $petdetails = $pet_table->findPetDetailsByID($petId);
            $petownerdetails = $petowner_table->getPetOnwerDetailsByID($petOwnerId);

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
                'contactNumber' => $petownerdetails->contactNumber ?? 'N/A'
            ];
        }

        $data['appointments'] = $appointments;
        $this->view('Salon/salonnewappointment', $data);
    }
}
