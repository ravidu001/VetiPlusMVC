<?php

function show($stuff) {
    echo "<pre>";
    print_r($stuff); // print_r is a function that prints human-readable information about a variable
    echo "</pre>";
}

function esc($str) {
    return htmlspecialchars($str);
}

function redirect($path) {
    header("Location: " . ROOT."/".$path); // header is a function that sends a raw HTTP header to a client ");
    exit();
}