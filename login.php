<?php

    include "api/database.php";
    include "class/Accounts.php";
    
    $database = new Database();
    $conn = $database->getConnection();

    $acc = new Accounts($conn);

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])){
        $username = $_POST["username"];
        $password = $_POST["password"];
        
        $result = $acc->login($username, $password);
        
        if($result){
            
            if($result["account_type"] == "Admin"){
                header("Location: dashboard.php");
                exit();
            }else{
                header("Location: pos.php");
            }
        }else{
            echo "<script>console.log('invalid');</script>";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventify</title>
    <link rel="stylesheet" href="style/login.css">
</head>
<body>
    <div class="box-container">
        <div class="image-container">
            <img src="images/inventify-logo-383838.png" alt="Logo" class="logo-style">
        </div>
        <div class="title-container">
            <h1 class="h1-style">Inventify</h1>
        </div>
        <form method="post" action="login.php" class="input-container">
            <div class="input-subcontainer1">
                <div class="input-label-container">
                    <label for="username" class="label-style">Username</label>
                    <input type="text" name="username" id="username" maxlength="30" required autocomplete="off">
                </div>
                <div class="input-label-container">
                    <label for="password" class="label-style">Password</label>
                    <input type="password" name="password" id="password" maxlength="255" required autocomplete="off">
                </div>

                <button class="button-style" name="login">Login</button>
            </div>
            <div class="input-subcontainer2">
                <a href="" class="a-style">Forgot your password?</a>
            </div>  
        </form>
    </div>
</body>
</html>