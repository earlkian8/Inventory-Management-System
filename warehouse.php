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
    <link rel="stylesheet" href="/css/warehouse-style.css">
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
                    <p class="p-side-style" style="font-family: PoppinsMedium;">Warehouse</p>
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
                    <p class="p-side-style">Categories</p>
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
        <form method="post" action="warehouse.php" class="modal-container" id="modal-container">
            <!-- Modal -->
             <div class="modal-text-container">
                <!-- Text -->
                <h1 class="h1-style">Add Warehouse</h1>
             </div>

             <div class="modal-input-container">
                <!-- Input -->
                 <div class="modal-input-subcontainer1">
                    <div id="warehouseNameContainer">
                        <label for="warehouseName" class="nameLabelStyle">Name</label>
                        <input type="text" name="warehouseName" id="warehouseName" placeholder="Name" maxlength="100" required>
                    </div>
                    <div id="warehouseMaximumStockLevelContainer">
                        <label for="maximumStockLevel" class="stockLevelLabelStyle">Maximum Stock Level</label>
                        <input type="number" name="maximumStockLevel" id="maximumStockLevel" placeholder="Maximum Stock Level" pattern="^\d{7}$" maxlength="7" required>
                    </div>
                    <div id="warehouseAddressContainer">
                        <label for="warehouserAddress" class="addressLabelStyle">Address</label>
                        <input type="text" name="warehouseAddress" id="warehouseAddress" placeholder="Address" maxlength="100" required>
                    </div>
                    <div id="warehouseManagerContainer">
                        <label for="warehouseManager" class="warehouseManagerLabelStyle">Warehouse Manager</label>
                        <input type="text" name="warehouseManager" id="warehouseManager" placeholder="Warehouse Manager" maxlength="100" required>
                    </div>
                    <div id="warehouseStatusContainer">
                        <label for="warehouseStatus" class="statusLabelStyle">Status</label>
                        <select name="warehouseStatus" id="warehouseStatus" class="select-style">
                            <option value="" class="option-style">Select Status</option>
                            <option value="Active" class="option-style">Active</option>
                            <option value="Inactive" class="option-style">Inactive</option>
                        </select>
                    </div>
                 </div>
             </div>
             <div class="modal-button-container">
                <button class="save-button-style" id="createSave" name="createSave">Save</button>
                <button class="discard-button-style" id="createDiscard" name="createDiscard">Discard</button>
             </div>
        </form>
        
        <!--Modif Modal -->
        <form method="post" action="warehouse.php" class="modif-modal-container" id="modif-modal-container">
            <!-- Modal -->
             <div class="modal-text-container">
                <!-- Text -->
                <h1 class="h1-style" id="name-content"></h1>
                <img src="/images/arrow-icon-383838.png" alt="back" class="back-img-style" id="back-content">
             </div>

             <div class="modal-input-container">
                <!-- Input -->
                 <div class="modal-input-subcontainer1">
                    <input type="hidden" name="modifWarehouseId" id="modifWarehouseId">
                    <div id="modifWarehouseNameContainer">
                        <label for="modifWarehouseName" class="nameLabelStyle">Name</label>
                        <input type="text" name="modifWarehouseName" id="modifWarehouseName" placeholder="Name" maxlength="100" required>
                    </div>
                    <div id="modifWarehouseMaximumStockLevelContainer">
                        <label for="modifMaximumStockLevel" class="stockLevelLabelStyle">Maximum Stock Level</label>
                        <input type="number" name="modifMaximumStockLevel" id="modifMaximumStockLevel" placeholder="Maximum Stock Level" pattern="^\d{7}$" maxlength="7" required>
                    </div>
                    <div id="modifWarehouseAddressContainer">
                        <label for="modifWarehouseAddress" class="addressLabelStyle">Address</label>
                        <input type="text" name="modifWarehouseAddress" id="modifWarehouseAddress" placeholder="Address" maxlength="100" required>
                    </div>
                    <div id="modifWarehouseManagerContainer">
                        <label for="modifWarehouseManager" class="warehouseManagerLabelStyle">Warehouse Manager</label>
                        <input type="text" name="modifWarehouseManager" id="modifWarehouseManager" placeholder="Warehouse Manager" maxlength="100" required>
                    </div>
                    <div id="modifWarehouseStatusContainer">
                        <label for="modifWarehouseStatus" class="statusLabelStyle">Status</label>
                        <select name="modifWarehouseStatus" id="modifWarehouseStatus" class="select-style">
                            <option value="" class="option-style">Select Status</option>
                            <option value="Active" class="option-style">Active</option>
                            <option value="Inactive" class="option-style">Inactive</option>
                        </select>
                    </div>
                 </div>
             </div>
             <div class="modal-button-container">
                <button class="save-button-style" id="modifSave" name="modifSave">Save</button>
                <button class="delete-button-style" id="modifDelete" name="modifDelete">Delete</button>
             </div>
        </form>

        <!-- Confirm Delete -->
        <form method="post" action="warehouse.php" class="confirm-delete-container" id="confirm-delete-container">
        
            <div class="delete-subcontainer">
                <div class="delete-subcontainer-sub1">
                    <h1 class="delete-h1-style">Confirm Deletion</h1>
                    <p class="delete-p-style">This will delete the account permanently. You cannot undo this action.</p>
                </div>
                <div class="delete-subcontainer-sub2">
                    <input type="hidden" name="delete-warehouseId" id="delete-warehouseId">
                    <button class="cancel-button-style" id="cancel-button-delete">Cancel</button>
                    <button class="delete-button-style" id="delete-button-submit" name="delete-button-submit">Delete</button>
                </div>
            </div>
        </form>

        <!-- Confirm Save -->
        <form method="post" action="warehouse.php" class="confirm-save-container" id="confirm-save-container">
        
            <div class="save-subcontainer">
                <div class="save-subcontainer-sub1">
                    <h1 class="save-h1-style">Save Changes</h1>
                    <p class="save-p-style">You have made changes. Do you want to discard or save them?</p>
                </div>
                <div class="save-subcontainer-sub2">
                    <input type="hidden" name="save-warehouseId" id="save-warehouseId">
                    <input type="hidden" name="save-warehouseName" id="save-warehouseName">
                    <input type="hidden" name="save-maximumStockLevel" id="save-maximumStockLevel">
                    <input type="hidden" name="save-warehouseAddress" id="save-warehouseAddress">
                    <input type="hidden" name="save-warehouseManager" id="save-warehouseManager">
                    <input type="hidden" name="save-warehouseStatus" id="save-warehouseStatus">
                    <button class="cancel-button-style" id="cancel-button-save">Cancel</button>
                    <button class="confirm-save-button-style" id="save-button-submit" name="save-button-submit" type="submit">Save</button>
                </div>
            </div>
        </form>

        <!-- Content -->
        <div class="box-style">
            <div class="content-container1">
                <input type="text" name="search" id="search" class="searchBar">
                <button class="add-button-style" id="open">Add Warehouse</button>
            </div>
            <ul class="content-container2" id="content-container2">
                <!-- JavaScript -->
                 
            </ul>
         </div>

         
    </section>
    <script src="/js/warehouse.js"></script>
</body>
</html>

<?php

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["createSave"])){

        if(empty($_POST["warehouseName"]) || empty($_POST["maximumStockLevel"]) || empty($_POST["warehouseAddress"]) || empty($_POST["warehouseManager"]) || empty($_POST["warehouseStatus"])){
            echo "<script>alert('Get Out');</script>";
        }

        $warehouseName = $_POST["warehouseName"];
        $maximumStockLevel = $_POST["maximumStockLevel"];
        $warehouseAddress = $_POST["warehouseAddress"];
        $warehouseManager = $_POST["warehouseManager"];
        $warehouseStatus = $_POST["warehouseStatus"];
        $sql = "INSERT INTO warehouse (name, max_stock_level, address, warehouse_manager, status) VALUES (?, ?, ?, ?, ?)";
        $statement = $conn->prepare($sql);
        $statement->bind_param("sisss", $warehouseName, $maximumStockLevel, $warehouseAddress, $warehouseManager, $warehouseStatus);
        $statement->execute();
        $statement->close();
    }

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete-button-submit"])){
        $warehouseId = $_POST["delete-warehouseId"];

        $sql = "DELETE FROM warehouse WHERE warehouse_id = ?";
        $statement = $conn->prepare($sql);
        $statement->bind_param("i", $warehouseId);
        $statement->execute();
        $statement->close();
    }

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["save-button-submit"])){
        $warehouseId = $_POST["save-warehouseId"];
        $warehouseName = $_POST["save-warehouseName"];
        $maximumStockLevel = $_POST["save-maximumStockLevel"];
        $warehouseAddress = $_POST["save-warehouseAddress"];
        $warehouseManager = $_POST["save-warehouseManager"];
        $warehouseStatus = $_POST["save-warehouseStatus"];

        $sql = "UPDATE warehouse SET name = ?, max_stock_level = ?, address = ?, warehouse_manager = ?, status = ? WHERE warehouse_id = ?";
        $statement = $conn->prepare($sql);
        $statement->bind_param("sisssi", $warehouseName, $maximumStockLevel, $warehouseAddress, $warehouseManager, $warehouseStatus, $warehouseId);
        $statement->execute();
        $statement->close();
    }
?>