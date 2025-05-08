<?php
ob_start();
ini_set('display_errors', 0);
error_reporting(E_ERROR);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/php_errors.log');

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

try {
    if (!file_exists("database.php")) {
        throw new Exception("database.php not found");
    }
    if (!file_exists("../class/Accounts.php")) {
        throw new Exception("Accounts.php not found");
    }

    include "database.php";
    include "../class/Accounts.php";

    $database = new Database();
    $db = $database->getConnection();

    if (!$db) {
        throw new Exception("Database connection failed");
    }

    $accounts = new Accounts($db);

    $method = $_SERVER["REQUEST_METHOD"];

    switch ($method) {
        case 'GET':
            if (isset($_GET['id'])) {
                $accData = $accounts->getAccountById($_GET["id"]);
                echo json_encode(["status" => "success", "accData" => $accData]);
            } else {
                $acc = $accounts->getAllAccounts();
                echo json_encode(["status" => "success", "acc" => $acc]);
            }
            break;
        case 'POST':
            $data = json_decode(file_get_contents("php://input"), true);
            if (isset($data['email']) && isset($data['password'])) {
                if ($accounts->updatePassword($data['email'], $data['password'])) {
                    echo json_encode(["status" => "success", "message" => "Password updated successfully"]);
                } else {
                    echo json_encode(["status" => "error", "message" => "Failed to update password"]);
                }
            } else {
                echo json_encode(["status" => "error", "message" => "Missing required fields"]);
            }
            break;
        default:
            echo json_encode(["status" => "error", "message" => "Invalid request method"]);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => "Server error: " . $e->getMessage()]);
}

ob_end_flush();
?>