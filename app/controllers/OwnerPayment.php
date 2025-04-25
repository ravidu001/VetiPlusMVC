<?php
class OwnerPayment extends Controller
{
    public function index()
    {
        $appointmentPay = new AppointmentPayModel();
        $paymentdata = $appointmentPay->getalldata();
        $total = $appointmentPay->CalRevenue();
        $todayRevenue = $appointmentPay->CalTodayRevenue();

        $this->view('owner/payment',[
            'paymentdata' => $paymentdata,
            'total' => $total,
            'todayRevenue' => $todayRevenue,
        ]);
    }
    public function paymentlist()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $petownerID = $_POST['petownerID'] ?? null;

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
                $this->view('owner/paymentlist', [
                    'paymentdata' => $paymentdata,
                    'petownerName' => $petownerName,
                    'paymentinfoData' => $paymentinfoData,
                ]);
            } else {
                // Handle the case where no data is found
                $this->view('owner/payment', ['error' => 'No payment data found for the given Pet Owner ID.']);
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
                $this->view('owner/paymentlist', [
                    'paymentdata' => $paymentdata,
                    'petownerName' => $petownerName,
                    'paymentinfoData' => $paymentinfoData,
                ]);
            } else {
                // Handle the case where no data is found
                $this->view('owner/payment', ['error' => 'No payment data found for the given Pet Owner ID.']);
            }

    }
}
