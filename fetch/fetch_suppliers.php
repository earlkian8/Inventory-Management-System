<?php

    include "../db_connection.php";

    $sql = "SELECT * FROM suppliers";
    $result = $conn->query($sql);

    $suppliers = [];
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $suppliers[] = $row;
        }   
    }

    header("Content Type: application/json");
    echo json_encode($suppliers);
    $conn->close();
?>