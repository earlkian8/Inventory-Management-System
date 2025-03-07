<?php

session_start();

include "db_connection.php";

$sql = "SELECT COUNT(*) as count FROM accounts WHERE account_type = 'admin'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($row['count'] == 0){
    header("Location: auth/welcome_page.php");
    exit();
} else{
    header("Location: login.php");
    exit();
}
?>