<?php

session_start();

include "api/database.php";
include "class/Accounts.php";

$database = new Database();
$conn = $database->getConnection();

$acc = new Accounts($conn);

$row = $acc->getAccountCountByAdmin();
if ($row["count"] == 0) {
    header("Location: welcome/welcome.php");
    exit();
} else {
    header("Location: login.php");
    exit();
}

?>
