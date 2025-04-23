<?php

class PaymentInformationModel {
    use Model;

    protected $table = 'paymentInformation';

    protected $allowedColumns = ['paymentInfoID', 'cardType', 'cardNumber', 'expiredmonth', 'expiredmonth', 'CVV', 'petOwnerID'];

    public function getPaymentDetails($petownerID) {
        $this->order_column = 'cardType';
        $this->order_type = 'DESC';
        return $this->where(['petownerID' => $petownerID]);
    }
}