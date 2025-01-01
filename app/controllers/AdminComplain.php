<?php

class AdminComplain extends Controller
{
    public function index()
    {
        $this->view('admin/complain');
    }
    public function complainlist()
    {
        $this->view('admin/complainlist');
    }
}
