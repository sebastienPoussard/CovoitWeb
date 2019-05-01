<?php

// Database information
$host = "localhost";
$user = "postgres";
$password = "postgres";
$db = "QuietCar";
try {
    // Connection to database
    $bdd= new PDO("pgsql:host=$host;dbname=$db", $user, $password);
} catch (Exception $e) {
    die("Error " . $e->getMessage());
}
?>