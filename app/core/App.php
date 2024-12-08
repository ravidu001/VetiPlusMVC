
<?php

class App {

    private $controller = "Landing";
    private $method = "index";

    // user dena url eka slit krla array ekaka save krnwa. example ekak yata thiyenawa.
    private function splitURL() {
        $URL = $_GET['url'] ?? 'landing'; // $_GET is an array that contains all the variables passed through the URL`
        $URL = explode('/', trim($URL,"/")); // explode is a function that splits a string into an array
        return $URL;
    }

    public function loadController() {
        $URL = $this->splitURL();

        $filename = "../app/controllers/".ucfirst($URL[0]).".php"; // ucfirst is a function that converts the first character of a string to uppercase 
        if(file_exists($filename)) {
            require $filename;
            $this->controller = ucfirst($URL[0]);
            unset($URL[0]);
        } else {
            $filename = "../app/controllers/".ucfirst($URL[0])."/".$URL[0].".php"; // if the file does not exist, check if the file exists in a subfolder
            if(file_exists($filename)) {
                require $filename;
                $this->controller = ucfirst($URL[0]);
            } else {
                $filename = "../app/controllers/_404.php"; // if the file does not exist, load the 404 controller
                require $filename;
                $this->controller = "_404";
            }
        } 
        
        $controller = new $this->controller; // create an instance of the controller

        // check if the method exists in the controller
        if(!empty($URL[1])){
            if(method_exists($controller, $URL[1])) {
                $this->method = $URL[1];
                unset($URL[1]);
            } else {
                $filename = "../app/controllers/_404.php"; // if the method does not exist, load the 404 controller
                require $filename;
                $this->controller = "_404";
                $controller = new $this->controller; // create an instance of the controller
            }
        }
        // show($URL);
        call_user_func_array([$controller, $this->method], $URL); // call the method of the controller. call_user_func_array is a function that calls a user-defined function with an array of parameters. 
        // array paramters used to pass the URL parameters to the method
    }

}

//show(splitURL());
// http://localhost/vetiplusMVC/public/home/appointment
// Output: Array ( [0] => home [1] => appointment  )