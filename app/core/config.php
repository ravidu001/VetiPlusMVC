<?php

// absolute path to the root folder for the images, css, js files. because we can not give relative paths for the assets  in the views folder.
if($_SERVER['SERVER_NAME'] == 'localhost'){

    // database configuration
    define('DBHOST', 'localhost');
    define('DBUSER', 'root');
    define('DBPASS', '');
    define('DBNAME', 'VetiPlus');
    define('DBDRIVER', '');

    define('ROOT', 'http://localhost/VetiPlusMVC/public');
} else {
    // database configuration
    define('DBHOST', 'localhost');
    define('DBUSER', 'root');
    define('DBPASS', '');
    define('DBNAME', 'VetiPlus');
    define('DBDRIVER', '');

    define('ROOT', 'https://www.vetiplus.com');
}

define('APP_NAME', 'Vetiplus');
define('APP_DESC', 'Vetiplus is a web application that helps you to manage your veterinary clinic');

define('DEBUG', true); // set to false to hide the errors and true means show the errors
