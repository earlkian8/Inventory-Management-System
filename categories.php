<?php

    include "db_connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventify</title>
    <link rel="stylesheet" href="/css/navigation-style.css">
    <link rel="stylesheet" href="/css/categories-style.css">
</head>
<body>
    <header class="header-style">
        <div class="header-container1">
            <div class="header-container2">
                <img src="/images/burger-icon-ffffff.png" alt="Burger" class="img-style-header">
                <img src="/images/inventify-logo-ffffff.png" alt="Logo" class="img-style-header">
            </div>
            <div class="header-container3">
                <img src="/images/notification-icon-ffffff.png" alt="Notification" class="img-style-header">
                <a href="index.php"><img src="/images/logout-icon-ffffff.png" alt="Logout" class="img-style-header"></a>
            </div>

        </div>
    </header>
    <aside class="aside-style">
        <div class="container1">
            <a href="dashboard.php" class="a-style">
                <div class="sub-container">
                    <img src="/images/dashboard-icon-ffffff.png" alt="Dashboard" class="img-style">
                    <p class="p-side-style">Dashboard</p>
                </div>
            </a>
            <a href="accounts.php" class="a-style">
                <div class="sub-container">
                    <img src="/images/account-icon-ffffff.png" alt="Account" class="img-style">
                    <p class="p-side-style">Accounts</p>
                </div>
            </a>
            <a href="warehouse.php" class="a-style">
                <div class="sub-container">
                    <img src="/images/warehouse-icon-ffffff.png" alt="Warehouse" class="img-style">
                    <p class="p-side-style">Warehouse</p>
                </div>
            </a>
            <a href="suppliers.php" class="a-style">
                <div class="sub-container">
                    <img src="/images/suppliers-icon-ffffff.png" alt="Suppliers" class="img-style">
                    <p class="p-side-style">Suppliers</p>
                </div>
            </a>
            <a href="categories.php" class="a-style" >
                <div class="sub-container">
                    <img src="/images/categories-icon-ffffff.png" alt="Categories" class="img-style">
                    <p class="p-side-style" style="font-family: PoppinsMedium;">Categories</p>
                </div>
            </a>
            <a href="items.php" class="a-style">
                <div class="sub-container">
                    <img src="/images/items-icon-ffffff.png" alt="Items" class="img-style">
                    <p class="p-side-style">Items</p>
                </div>
            </a>
            <a href="report.php" class="a-style">
                <div class="sub-container">
                    <img src="/images/report-icon-ffffff.png" alt="Report" class="img-style">
                    <p class="p-side-style">Report</p>
                </div>
            </a>
        </div>
    </aside>

    <section class="section-style">

    <!-- Create Modal -->
        <form method="post" action="categories.php" class="modal-container" id="modal-container">
            <!-- Modal -->
             <div class="modal-text-container">
                <!-- Text -->
                 <h1 class="h1-style">Add Category</h1>
             </div>
             <div class="modal-input-container">
                <!-- Input -->
                 <div class="modal-input-subcontainer1">
                    <input type="text" name="categoryName" id="categoryName" maxlength="50" required placeholder="Name">
                    <textarea name="categoryDescription" id="categoryDescription" placeholder="Description"></textarea>
                 </div>
             </div>
             <div class="modal-button-container">
                <!-- Button -->
                 <button class="save-button-style" id="createSave" name="createSave">Save</button>
                 <button class="discard-button-style" id="createDiscard">Discard</button>
             </div>
    </form>
    
        <!-- Modif Modal -->
        <form method="post" action="categories.php" class="modif-modal-container" id="modif-modal-container">
                <!-- Modal -->
                <div class="modal-text-container">
                    <!-- Text -->
                    <h1 class="h1-style" id="name-content"></h1>
                    <img src="/images/arrow-icon-383838.png" alt="back" class="back-img-style" id="back-content">
                </div>
                <div class="modal-input-container">
                    <!-- Input -->
                    <div class="modal-input-subcontainer1">
                        <input type="hidden" name="modifCategoryId" id="modifCategoryId">
                        <input type="text" name="modifCategoryName" id="modifCategoryName" maxlength="50" required placeholder="Name">
                        <textarea name="modifCategoryDescription" id="modifCategoryDescription" placeholder="Description"></textarea>
                    </div>
                </div>
                <div class="modal-button-container">
                    <!-- Button -->
                    <button class="save-button-style" id="modifSave" name="modifSave">Save</button>
                    <button class="delete-button-style" id="modifDelete">Delete</button>
                </div>
        </form>

        <!-- Confirm Delete -->
        <form method="post" action="categories.php" class="confirm-delete-container" id="confirm-delete-container">
            
            <div class="delete-subcontainer">
                <div class="delete-subcontainer-sub1">
                    <h1 class="delete-h1-style">Confirm Deletion</h1>
                    <p class="delete-p-style">This will delete the account permanently. You cannot undo this action.</p>
                </div>
                <div class="delete-subcontainer-sub2">
                    <input type="hidden" name="delete-categoryId" id="delete-categoryId">
                    <button class="cancel-button-style" id="cancel-button-delete">Cancel</button>
                    <button class="delete-button-style" id="delete-button-submit" name="delete-button-submit">Delete</button>
                </div>
            </div>
        </form>

        <!-- Confirm Save -->
        <form method="post" action="categories.php" class="confirm-save-container" id="confirm-save-container">
        
            <div class="save-subcontainer">
                <div class="save-subcontainer-sub1">
                    <h1 class="save-h1-style">Save Changes</h1>
                    <p class="save-p-style">You have made changes. Do you want to discard or save them?</p>
                </div>
                <div class="save-subcontainer-sub2">
                    <input type="hidden" name="save-categoryId" id="save-categoryId">
                    <input type="hidden" name="save-categoryName" id="save-categoryName">
                    <input type="hidden" name="save-categoryDescription" id="save-categoryDescription">
                    <button class="cancel-button-style" id="cancel-button-save">Cancel</button>
                    <button class="confirm-save-button-style" id="save-button-submit" name="save-button-submit" type="submit">Save</button>
                </div>
            </div>
        </form>

        <!-- Content -->
        <div class="box-style">
            <div class="content-container1">
                <input type="text" name="search" id="search" class="searchBar">
                <button class="add-button-style" id="open">Add Categories</button>
            </div>
            <div class="content-container2" id="content-container2">
                <!-- JavaScript -->
                 
            </div>
         </div>
         
    </section>
    <script src="/js/categories.js"></script>
</body>
</html>

<?php

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["createSave"])){

        if(empty($_POST["categoryName"])){
            echo "<script>alert('Get Out');</script>";
        }
        $categoryName = $_POST["categoryName"];
        $categoryDescription = $_POST["categoryDescription"];

        $sql = "INSERT INTO categories (name, description) VALUES (?, ?)";
        $statement = $conn->prepare($sql);
        $statement->bind_param("ss", $categoryName, $categoryDescription);
        $statement->execute();
        $statement->close();
    }
?>

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["save-button-submit"])){
        $categoryId = $_POST["save-categoryId"];
        $categoryName = $_POST["save-categoryName"];
        $categoryDescription = $_POST["save-categoryDescription"];

        $sql = "UPDATE categories SET name = ?, description = ? WHERE category_id = ?";
        $statement = $conn->prepare($sql);
        $statement->bind_param("ssi", $categoryName, $categoryDescription, $categoryId);
        $statement->execute();
        $statement->close();
    }
?>

<?php

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete-button-submit"])){
        $categoryId = $_POST["delete-categoryId"];
        
        $sql = "DELETE FROM categories WHERE category_id = ?";
        $statement = $conn->prepare($sql);
        $statement->bind_param("i", $categoryId);
        $statement->execute();
        $statement->close();
    }
?>