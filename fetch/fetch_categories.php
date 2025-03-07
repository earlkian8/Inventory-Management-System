<?php

    include "../db_connection.php";

    $sql = "SELECT * FROM categories";
    $result = $conn->query($sql);

    $categories = [];

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $categories[] = $row;
        }
    }

    header("Content Type: application/json");
    echo json_encode($categories);
    $conn->close();
?>