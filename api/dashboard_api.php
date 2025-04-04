<?php

    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
    header("Access-Control-Allow-Headers: Content-Type");

    include "database.php";
    include "../class/Accounts.php";
    include "../class/Categories.php";
    include "../class/Suppliers.php";
    include "../class/Items.php";

    $database = new Database();
    $db = $database->getConnection();

    $accounts = new Accounts($db);
    $suppliers = new Suppliers($db);
    $categories = new Categories($db);
    $items = new Items($db);

    $method = $_SERVER["REQUEST_METHOD"];

    switch ($method){
        case 'GET':
            if(isset($_GET['id'])){
            }else{
                $accCount = $accounts->getAccountCount();
                echo json_encode(["status" => "success", "accCount" => $accCount]);
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