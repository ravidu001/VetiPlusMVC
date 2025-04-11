<?php

class SalonAppointments extends Controller{

    public function index() 
    {
        $this->view('Salon/salonappointments');
    }

   public function updateGroomingStatus()
   {
        if($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            
            $data = json_decode(file_get_contents("php://input"), true);

            $groomingid = $data['id'] ?? null;
            $status = $data['status'] ?? null;

            if($groomingid !== null && $status !== null)
            {
                $grooming = new SalonBooked();
              
                $result = $grooming->updateStatus($groomingid, ['status' => $status]);

                echo $result;

                if($result)
                {
                    echo json_encode(['success' => false]);
                }
                else
                {
                    echo json_encode(['success' =>true, 'message' => 'Update failed']);
                }
            }
            else
            {
                echo json_encode(['success' => true, 'message' => 'Invalid input']);
            }
        }
   }
}

?>