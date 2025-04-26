<?php

class PO_petAdoption extends Controller {

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
        $this->view('petowner/petAdoption');
    }

    public function forAdoption_getList () {}
    public function forAdoption_getMyList () {}
    public function forAdoption_addNew() {}
}
