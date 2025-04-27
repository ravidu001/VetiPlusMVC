<?php

class AdminPayment extends Controller
{
    public function index()
    {
        $appointmentPay = new AppointmentPayModel();
        $paymentdata = $appointmentPay->getalldata();
        $total = $appointmentPay->CalRevenue();
        $todayRevenue = $appointmentPay->CalTodayRevenue();
        $petownercount = $this->petownercount();
        // show($total);  
        $this->view('admin/payment', [
            'paymentdata' => $paymentdata,
            'total' => $total,
            'todayRevenue' => $todayRevenue,
            'petownercount' => $petownercount,
        ]);
    }
    public function paymentlist()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $petownerID = $_POST['petownerID'] ?? null;

            $appointmentPay = new AppointmentPayModel();
            $paymentdata = $appointmentPay->getdatabypetowner($petownerID);
            // show($paymentdata);

            $notification = new Notification();

            if ($paymentdata) {
                $petowner = new PetOwner();
                $petownerData = $petowner->getUserDetailsByID($petownerID);
                if ($petownerData) {
                    $petownerName = $petownerData->fullName;
                } else {
                    // Handle the case where pet owner data is not found
                    $petownerName = 'Unknown User';
                }
                $paymentinfo = new PaymentInformationModel();
                $paymentinfoData = $paymentinfo->getPaymentDetails($petownerID);
                // show($paymentinfoData);
                $this->view('admin/paymentlist', [
                    'paymentdata' => $paymentdata,
                    'petownerName' => $petownerName,
                    'paymentinfoData' => $paymentinfoData,
                ]);
            } else {
                // Handle the case where no data is found
                $notification->show("No payment data found for the given Pet Owner ID", 'error');
                redirect('AdminPayment');
            }
        }
    }

    public function paymentdetailpay($petownerID)
    {
        $appointmentPay = new AppointmentPayModel();
        $paymentdata = $appointmentPay->getdatabypetowner($petownerID);
        // show($paymentdata);

        if ($paymentdata) {
            $petowner = new PetOwner();
            $petownerData = $petowner->getUserDetailsByID($petownerID);
            if ($petownerData) {
                $petownerName = $petownerData->fullName;
            } else {
                // Handle the case where pet owner data is not found
                $petownerName = 'Unknown User';
            }
            $paymentinfo = new PaymentInformationModel();
            $paymentinfoData = $paymentinfo->getPaymentDetails($petownerID);
            // show($paymentinfoData);
            $this->view('admin/paymentlist', [
                'paymentdata' => $paymentdata,
                'petownerName' => $petownerName,
                'paymentinfoData' => $paymentinfoData,
            ]);
        } else {
            // Handle the case where no data is found
            $this->view('admin/payment', ['error' => 'No payment data found for the given Pet Owner ID.']);
        }
    }
    public function petownercount()
    {
        $petownerdata = new PetOwner();
        $count = $petownerdata->petownercount();
        return $count;
    }
    public function CalTodayRevenue()
    {
        $caltoday = new AppointmentPayModel();
        $count = $caltoday->CalTodayRevenue();
        return $count;
    }
    public function downloadreport()
    {
        $payment = new AppointmentPayModel();
        $paymentdata = $payment->getalldata();

        // Set headers to download file
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename=payment_report.csv');

        $output = fopen('php://output', 'w');

        // Write the column headers
        fputcsv($output, ['paymentID', 'appointmentID', 'dateTime', 'serviceType', 'amount']);

        // Write the rows
        foreach ($paymentdata as $data) {
            fputcsv($output, [
                $data->paymentID ?? 'N/A',
                $data->appointmentID ?? 'N/A',
                $data->dateTime ?? 'N/A',
                $data->serviceType ?? 'N/A',
                $data->amount ?? 'N/A'
            ]);
        }

        fclose($output);
        exit;
    }
}
