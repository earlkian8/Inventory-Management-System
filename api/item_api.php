<?php

    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
    header("Access-Control-Allow-Headers: Content-Type");

    include "database.php";
    include "../class/Items.php";

    $database = new Database();
    $db = $database->getConnection();

    $item = new Items($db);

    $method = $_SERVER["REQUEST_METHOD"];

    switch ($method){
        case 'GET':
            if(isset($_GET['id'])){
                $itemData = $item->getItemById($_GET['id']);
                echo json_encode(["status" => "success", "itemData" => $itemData]);

            }else{
                $items = $item->getAllItems();
                echo json_encode(["status" => "success", "items" => $items]);
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