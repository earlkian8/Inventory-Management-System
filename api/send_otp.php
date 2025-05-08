<?php
ob_start();
ini_set('display_errors', 0);
error_reporting(E_ERROR);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/php_errors.log');

header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
$email = $input['email'] ?? '';
$otp = $input['otp'] ?? '';

if (empty($email) || empty($otp)) {
    error_log("Invalid input: email=$email, otp=$otp");
    echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
    ob_end_flush();
    exit;
}

$to = $email;
$subject = 'Your OTP';
$message = "OTP: $otp";
$headers = 'From: no-reply@localhost';

if (mail($to, $subject, $message, $headers)) {
    echo json_encode(['status' => 'success', 'message' => 'OTP sent']);
} else {
    $error = error_get_last();
    error_log("Failed to send OTP to $email: " . ($error['message'] ?? 'Unknown error'));
    echo json_encode(['status' => 'error', 'message' => 'Failed to send OTP']);
}

ob_end_flush();
?>