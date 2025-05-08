<?php
ob_start();
ini_set('display_errors', 0);
error_reporting(E_ERROR);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/php_errors.log');

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

try {
    $envFile = '../.env';
    if (!file_exists($envFile)) {
        error_log("get_env.php: .env file not found at $envFile");
        throw new Exception('.env file not found');
    }

    if (!is_readable($envFile)) {
        error_log("get_env.php: .env file at $envFile is not readable");
        throw new Exception('.env file not readable');
    }

    $env = parse_ini_file($envFile);
    if ($env === false) {
        error_log("get_env.php: Failed to parse .env file at $envFile");
        throw new Exception('Failed to parse .env file');
    }

    $config = [
        'EMAILJS_USER_ID' => $env['EMAILJS_USER_ID'] ?? '',
        'EMAILJS_SERVICE_ID' => $env['EMAILJS_SERVICE_ID'] ?? '',
        'EMAILJS_TEMPLATE_ID' => $env['EMAILJS_TEMPLATE_ID'] ?? ''
    ];

    if (empty($config['EMAILJS_USER_ID']) || empty($config['EMAILJS_SERVICE_ID']) || empty($config['EMAILJS_TEMPLATE_ID'])) {
        error_log("get_env.php: Missing required .env keys: " . json_encode($config));
        throw new Exception('Missing required .env keys');
    }

    echo json_encode($config);
} catch (Exception $e) {
    http_response_code(500);
    error_log("get_env.php error: " . $e->getMessage());
    echo json_encode(['status' => 'error', 'message' => 'Failed to load env: ' . $e->getMessage()]);
}

ob_end_flush();
?>