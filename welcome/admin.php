<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["create"])) {
        include "../api/database.php";
        include "../class/Accounts.php";
        
        $database = new Database();
        $conn = $database->getConnection();
        $acc = new Accounts($conn);

        $firstName = $_POST["firstName"];
        $middleName = $_POST["middleName"];
        $lastName = $_POST["lastName"];
        $email = $_POST["email"];
        $address = $_POST["address"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $gender = $_POST["gender"];
        $dateOfBirth = $_POST["dateOfBirth"];
        $acc->addAccount($firstName, $middleName, $lastName, $email, $address, $username, $password, $gender, "Admin", $dateOfBirth);
        echo "<script>window.location.href = 'done.php';</script>";
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventify</title>
    <link rel="stylesheet" href="../style/admin.css">
</head>
<body>
    <div class="box-container">
        <div class="back-container">
            <img src="../images/arrow-icon-383838.png" alt="Back" id="back" class="back-style">
        </div>
        <div class="main-container">
            <div class="image-container">
                <img src="../images/inventify-logo-383838.png" alt="logo" class="logo-style">
            </div>
            <form action="admin.php" method="post" class="content-container">
                <div class="text-container">
                    <h1 class="h1-style">Who’s going to use Inventify?</h1>
                    <p class="p-style">You’ll use this account to sign in to Inventify.</p>
                </div>
                <div class="input-container">
                    <div class="input-subcontainer1">
                        <div class="input-label-container1">
                            <label for="firstName" class="label-style">First Name</label>
                            <input type="text" name="firstName" id="firstName" maxlength="50" required autocomplete="off">
                        </div>
                        <div class="input-label-container1">
                            <label for="middleName" class="label-style">Middle Name</label>
                            <input type="text" name="middleName" id="middleName" maxlength="50" autocomplete="off">
                        </div>
                        <div class="input-label-container1">
                            <label for="lastName" class="label-style">Last Name</label>
                            <input type="text" name="lastName" id="lastName" maxlength="50" required autocomplete="off">
                        </div>
                    </div>
                    <div class="input-subcontainer2">
                        <div class="input-label-container2">
                            <label for="email" class="label-style">Email</label>
                            <input type="email" name="email" id="email" maxlength="150" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" required autocomplete="off">
                        </div>
                        <div class="input-label-container2">
                            <label for="username" class="label-style">Username</label>
                            <input type="text" name="username" id="username" maxlength="30" required autocomplete="off">
                        </div>
                        <div class="input-label-container2">
                            <label for="address" class="label-style">Address</label>
                            <input type="text" name="address" id="address" maxlength="100" required autocomplete="off">
                        </div>
                        <div class="input-label-container2">
                            <label for="password" class="label-style">Password</label>
                            <input type="password" name="password" id="password" maxlength="255" required autocomplete="off">
                        </div>
                        <div class="input-label-container2">
                            <label for="gender" class="label-style">Gender</label>
                            <select name="gender" id="gender" class="select-style">
                                <option value="" class="option-style">Select One</option>
                                <option value="Male" class="option-style">Male</option>
                                <option value="Female" class="option-style">Female</option>
                            </select>
                        </div>
                        <div class="input-label-container2">
                            <label for="dateOfBirth" class="label-style">Date of Birth</label>
                            <input type="date" name="dateOfBirth" id="dateOfBirth">
                        </div>
                    </div>
                </div>
                <div class="button-container">
                    <button class="button-style" id="create" name="create" >Create</button>
                </div>
            </form>
        </div>
    </div>
    <script src="../js/admin.js"></script>
</body>
</html>

