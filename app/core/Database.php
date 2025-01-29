<?php


trait Database
{
    private function connect()
    {
        $string = "mysql:host=" . DBHOST . ";dbname=" . DBNAME;
        try {
            $con = new PDO($string, DBUSER, DBPASS);
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $con;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
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
}
