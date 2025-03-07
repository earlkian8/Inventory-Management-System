<?php

    include "db_connection.php";

    $suppliers = [];
    $sql = "SELECT supplier_id, name FROM suppliers";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $suppliers[] = $row;
        }
    }

    $categories = [];
    $sql = "SELECT category_id, name FROM categories";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }
    }

    $warehouses = [];
    $sql = "SELECT warehouse_id, name, storage_amount FROM warehouse";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $warehouses[] = $row;
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventify</title>
    <link rel="stylesheet" href="/css/navigation-style.css">
    <link rel="stylesheet" href="/css/items-style.css">
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
                    <p class="p-side-style">Categories</p>
                </div>
            </a>
            <a href="items.php" class="a-style">
                <div class="sub-container">
                    <img src="/images/items-icon-ffffff.png" alt="Items" class="img-style">
                    <p class="p-side-style" style="font-family: PoppinsMedium;">Items</p>
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
        <form method="post" action="items.php" class="modal-container" id="modal-container">
            <!-- Modal -->
             <div class="modal-text-container">
                <!-- Text -->
                 <h1 class="h1-style">Add Items</h1>
             </div>
             <div class="modal-input-container">
                <!-- Input -->
                 <div class="modal-input-subcontainer1">
                    <div class="modal-input-subcontainer1-sub1">
                    <input type="text" name="itemName" id="itemName" maxlength="50" placeholder="Name" required>
                        <input type="number" name="costPrice" id="costPrice" placeholder="Cost Price" step="0.01" required>
                        <input type="quantity" name="quantity" id="quantity" placeholder="Quantity" step="1" required>
                        <input type="number" name="unitPrice" id="unitPrice" placeholder="Unit Price" step="0.01" required>
                        <input type="text" name="sku" id="sku" placeholder="SKU" maxlength="30" required>
                        <input type="text" name="reorderLevel" id="reorderLevel" placeholder="Reorder Level" step="1" required>

                        <select name="itemSupplier" id="itemSupplier" class="select-style">
                            <option value="" class="option-style">Select Supplier</option>
                            <?php foreach ($suppliers as $supplier): ?>
                                <option value="<?php echo $supplier['supplier_id']; ?>"><?php echo $supplier['name']; ?></option>
                            <?php endforeach; ?>
                        </select>

                        <select name="itemCategory" id="itemCategory" class="select-style">
                            <option value="" class="option-style">Select Category</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></option>
                            <?php endforeach; ?>
                        </select>

                        <select name="itemWarehouse" id="itemWarehouse" class="select-style">
                            <option value="" class="option-style">Select Warehouse</option>
                            <?php foreach ($warehouses as $warehouse): ?>
                                <option value="<?php echo $warehouse['warehouse_id']; ?>"><?php echo $warehouse['name']; ?></option>
                            <?php endforeach; ?>
                        </select>

                        <select name="itemStatus" id="itemStatus" class="select-style">
                            <option value="" class="option-style">Select Status</option>
                            <option value="Active" class="option-style">Active</option>
                            <option value="Inactive" class="option-style">Inactive</option>
                        </select>
                    </div>
                 </div>
             </div>
             <div class="modal-button-container">
                <!-- Button -->
                 <button class="save-button-style" id="createSave" name="createSave">Save</button>
                 <button class="discard-button-style" id="createDiscard">Discard</button>
             </div>
        </form>

        <!-- Modif Modal -->
        <form method="post" action="items.php" class="modif-modal-container" id="modif-modal-container">
            <!-- Modal -->
             <div class="modal-text-container">
                <!-- Text -->
                 <h1 class="h1-style" name="name-content"></h1>
                 <img src="/images/arrow-icon-383838.png" alt="back" class="back-img-style" id="back-content">
             </div>
             <div class="modal-input-container">
                <!-- Input -->
                 <div class="modal-input-subcontainer1">
                    <div class="modal-input-subcontainer1-sub1">
                        <input type="hidden" name="modifItemId" id="modifItemId">
                        <input type="text" name="modifItemName" id="modifItemName" maxlength="50" placeholder="Name" required>
                        <input type="number" name="modifCostPrice" id="modifCostPrice" placeholder="Cost Price" step="0.01" required>
                        <input type="quantity" name="modifQuantity" id="modifQuantity" placeholder="Quantity" step="1" required>
                        <input type="number" name="modifUnitPrice" id="modifUnitPrice" placeholder="Unit Price" step="0.01" required>
                        <input type="text" name="modifSku" id="modifSku" placeholder="SKU" maxlength="30" required>
                        <input type="text" name="modifReorderLevel" id="modifReorderLevel" placeholder="Reorder Level" step="1" required>

                        <select name="modifItemSupplier" id="modifItemSupplier" class="select-style">
                            <option value="" class="option-style">Select Supplier</option>
                            <?php foreach ($suppliers as $supplier): ?>
                                <option value="<?php echo $supplier['supplier_id']; ?>"><?php echo $supplier['name']; ?></option>
                            <?php endforeach; ?>
                        </select>

                        <select name="modifItemCategory" id="modifItemCategory" class="select-style">
                            <option value="" class="option-style">Select Category</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></option>
                            <?php endforeach; ?>
                        </select>

                        <select name="modifItemWarehouse" id="modifItemWarehouse" class="select-style">
                            <option value="" class="option-style">Select Warehouse</option>
                            <?php foreach ($warehouses as $warehouse): ?>
                                <option value="<?php echo $warehouse['warehouse_id']; ?>"><?php echo $warehouse['name']; ?></option>
                            <?php endforeach; ?>
                        </select>

                        <select name="modifItemStatus" id="modifItemStatus" class="select-style">
                            <option value="" class="option-style">Select Status</option>
                            <option value="Active" class="option-style">Active</option>
                            <option value="Inactive" class="option-style">Inactive</option>
                        </select>
                    </div>
                 </div>
             </div>
             <div class="modal-button-container">
                <!-- Button -->
                 <button class="save-button-style" id="modifSave">Save</button>
                 <button class="discard-button-style" id="modifDelete">Delete</button>
             </div>
        </form>

        <!-- Confirm Delete -->
        <form method="post" action="items.php" class="confirm-delete-container" id="confirm-delete-container">
            
            <div class="delete-subcontainer">
                <div class="delete-subcontainer-sub1">
                    <h1 class="delete-h1-style">Confirm Deletion</h1>
                    <p class="delete-p-style">This will delete the account permanently. You cannot undo this action.</p>
                </div>
                <div class="delete-subcontainer-sub2">
                    
                    <button class="cancel-button-style" id="cancel-button-delete">Cancel</button>
                    <button class="delete-button-style" id="delete-button-submit" name="delete-button-submit">Delete</button>
                </div>
            </div>
        </form>

        <!-- Confirm Save -->
        <form method="post" action="items.php" class="confirm-save-container" id="confirm-save-container">
        
            <div class="save-subcontainer">
                <div class="save-subcontainer-sub1">
                    <h1 class="save-h1-style">Save Changes</h1>
                    <p class="save-p-style">You have made changes. Do you want to discard or save them?</p>
                </div>
                <div class="save-subcontainer-sub2">
                
                    <button class="cancel-button-style" id="cancel-button-save">Cancel</button>
                    <button class="confirm-save-button-style" id="save-button-submit" name="save-button-submit" type="submit">Save</button>
                </div>
            </div>
        </form>

        <!-- Content -->
        <div class="box-style">
            <div class="content-container1">
                <input type="text" name="search" id="search" class="searchBar">
                <button class="add-button-style" id="open">Add Items</button>
            </div>
            <div class="content-container2" id="content-container2">
                <!-- JavaScript -->
                 
            </div>
         </div>
        
    </section>
    <script src="/js/items.js"></script>
</body>
</html>

<?php

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["createSave"])){
        if(empty($_POST["itemName"]) || empty($_POST["costPrice"]) || empty($_POST["quantity"]) || empty($_POST["unitPrice"]) || empty($_POST["sku"]) || empty($_POST["reorderLevel"]) || empty($_POST["itemSupplier"]) || empty($_POST["itemCategory"]) || empty($_POST["itemWarehouse"]) || empty($_POST["itemStatus"])){
            echo "<script>alert('GET OUT')</script>";
        }

        $itemName  = $_POST["itemName"];
        $costPrice  = $_POST["costPrice"];
        $quantity  = $_POST["quantity"];
        $unitPrice  = $_POST["unitPrice"];
        $sku  = $_POST["sku"];
        $reorderLevel  = $_POST["reorderLevel"];
        $itemSupplier  = $_POST["itemSupplier"];
        $itemCategory  = $_POST["itemCategory"];
        $itemWarehouse  = $_POST["itemWarehouse"];
        $itemStatus  = $_POST["itemStatus"];

        $sql = "INSERT INTO items (name, costPrice, quantity, unitPrice, sku, reorderLevel, status, supplier_id, category_id, warehouse_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $statement = $conn->prepare($sql);
        $statement->bind_param("sdidsisiii", $itemName, $costPrice, $quantity, $unitPrice, $sku, $reorderLevel, $itemStatus, $itemSupplier, $itemCategory, $itemWarehouse);
        $statement->execute();
        $statement->close(); 
    }
?>