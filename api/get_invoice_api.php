<?php

    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
    header("Access-Control-Allow-Headers: Content-Type");

    include "database.php";
    include "../class/Invoice.php";

    $database = new Database();
    $db = $database->getConnection();

    $invoice = new Invoice($db);

    $invoices = $invoice->getAllInvoice();
    echo json_encode(["status" => "message", "invoices" => $invoices]);

?>