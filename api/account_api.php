<?php

    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
    header("Access-Control-Allow-Headers: Content-Type");

    include "database.php";
    include "../class/Accounts.php";

    $database = new Database();
    $db = $database->getConnection();

    $accounts = new Accounts($db);

    $method = $_SERVER["REQUEST_METHOD"];

    switch ($method){
        case 'GET':
            if(isset($_GET['id'])){
                $accData = $accounts->getAccountById($_GET["id"]);
                echo json_encode(["status" => "success", "accData" => $accData]);
            }else{
                $acc = $accounts->getAllAccounts();
                echo json_encode(["status" => "success", "acc" => $acc]);
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