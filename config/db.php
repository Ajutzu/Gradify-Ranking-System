<?php

$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'gradify';

$conn = new mysqli($hostname, $username, $password, $database);

if($conn->connect_error) {
    die('Connection error: '. $conn->connect_error);
} else {
   // echo 'Connection Establish';
}

session_start();