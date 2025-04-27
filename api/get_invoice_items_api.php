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

    $invoice_items = $invoice->getAllInvoiceItems();
    echo json_encode(["status" => "message", "invoice_items" => $invoice_items]);

?>