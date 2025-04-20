<?php

class Rejected extends Controller {

    public function index() 
    {
        // Check if the user is logged in
        if (isset($_SESSION['user_id'])) {
            // check the user type
            if ($_SESSION['type'] == 'Vet Doctor') {
                $doctorID = $_SESSION['user_id'];
                $doctor = new DoctorModel();

                // get the doctor details
                $doctorDetails = $doctor->find($doctorID);

                if ($doctorDetails->approvedStatus == 'rejected') {
                    $this->view('registerdetail/rejected', [
                        'doctorDetails' => $doctorDetails
                    ]);
                } else {
                    // Redirect to the appropriate page based on the doctor's status
                    switch ($doctorDetails->approvedStatus) {
                        case 'pending':
                            header('Location: ' . ROOT . '/Pending');
                            break;
                        case 'accepted':
                            header('Location: ' . ROOT . '/Doctor');
                            break;
                        default:
                            header('Location: ' . ROOT . '/login');
                            exit();
                    }
                }
            } else {
                // Redirect to the login page if not logged in
                header('Location: ' . ROOT . '/login');
                exit();
            }
            
            
        } elseif (isset($_SESSION['SALON_USER'])) {
            if ($_SESSION['type'] == 'Salon') {
                
            } else {
                // Redirect to the login page if not logged in
                header('Location: ' . ROOT . '/login');
                exit();
            }
        } else {
            // Redirect to the login page if not logged in
            header('Location: ' . ROOT . '/login');
            exit();
        }
    }
}

?>