<?php

include "db_connection.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventify</title>
    <link rel="stylesheet" href="/css/login-style.css">
</head>
<body>
    <div class="login-box">
        <div class="container1">
            <img src="images/inventify-logo-383838.png" alt="Inventify Logo" height="250px" >
            <h1 class="h1-style">Inventify</h1>
        </div>
        <form action="login.php" method="post" class="form-style">
            <div class="input-image-container">
                <img src="/images/user-icon-383838.png" alt="user" height="20px">
                <input type="text" class="username-input-style" placeholder="Username" id="username" name="username" maxlength="30" required>
            </div>
            <div class="input-image-container">
                <img src="/images/password-icon-383838.png" alt="password" height="20px">
                <input type="password" class="password-input-style" placeholder="Password" id="password" name="password" maxlength="255" required>
            </div>
            <button class="login-button-style" id="login" type="submit" name="login">Login</button>
            <a href="" class="a-forgotPassword-style">Forgot Password?</a>
        </form>
        
    </div>
    <script src="/js/login-error-message.js"></script>
</body>
</html>

<?php

    class Account{
        public $user;
        public $password;

        function __construct($user, $password){
            $this->user = $user;
            $this->password = $password;
        }
    }

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])){

        $acc = new Account($_POST["username"], $_POST["password"]);
        if(empty($_POST["username"]) || empty($_POST["password"])){
            die("Please input all the fields.");
        }

        $statement = $conn->prepare("SELECT password FROM Accounts WHERE username = ? AND password = ?");
        $statement->bind_param("ss", $acc->user, $acc->password);
        $statement->execute();
        $result = $statement->get_result();

        if($result->num_rows > 0){
            header("Location: dashboard.php");
            exit();
        }else{
            include "login-error-message.php";
        }
        $statement->close();
    }
        
?>