<?php

class PO_home extends Controller {

    private $petOwnerID;

    public $petOwner;
    public $po_details; // eg usage: $this->po_details->fullName

    public $pets;
    public $pet_details;

    public function __construct() {
        isset($_SESSION['petOwnerID'])
            ? $this->petOwnerID = $_SESSION['petOwnerID']
            : redirect('Login');

        $this->petOwner = new PetOwner;
        // an assoc array containing petOwner table details
        $this->po_details = $this->petOwner->getUserDetails();

        $this->pets = new Pet;
        $this->pet_details = $this->pets->getPetsDetails();
    }

    public function index() {
        $this->view('petowner/home');
    }
}
