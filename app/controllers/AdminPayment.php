<?php

class AdminPayment extends Controller
{
    public function index()
    {
        $this->view('admin/payment');
    }
    public function paymentlist()
    {
        $this->view('admin/paymentlist');
    }
}
