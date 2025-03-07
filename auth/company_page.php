<?php

include "../db_connection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventify</title>
    <link rel="stylesheet" href="../css/welcome2-style.css">
</head>
<body>
    <form method="post" action="company_page.php" class="box-style">
        <div class="back-container-style">
                <!-- Back Section-->
                 <a href="welcome_page.php" class="back-a"><img src="/images/arrow-icon-383838.png" alt="back" class="back-img-style"></a>
        </div>
        <div class="image-container-style">
            <!-- Image Section -->
             <img src="/images/inventify-logo-383838.png" alt="Logo" class="logo-img-style">
             
        </div>
        <div class="input-container-style">
            <!-- Text and Input Section -->
             <div class="text-subcontainer-style">
                <!-- Text -->
                 <h1 class="h1-style">What's the name of the Company?</h1>
                 <p class="p-style">What name do you want to use?</p>
             </div>
             <div class="input-subcontainer-style">
                <!-- Input -->
                 <div class="container-input">
                    <div class="container2">
                        <p class="p-style">Enter Name</p>
                        <input type="text" name="company-input" id="company" placeholder="Name" maxlength="50" required>
                    </div>
                    <div class="container3" href="prompt_page.php">
                        <button class="button-style" name="submit_company_name">Next</button>
                    </div>
                </div>
             </div>
        </div>
        <div class="space-container-style">
            <!-- Just a space lol -->
        </div>
</form>
</body>
</html>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_company_name"])) {
    $companyName = $_POST["company-input"];

    if(empty($_POST["company-input"])){
        die("Input Company Name");
    }
    $statement = $conn->prepare("INSERT INTO company (name) VALUES (?);");
    $statement->bind_param("s", $companyName);
    $statement->execute();
    $statement->close();

    header("Location: prompt_page.php");
    exit();
}
?>