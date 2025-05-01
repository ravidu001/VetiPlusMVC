<?php

class AdminAppointment extends Controller
{
    public function index()
    {
        $appointment = new AppointmentModel();
        $appointmentdata = $appointment->getalldata();
        $appointmentcount = $this->appointmentcount();
        $cancelappointment = $this->cancelappointmentcount();
        $pendingappointment = $this->pendingappointmentcount();

        $this->view('admin/appointment', [
            'appointmentdata' => $appointmentdata,
            'appointmentcount' => $appointmentcount,
            'pendingappointment' => $pendingappointment,
            'cancelappointment' => $cancelappointment,

        ]);
    }
    public function appointmentlist()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['submit'])) {
            $appointmentID = $_GET['appointmentID'];

            $notification = new Notification();


            if (!empty($appointmentID)) {
                $appointmentappointmentID = new AppointmentModel();

                $petownerresult = $appointmentappointmentID->getAppointmentByappointmentID($appointmentID);


                if (!empty($petownerresult)) {
                    $this->view('admin/appointmentlist', ['admin' => $petownerresult]);
                } else {
                    $notification->show("No Appointment found with this Appointment ID.", 'error');
                }
            } else {
                $notification->show(" Please Enter Appointment ID. ", 'error');
            }
        }
    }

    public  function appointmentcount()
    {
        $appointment  = new AppointmentModel();
        $count = $appointment->appointmentcount();
        return $count;
    }

    public function pendingappointmentcount()
    {
        $pendingappointment = new AppointmentModel();
        $count = $pendingappointment->pendingappointmentcount();
        return $count;
    }
    public function cancelappointmentcount()
    {
        $cancelappointment = new AppointmentModel();
        $count = $cancelappointment->cancelappointmentcount();
        return $count;
    }
    public function downloadreport()
    {
        $appointment = new AppointmentModel();
        $appointmentdata = $appointment->getalldata();

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename=appointments_report.csv');

        $output = fopen('php://output', 'w');

        fputcsv($output, ['Appointment ID', 'Pet Name', 'Date and Time', 'Session ID', 'Visit Time', 'Status']);

        foreach ($appointmentdata as $data) {
            fputcsv($output, [
                $data->appointmentID ?? 'N/A',
                $data->petID ?? 'N/A',
                $data->bookedDateTime ?? 'N/A',
                $data->sessionID ?? 'N/A',
                $data->visitTime ?? 'N/A',
                $data->status ?? 'N/A'
            ]);
        }

        fclose($output);
        exit;
    }
}
