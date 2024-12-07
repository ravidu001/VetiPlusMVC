<?php

class Doctor extends Controller {
    public function index() {
        $this->view('vetDoctor/home');
    }

    public function about() {
        echo "This is the about page of our custom MVC framework.";
    }
}
