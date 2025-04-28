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

            $notification = new Notification();

            if ($paymentdata) {
                $petowner = new PetOwner();
                $petownerData = $petowner->getUserDetailsByID($petownerID);
                if ($petownerData) {
                    $petownerName = $petownerData->fullName;
                } else {
                    $petownerName = 'Unknown User';
                }
                $paymentinfo = new PaymentInformationModel();
                $paymentinfoData = $paymentinfo->getPaymentDetails($petownerID);
                $this->view('admin/paymentlist', [
                    'paymentdata' => $paymentdata,
                    'petownerName' => $petownerName,
                    'paymentinfoData' => $paymentinfoData,
                ]);
            } else {
                $notification->show("No payment data found for the given Pet Owner ID", 'error');
                redirect('AdminPayment');
            }
        }
    }

    public function paymentdetailpay($petownerID)
    {
        $appointmentPay = new AppointmentPayModel();
        $paymentdata = $appointmentPay->getdatabypetowner($petownerID);

        if ($paymentdata) {
            $petowner = new PetOwner();
            $petownerData = $petowner->getUserDetailsByID($petownerID);
            if ($petownerData) {
                $petownerName = $petownerData->fullName;
            } else {
                $petownerName = 'Unknown User';
            }
            $paymentinfo = new PaymentInformationModel();
            $paymentinfoData = $paymentinfo->getPaymentDetails($petownerID);
            $this->view('admin/paymentlist', [
                'paymentdata' => $paymentdata,
                'petownerName' => $petownerName,
                'paymentinfoData' => $paymentinfoData,
            ]);
        } else {
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

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename=payment_report.csv');

        $output = fopen('php://output', 'w');

        fputcsv($output, ['paymentID', 'appointmentID', 'dateTime', 'serviceType', 'amount']);

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
