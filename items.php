<?php
    include "api/database.php";
    include "class/Items.php";
    include "class/Categories.php";
    include "class/Suppliers.php";

    $database = new Database();
    $db = $database->getConnection();

    $items = new Items($db);
    $suppliers = new Suppliers($db);
    $categories = new Categories($db);
    
    $allSuppliers = $suppliers->getAllSuppliers();
    $allCategories = $categories->getAllCategories();

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["create"])){
        $name = $_POST["name"];
        $costPrice = $_POST["costPrice"];
        $quantity = $_POST["quantity"];
        $unitPrice = $_POST["unitPrice"];
        $sku = $_POST["sku"];
        $reorderLevel = $_POST["reorderLevel"];
        $status = $_POST["status"];
        $supplierId = $_POST["supplier"];
        $categoryId = $_POST["category"];

        $items->addItem($name, $costPrice, $quantity, $unitPrice, $sku, $reorderLevel, $status, $supplierId, $categoryId);
    }

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["save-button-submit"])){
        $id = $_POST["saveItemId"];
        $name = $_POST["saveName"];
        $costPrice = $_POST["saveCostPrice"];
        $quantity = $_POST["saveQuantity"];
        $unitPrice = $_POST["saveUnitPrice"];
        $sku = $_POST["saveSku"];
        $reorderLevel = $_POST["saveReorderLevel"];
        $status = $_POST["saveStatus"];
        $supplier = $_POST["saveSupplier"];
        $category = $_POST["saveCategory"];
        $items->updateItem($id, $name, $costPrice, $quantity, $unitPrice, $sku, $reorderLevel, $status, $supplier, $category);
    }
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete-button-submit"])){
        $id = $_POST["deleteItemId"];

        $items->deleteItem($id);
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventify</title>
    <link rel="stylesheet" href="style/items.css">
</head>
<body>
    <div class="header-container">
        <h1 class="company-name" id="company-name"></h1>
        <img src="images/inventify-logo-ffffff.png" alt="logo" class="icon-style">
        <div class="icon-container">
            <img src="images/notification-icon-ffffff.png" alt="Notification" class="icon-style-con" id="notificationIcon">
            <div class="notification-container" id="notificationContainer">
                <div class="notification-header">
                    <h3>Notifications</h3>
                </div>
                <div class="notification-content" id="notificationContent">
                </div>
            </div>
            <img src="images/logout-icon-ffffff.png" alt="Logout" class="icon-style-con" id="logoutId">
        </div>
    </div>
    <div class="side-container">
        <div class="navigation-container" id="dashboard-nav">
            <img src="images/dashboard-icon-ffffff.png" alt="Dashboard" class="logo-style">
            <h1 class="h1-style">DASHBOARD</h1>
        </div>
        <div class="navigation-container" id="accounts-nav">
            <img src="images/account-icon-ffffff.png" alt="Accounts" class="logo-style">
            <h1 class="h1-style">ACCOUNTS</h1>
        </div>
        <div class="navigation-container" id="categories-nav">
            <img src="images/categories-icon-ffffff.png" alt="Categories" class="logo-style">
            <h1 class="h1-style">CATEGORIES</h1>
        </div>
        <div class="navigation-container" id="suppliers-nav">
            <img src="images/suppliers-icon-ffffff.png" alt="Suppliers" class="logo-style">
            <h1 class="h1-style">SUPPLIERS</h1>
        </div>
        <div class="navigation-container active" id="items-nav">
            <img src="images/items-icon-ffffff.png" alt="Items" class="logo-style">
            <h1 class="h1-style">ITEMS</h1>
        </div>
        <div class="navigation-container" id="report-nav">
            <img src="images/report-icon-ffffff.png" alt="Report" class="logo-style">
            <h1 class="h1-style">REPORT</h1>
        </div>
        <div class="space">
            
        </div>
    </div>

    <!-- Content -->
    <div class="content-container">
        <div class="overlay" id="overlay"></div> <!-- Overlay -->
        <!-- Create Modal -->
        <form method="post" action="items.php" class="modal-container" id="modal-container">
            <div class="text-container">
                <h1 class="modal-h1-style">Create Item</h1>
            </div>
            <div class="input-container">
                <div class="input-label-container">
                    <label for="name" class="label-style">Name</label>
                    <input type="text" name="name" id="name" maxlength="50" required autocomplete="off">
                </div>
                <div class="input-label-container">
                    <label for="quantity" class="label-style">Quantity</label>
                    <input type="number" name="quantity" id="quantity" required pattern="^\d+$" autocomplete="off">
                </div>
                <div class="input-label-container">
                    <label for="costPrice" class="label-style">Cost Price</label>
                    <input type="number" name="costPrice" id="costPrice" pattern="^\d+(\.\d+)?$" required autocomplete="off">
                </div>
                <div class="input-label-container">
                    <label for="unitPrice" class="label-style">Unit Price</label>
                    <input type="number" name="unitPrice" id="unitPrice" pattern="^\d+(\.\d+)?$" required autocomplete="off">
                </div>
                <div class="input-label-container">
                    <label for="sku" class="label-style">SKU</label>
                    <input type="text" name="sku" id="sku" maxlength="30" required autocomplete="off">
                </div>
                <div class="input-label-container">
                    <label for="reorderLevel" class="label-style">Reorder Level</label>
                    <input type="number" name="reorderLevel" id="reorderLevel" pattern="^\d+$" required autocomplete="off">
                </div>
                <div class="input-label-container">
                    <label for="supplier" class="label-style">Supplier</label>
                    <select name="supplier" id="supplier" class="select-style">
                        <option value="" class="option-style">Select One</option>
                        <?php foreach ($allSuppliers as $supplier): ?>
                            <option value="<?php echo htmlspecialchars($supplier['supplier_id']); ?>" class="option-style">
                                <?php echo htmlspecialchars($supplier['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="input-label-container">
                    <label for="category" class="label-style">Category</label>
                    <select name="category" id="category" class="select-style">
                        <option value="" class="option-style">Select One</option>
                        <?php foreach ($allCategories as $category): ?>
                            <option value="<?php echo htmlspecialchars($category['category_id']); ?>" class="option-style">
                                <?php echo htmlspecialchars($category['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="input-label-container">
                    <label for="status" class="label-style">Status</label>
                    <select name="status" id="status" class="select-style">
                        <option value="" class="option-style">Select One</option>
                        <option value="Active" class="option-style">Active</option>
                        <option value="Inactive" class="option-style">Inactive</option>
                    </select>
                </div>
            </div>
            <div class="button-container">
                <button class="create-button-style" id="create" name="create">Create</button>
                <button class="discard-button-style" id="discard">Discard</button>
            </div>
        </form>

        <!-- Modify Modal -->
        <form method="post" action="items.php" class="modif-modal-container" id="modif-modal-container">
            <div class="text-container">
                <h1 class="modal-h1-style">Edit Item</h1>
                <img src="images/arrow-icon-383838.png" alt="back" class="back-style" id="back">
            </div>
            <div class="input-container">
            <div class="input-label-container">
                    <label for="modifName" class="label-style">Name</label>
                    <input type="text" name="modifName" id="modifName" maxlength="50" required autocomplete="off">
                </div>
                <div class="input-label-container">
                    <label for="modifQuantity" class="label-style">Quantity</label>
                    <input type="number" name="modifQuantity" id="modifQuantity" required pattern="^\d+$" autocomplete="off">
                </div>
                <div class="input-label-container">
                    <label for="modifCostPrice" class="label-style">Cost Price</label>
                    <input type="number" name="modifCostPrice" id="modifCostPrice" pattern="^\d+(\.\d+)?$" required autocomplete="off">
                </div>
                <div class="input-label-container">
                    <label for="modifUnitPrice" class="label-style">Unit Price</label>
                    <input type="number" name="modifUnitPrice" id="modifUnitPrice" pattern="^\d+(\.\d+)?$" required autocomplete="off">
                </div>
                <div class="input-label-container">
                    <label for="modifSku" class="label-style">SKU</label>
                    <input type="text" name="modifSku" id="modifSku" maxlength="30" required autocomplete="off">
                </div>
                <div class="input-label-container">
                    <label for="modifReorderLevel" class="label-style">Reorder Level</label>
                    <input type="number" name="modifReorderLevel" id="modifReorderLevel" pattern="^\d+$" required autocomplete="off">
                </div>
                <div class="input-label-container">
                    <label for="modifSupplier" class="label-style">Supplier</label>
                    <select name="modifSupplier" id="modifSupplier" class="select-style">
                        <option value="" disabled selected>Select One</option>
                        <?php foreach ($allSuppliers as $supplier): ?>
                            <option value="<?php echo htmlspecialchars($supplier['supplier_id']); ?>" class="option-style">
                                <?php echo htmlspecialchars($supplier['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="input-label-container">
                    <label for="modifCategory" class="label-style">Category</label>
                    <select name="modifCategory" id="modifCategory" class="select-style">
                        <option value="" disabled selected>Select One</option>
                        <?php foreach ($allCategories as $category): ?>
                            <option value="<?php echo htmlspecialchars($category['category_id']); ?>" class="option-style">
                                <?php echo htmlspecialchars($category['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="input-label-container">
                    <label for="modifStatus" class="label-style">Status</label>
                    <select name="modifStatus" id="modifStatus" class="select-style">
                        <option value="" disabled selected>Select One</option>
                        <option value="Active" class="option-style">Active</option>
                        <option value="Inactive" class="option-style">Inactive</option>
                    </select>
                </div>
            </div>
            <div class="button-container">
                <button class="save-button-style" id="save">Save</button>
                <button class="delete-button-style" id="delete">Delete</button>
            </div>
        </form>

        <!-- Confirm Delete -->
        <form method="post" action="items.php" class="confirm-delete-container" id="confirm-delete-container">
        
            <div class="delete-subcontainer">
                <div class="delete-subcontainer-sub1">
                    <h1 class="delete-h1-style">Confirm Deletion</h1>
                    <p class="delete-p-style">This will delete the item permanently. You cannot undo this action.</p>
                </div>
                <div class="delete-subcontainer-sub2">
                    <input type="hidden" name="deleteItemId" id="deleteItemId">
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
                    <input type="hidden" name="saveItemId" id="saveItemId">
                    <input type="hidden" name="saveName" id="saveName">
                    <input type="hidden" name="saveCostPrice" id="saveCostPrice">
                    <input type="hidden" name="saveQuantity" id="saveQuantity">
                    <input type="hidden" name="saveUnitPrice" id="saveUnitPrice">
                    <input type="hidden" name="saveSku" id="saveSku">
                    <input type="hidden" name="saveReorderLevel" id="saveReorderLevel">
                    <input type="hidden" name="saveStatus" id="saveStatus">
                    <input type="hidden" name="saveSupplier" id="saveSupplier">
                    <input type="hidden" name="saveCategory" id="saveCategory">
                    <button class="cancel-button-style" id="cancel-button-save">Cancel</button>
                    <button class="confirm-save-button-style" id="save-button-submit" name="save-button-submit" type="submit">Save</button>
                </div>
            </div>
        </form>

        <div class="box-container">
            <div class="box-subcontainer1">
                <input type="text" name="search" id="search" placeholder="Search" class="search-style" oninput="searchItems()" autocomplete="off"> 
                <button class="add-button-style" id="add">Create Items</button>
            </div>
            <div class="box-subcontainer2">
                <table class="table-style">
                    <thead>
                        <tr class="tr-head-style">
                            <th class="th-style" id="nameTh">Name</th>
                            <th class="th-style" id="costPriceTh">Cost Price</th>
                            <th class="th-style" id="unitPriceTh">Unit Price</th>
                            <th class="th-style" id="quantityTh">Quantity</th>
                            <th class="th-style" id="supplierTh">Supplier</th>
                            <th class="th-style" id="categoryTh">Category</th>
                            <th class="th-style" id="statusTh">Status</th>
                        </tr>
                    </thead>
                    <tbody id="content">
                        <!-- JS -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="js/items.js"></script>
    <script src="js/company-name.js"></script>
    <script>
        document.getElementById("logoutId").addEventListener("click", function(){
            window.location.href = "login.php"
        });
    </script>
</body>
</html>