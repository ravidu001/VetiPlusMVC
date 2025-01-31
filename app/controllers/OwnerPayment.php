<?php
class OwnerPayment extends Controller
{
    public function index()
    {
        $this->view('owner/payment');
    }
    public function paymentlist(){
        $this->view('owner/paymentlist');
    }
}
