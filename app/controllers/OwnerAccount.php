<?php
class OwnerAccount extends Controller
{
    public function index()
    {   
        $userCount = $this->countUser();
        $this->view('owner/account' , ['userCount'=>$userCount]);
    }
    public function doctor()
    {
        $this->view('owner/doctoraccount');
    }

    public function petuser()
    {
        $this->view('owner/petuseraccount');
    }
    public function pet()
    {
        $this->view('owner/petaccount');
    }

    public function countUser(){
        $user = new User();
        $count = $user->countUser();
        return $count;
    }
}
