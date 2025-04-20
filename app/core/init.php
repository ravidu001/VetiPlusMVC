<?php
// used to run the all files in the core folder. eken apita core eke thiyena files eka eka load krnna one na index.php eke

spl_autoload_register(function($classname) {
    require $filename = "../app/models/".ucfirst($classname).".php";
}); // this function is used to load the classes in the models folder

require 'config.php';
require 'functions.php';
require 'Database.php';  // is a class that contains all the functions that interact with the database
require 'Model.php'; // is a class that contains all the functions that interact with the model
require 'Controller.php'; // is a class that contains all the functions that interact with the controller. common class like view are in this file. other controllers are in the controller folder
require 'App.php'; // is a class that contains all the functions that interact with the app
require '../app/models/Notification.php';