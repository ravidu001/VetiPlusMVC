<?php


trait Database
{
    private $con = null;
    private function connect()
    {
        if ($this->con === null) {
            $string = "mysql:host=" . DBHOST . ";dbname=" . DBNAME;
            try {
                $this->con = new PDO($string, DBUSER, DBPASS);
                $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }
        }
        return $this->con;
    }

    public function query($query, $data = [])
    {
        $con = $this->connect();
        $stm = $con->prepare($query);
        $check = $stm->execute($data); // execute the query

        if ($check) { // if the query is successful
            $result = $stm->fetchAll(PDO::FETCH_OBJ); // fetch the result as an object
            if (is_array($result) && count($result)) { // if the result is an array and has more than 0 elements
                return $result;
            }
            
        }
        return false;
    }

    public function get_row($query, $data = [])
    {
        $con = $this->connect();
        $stm = $con->prepare($query);
        $check = $stm->execute($data);

        if ($check) { // if the query is successful
            $result = $stm->fetchAll(PDO::FETCH_OBJ); // fetch the result as an object
            if (is_array($result) && count($result)) { // if the result is an array and has more than 0 elements
                return $result[0];
            }
        }
        return false;
    }

    // function needed for Transactions dealing with multiple queries at the same time:
    public function beginTransaction () {
        $con = $this->connect();
        $con->beginTransaction();
    }
    public function commit () {
        $con = $this->connect();
        $con->commit();
    }
    public function rollBack () {
        $con = $this->connect();
        $con->rollBack();
    }

    public function getLastID() {
        $con = $this->connect();
        return $con->lastInsertId();
    }

}
