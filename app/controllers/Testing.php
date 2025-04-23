<?php

class Testing extends Controller {
    use Database;

    public $myText = "Hello World! Ich bin Jon Manuel!";
    public $getText;
    public $oho;

    public function __construct() {
        $this->getText = $_GET['hmm'] ?? null;

        $this->oho = "Ayo";

        
        // in other models' construct
        // set the value of petOwnerID from sessionStorage if exists; if not existing, nothing changes
        // isset($_SESSION['petOwnerID']) && $this->petOwnerID = $_SESSION['petOwnerID'];
    }

    // private function query($query) {
    //     $string = "mysql:host=" . DBHOST . ";dbname=" . DBNAME;
    //     try {
    //         $con = new PDO($string, DBUSER, DBPASS);
    //         $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //     } catch (PDOException $e) {
    //         die("Connection failed: " . $e->getMessage());
    //     }

    //     $stm = $con->prepare($query);
    //     $check = $stm->execute(); // execute the query

    //     if ($check) { // if the query is successful
    //         $result = $stm->fetchAll(PDO::FETCH_OBJ); // fetch the result as an object
    //         if (is_array($result) && count($result)) { // if the result is an array and has more than 0 elements
    //             return $result;
    //         }
            
    //     }
    //     return false;
    // }

    public function index() {
        $this->view('petowner/testing');
    }

    public function getAllUsers () {
        $myQuery = "SELECT * FROM user";   
        $result = $this->query($myQuery);
        
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }
    // $myQuery = "SELECT s.*, v.fullName, v.profilePicture 
    //             FROM session s 
    //             INNER JOIN vetdoctor v ON s.doctorID = v.doctorID";

    public function getSessions () {
        $docName = $_GET['docName'] ?? '';
        
        $selectedDate = $_GET['selectedDate'] ?? null;
        $selectedDate = $selectedDate ? date('Y-m-d', strtotime($selectedDate)) : null;

        $afterDate = date('Y-m-d', strtotime('01-04-2025'));
        
        $tableName = 'session';
        $myQuery = "SELECT s.*, v.fullName, v.profilePicture 
                    FROM $tableName s 
                    INNER JOIN vetdoctor v ON s.doctorID = v.doctorID
                    WHERE s.selectedDate > :afterDate
                    ORDER BY (v.fullName LIKE :docName) DESC,
                            (s.selectedDate = :selectedDate) DESC,
                            (s.selectedDate > :selectedDate) DESC";
        $params = [
            'docName' => '%' . $docName . '%',
            'selectedDate' => $selectedDate,
            'afterDate' => $afterDate
        ];
        $result = $this->query($myQuery, $params) ?: ["sessionCount" => 0];
        
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }

    // public function getSessions (string $docName = '') {
    //     $tableName = 'session';
    //     $myQuery = "SELECT s.*, v.fullName, v.profilePicture 
    //                 FROM $tableName s 
    //                 INNER JOIN vetdoctor v ON s.doctorID = v.doctorID
    //                 ORDER BY (v.fullName LIKE :docName) DESC";
    //     $params = [
    //         'docName' => '%' . $docName . '%'
    //     ];
    //     $result = $this->query($myQuery, $params) ?: ["sessionCount" => 0];
        
    //     header('Content-Type: application/json');
    //     echo json_encode($result);
    //     exit;
    // }

    // WHERE v.fullName LIKE :docName

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
