<?php

include "../db_connection.php";

$sql = "SELECT * FROM warehouse";
$result = $conn->query($sql);

$warehouses = [];

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $warehouses[] = $row;
    }
}

header("Content Type: application/json");
echo json_encode($warehouses);

$conn->close();
?>