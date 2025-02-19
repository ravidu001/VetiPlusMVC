<?php

class Testing extends Controller {

    public $myText = "Hello World! Ich bin Jon Manuel!";
    public $getText;
    public $oho;

    public function __construct() {
        $this->getText = $_GET['hmm'] ?? null;

        $this->oho = "Ayo";
    }

    public function index() {
        $this->view('petowner/testing');
    }
}
