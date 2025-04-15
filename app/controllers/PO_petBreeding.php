<?php

class PO_petBreeding extends Controller {
    
    private $petOwnerID;
    
    public $petOwner;
    public $po_details; // eg usage: $this->po_details->fullName

    public $pets;
    public $pet_details;
    
    public function __construct() {
        isset($_SESSION['petOwnerID'])
            ? $this->petOwnerID = $_SESSION['petOwnerID']
            : redirect('Login');
    }
    
    public function index() {
        $this->view('petowner/petBreeding');
    }
}
