<?php

class PO_home extends Controller {

    public $petOwnerID;
    public $petOwner;
    public $po_details; // eg usage: $this->po_details->fullName

    public $pets;
    public $petCount;
    public $pet_details; // will be mapped with js
    
    public $petAppts;

    public function __construct() {
        !isset($_SESSION['petOwnerID']) && redirect('Login');
        $this->petOwnerID = $_SESSION['petOwnerID'];
        
        $this->petOwner = new PetOwner;
        $this->petOwner->setPetOwnerID();

        // an assoc array containing petOwner table details
        $this->po_details = $this->petOwner->getUserDetails();

        // if not properly registered, redirect
        !isset($this->po_details->fullName) && redirect('po_register');

        $this->pets = new Pet;
        $this->pets->setPetOwnerID();
        
        $this->petAppts = new PO_PetAppts;

        $this->pet_details = $this->pets->getAllPetsUnderUser() ?: ["fetchedCount" => 0];
        $this->petCount = $this->pet_details ? count($this->pet_details) : 0;

    }

    public function index() {
        $this->view('petowner/home');
    }

    public function getPets() {
        $result = $this->pet_details ?: ["fetchedCount" => 0];
        
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }

    public function getAppts_upcoming () {
        $options = [
            'petID' => null,
            'petOwnerID' => $this->petOwnerID,
            'type' => 'all'
        ];
        $result = $this->petAppts->getPetApptUpcoming($options) ?: ["fetchedCount" => 0];
        
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }

}
