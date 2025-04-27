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

    public function saveCardDetails ($data) {
        $alreadyExist = $this->getPaymentDetails($data['petOwnerID']);
        
        if (empty($alreadyExist)) {
            $saveSuccess = $this->insert($data);
            if (empty($saveSuccess)) return ['success' => true, 'paymentInfoID' => $this->getLastID()];
            else return ['success' => false, 'paymentInfoID' => ''];
        }
        else return $alreadyExist[0]['paymentInfoID'];
    }

    public function acceptpayment () {
        return true;
    }
}