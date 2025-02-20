<?php
class AdminFeedback extends Controller{
    public function index(){
        $feedback = $this->feedback();
        $this->view('admin/feedback', ['feedback' => $feedback]);
    }

     public function feedback(){
        $feedbackuser = new systemfeedbackModel();
        $feedback =  $feedbackuser->getfeedback();
        return $feedback;
     }
}
   
