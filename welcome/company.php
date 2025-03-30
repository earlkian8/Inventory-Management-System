
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["next"])) {
    include "../api/database.php";
    include "../class/Company.php";
    $database = new Database();
    $conn = $database->getConnection();
    $company = new Company($conn);

    $name = $_POST["name"];
    $company->addCompany($name);
    echo "<script>window.location.href = 'admin.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventify</title>
    <link rel="stylesheet" href="../style/company.css">
</head>
<body>
    <div class="box-container">
        <div class="back-container">
            <img src="../images/arrow-icon-383838.png" alt="Back" id="back" class="back-style">
        </div>
        <form action="company.php" method="post" class="main-container">
            <div class="image-container">
                <img src="../images/inventify-logo-383838.png" alt="logo" class="logo-style">
            </div>
            <div class="content-container">
                <div class="text-container">
                    <h1 class="h1-style">What's the name of the company?</h1>
                    <p class="p-style">What name do you want to use?</p>
                </div>
                <div class="input-container">
                    <div class="input-label-container">
                        <label for="name" class="label-style">Name</label>
                        <input type="text" name="name" id="name" maxlength="50" required autocomplete="off">
                    </div>
                </div>
                <div class="button-container">
                    <button class="button-style" id="next" name="next">Next</button>
                </div>
            </div>
        </form>
    </div>
    <script src="../js/company.js"></script>
</body>
</html>
