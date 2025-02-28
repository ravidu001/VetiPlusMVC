<?php

class Testing extends Controller {

    public $myText = "Hello World! Ich bin Jon Manuel!";
    public $getText;
    public $oho;

    public function __construct() {
        $this->getText = $_GET['hmm'] ?? null;

        $this->oho = "Ayo";
    }

    private function query($query) {
        $string = "mysql:host=" . DBHOST . ";dbname=" . DBNAME;
        try {
            $con = new PDO($string, DBUSER, DBPASS);
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }

        $stm = $con->prepare($query);
        $check = $stm->execute(); // execute the query

        if ($check) { // if the query is successful
            $result = $stm->fetchAll(PDO::FETCH_OBJ); // fetch the result as an object
            if (is_array($result) && count($result)) { // if the result is an array and has more than 0 elements
                return $result;
            }
            
        }
        return false;
    }

    public function index() {
        $this->view('petowner/testing');
    }

    public function getAllUsers () {
        $myQuery = "SELECT email, type FROM user";   
        $result = $this->query($myQuery);
        
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }

    public function getPetOwners () {
        $myQuery = "SELECT email, type FROM user WHERE type = 'Pet Owner'";
        $result = $this->query($myQuery);
        
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }

    public function getVetDoctors () {
        $myQuery = "SELECT email, type FROM user WHERE type = 'Vet Doctor'";
        $result = $this->query($myQuery);
        
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }

    public function getAdmins () {
        $myQuery = "SELECT email, type FROM user WHERE type = 'System Admin'";
        $result = $this->query($myQuery);
        
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }
}
