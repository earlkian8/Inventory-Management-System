<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventify</title>
    <link rel="stylesheet" href="../css/welcome4-style.css">
</head>
<body>
    <form class="box-style" method="post" action="">
        <div class="back-container-style">
            <!-- Back Section -->
            <a href="prompt_page.php"><img src="/images/arrow-icon-383838.png" alt="Back" class="back-img-style"></a>
        </div>
        <div class="img-container-style">
            <!-- Image Section -->
            <img src="/images/inventify-logo-383838.png" alt="Logo" class="logo-img-style">
        </div>
        <div class="message-container-style">
            <!-- Message Section -->
             <div class="text-container-style">
                <h1 class="h1-style">All Done!</h1>
                <p class="p-style">Inventify is all yours. Have fun!</p>
             </div>
             <div class="button-container-style">
                <button class="button-style" name="done">Finish</button>
             </div>
        </div>
        <div class="space-container-style">
            <!-- Space Section -->
        </div>
</form>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["done"])) {
    header("Location: ../index.php");
    exit();
}
?>