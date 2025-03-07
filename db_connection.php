<?php

$server_name = "localhost";
$username = "root";
$password = "";
$db_name = "inventory_management_system_db";

$conn = new mysqli($server_name, $username, $password, $db_name);

if($conn->connect_error){
    die("Connection Failed: {$conn->connect_error}");
}
?>