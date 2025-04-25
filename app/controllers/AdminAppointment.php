<?php

class AdminAppointment extends Controller
{
    public function index()
    {
        $appointment = new AppointmentModel();
        $appointmentdata = $appointment->getalldata();
        $appointmentcount = $this->appointmentcount();
        $dailyappointment = $this->dailyappointment();

        $this->view('admin/appointment', [
            'appointmentdata' => $appointmentdata,
            'appointmentcount' => $appointmentcount,
            'dailyappointmentcount' => $dailyappointment,

        ]);
    }
    public function appointmentlist()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['submit'])) {
            // Retrieve the email from the GET request
            $petownerID = $_GET['petownerid'];


            // Validate the email
            if (filter_var($petownerID, FILTER_VALIDATE_EMAIL)) {
                // Instantiate the model
                $appointmentpetownerid = new AppointmentModel();

                // Fetch admin details using the email
                $petownerresult = $appointmentpetownerid->getAppointmentBypetownerID($petownerID);


                // Check if an admin exists with the provided email
                if (!empty($petownerresult)) {
                    // Pass the admin details to the admin profile view
                    $this->view('admin/appointmentlist', ['admin' => $petownerresult]);
                } else {
                    // If admin not found, redirect to a 'not found' page or display a message
                    $this->view(['error' => 'No admin found with this email.']);
                }
            } else {
                // Handle invalid email input
                $this->view(['error' => 'Invalid email format. Please try again.']);
            }
        }
    }

    public  function appointmentcount()
    {
        $appointment  = new AppointmentModel();
        $count = $appointment->appointmentcount();
        return $count;
    }

    public function dailyappointment()
    {
        $dailyappointment = new AppointmentModel();
        $count = $dailyappointment->dailyappointment();
        return $count;
    }
}
