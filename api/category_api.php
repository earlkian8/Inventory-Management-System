<?php

    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
    header("Access-Control-Allow-Headers: Content-Type");

    include "database.php";
    include "../class/Categories.php";

    $database = new Database();
    $db = $database->getConnection();

    $category = new Categories($db);

    $method = $_SERVER["REQUEST_METHOD"];

    switch ($method){
        case 'GET':
            if(isset($_GET['id'])){
                $catData = $category->getCategoryById($_GET['id']);
                echo json_encode(["status" => "success", "catData" => $catData]);

            }else{
                $categories = $category->getAllCategories();
                echo json_encode(["status" => "success", "categories" => $categories]);
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