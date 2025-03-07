<?php
include "../db_connection.php";

$sql = "SELECT * FROM accounts";
$result = $conn->query($sql);

$accounts = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $accounts[] = $row;
    }
}

header('Content-Type: application/json');

echo json_encode($accounts);

$conn->close();
?>