<?php

    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
    header("Access-Control-Allow-Headers: Content-Type");

    include "database.php";
    include "../class/Installment.php";

    $database = new Database();
    $db = $database->getConnection();

    $installment = new Installment($db);

    $installment_items = $installment->getAllInstallmentItems();
    echo json_encode(["status" => "message", "installment_items" => $installment_items]);

?>