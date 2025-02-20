<?php

class SalonFeedback extends Controller{

    public function index(){

        $feedbacktable = new SalonFeedbacks;

        $data = $feedbacktable->findAllFeedback();

        show($data);

        if(isset($_POST['reply']))
        {
            //waht to find the who send the reply

            //get the sending reply
            $data = [
                'response' => htmlspecialchars(trim($_POST['send'] ?? '')),
                'salonID' => $_SESSION['SALON_USER'] ?? ''
            ];

            //want to send the reply data to the table
            if ($feedbacktable->addFeedback($data))
            {
                $data['success'] = $data['response'];
            }
        }

        $this->view('Salon/salonfeedback', $data);
    }
}

?>