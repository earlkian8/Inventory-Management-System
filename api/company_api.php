<?php

    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
    header("Access-Control-Allow-Headers: Content-Type");

    include "database.php";
    include "../class/Company.php";

    $database = new Database();
    $db = $database->getConnection();

    $company = new Company($db);

    $method = $_SERVER["REQUEST_METHOD"];

    switch ($method){
        case 'GET':
            if(isset($_GET['id'])){
                $comData = $company->getCompanyById($_GET['id']);
                echo json_encode(["status" => "success", "comData" => $comData]);
            }else{
                $com = $company->getAllCompany();
                echo json_encode(["status" => "success", "company" => $com]);
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