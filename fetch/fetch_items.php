<?php

    include "../db_connection.php";

    $sql = "SELECT * FROM items";

    $result = $conn->query($sql);

    $items = [];

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $items[] = $row;
        }
    }

    header("Content Type: application/json");

    echo json_encode($items);
    $conn->close();
?>
