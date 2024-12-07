<?php

class Home extends Controller {
    public function index() {
        $this->view('home');
    }

    public function about() {
        $about = [
            'title' => 'About',
            'description' => "This is the about page of our custom MVC framework."
        ];
        $this->view('home/about', ['about'=>$about]);
    }
}

