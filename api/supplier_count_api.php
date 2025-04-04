<?php

    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
    header("Access-Control-Allow-Headers: Content-Type");

    include "database.php";
    include "../class/Suppliers.php";

    $database = new Database();
    $db = $database->getConnection();

    $suppliers = new Suppliers($db);

    $method = $_SERVER["REQUEST_METHOD"];

    switch ($method){
        case 'GET':
            if(isset($_GET['id'])){
            }else{
                $supCount = $suppliers->getSupplierCount();
                echo json_encode(["status" => "success", "supCount" => $supCount]);
            }
            break;
        case 'POST':
            break;
        case 'PUT':
            break;
        case 'DELETE':
            break;
        default:
            echo json_encode(["status" => "error", "message" => "Invalid request method"]);
    }
?>