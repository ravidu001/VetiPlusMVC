<?php
class Admin extends Controller
{
    public function index()
    {
        $userCount = $this->countUser();
        // echo $userCount;
        $this->view('admin/adminhome', ['userCount' => $userCount]);
    }

    public function countUser(){
        $user = new User();
        $count = $user->countUser();
        return $count;
    }
}

