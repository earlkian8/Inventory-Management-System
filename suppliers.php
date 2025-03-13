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
    <link rel="stylesheet" href="/css/suppliers-style.css">
</head>
<body>
    <header class="header-style">
        <div class="header-container1">
            <img src="/images/burger-icon-ffffff.png" alt="Burger" class="img-style-header">
            <img src="/images/inventify-logo-ffffff.png" alt="Logo" class="img-style-header">
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
                    <p class="p-side-style" style="font-family: PoppinsMedium;">Suppliers</p>
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
        <form method="post" action="suppliers.php" class="modal-container" id="modal-container">
            
            <div class="modal-text-container">
               <!-- Text -->
                <h1 class="h1-style">Add Suppliers</h1>
            </div>
            <div class="modal-input-container">
               <!-- Input -->
                <div class="modal-input-subcontainer1">
                    <div id="supplierNameContainer">
                        <label for="supplierName" class="nameLabelStyle">Name</label>
                        <input type="text" name="supplierName" id="supplierName" maxlength="50" required placeholder="Name">
                    </div>
                    <div id="supplierEmailContainer">
                        <label for="supplierEmail" class="emailLabelStyle">Email</label>
                        <input type="text" name="supplierEmail" id="supplierEmail" maxlength="50" required placeholder="Email">
                    </div>
                    <div id="supplierContactPersonContainer">
                        <label for="supplierContactPerson" class="contactPersonLabelStyle">Contact Person</label>
                        <input type="text" name="supplierContactPerson" id="supplierContactPerson" maxlength="50" required placeholder="Contact Person">
                    </div>
                    <div id="supplierAddressContainer">
                        <label for="supplierAddress" class="addressLabelStyle">Address</label>
                        <input type="text" name="supplierAddress" id="supplierAddress" maxlength="50" required placeholder="Address">
                    </div>
                    <div id="supplierPaymentTermsContainer">
                        <label for="supplierPaymentTerms" class="paymentTermsLabelStyle">Payment Terms</label>
                        <input type="text" name="supplierPaymentTerms" id="supplierPaymentTerms" maxlength="30" required placeholder="Payment Terms">
                    </div>
                </div>
            </div>
            <div class="modal-button-container">
               <!-- Button -->
                <button class="save-button-style" id="createSave" name="createSave" type="submit">Save</button>
                <button class="discard-button-style" id="createDiscard">Discard</button>
            </div>
        </form>

        <!-- Modif Modal -->
        <form method="post" action="suppliers.php" class="modif-modal-container" id="modif-modal-container">
            
            <div class="modal-text-container">
               <!-- Text -->
                <h1 class="h1-style" id="name-content"></h1>
                <img src="/images/arrow-icon-383838.png" alt="back" class="back-img-style" id="back-content">
            </div>
            <div class="modal-input-container">
               <!-- Input -->
                <div class="modal-input-subcontainer1">
                    <input type="hidden" name="modifSupplierId" id="modifSupplierId">
                    
                    <div id="modifSupplierNameContainer">
                        <label for="modifSupplierName" class="nameLabelStyle">Name</label>
                        <input type="text" name="modifSupplierName" id="modifSupplierName" maxlength="50" required placeholder="Name">
                    </div>
                    <div id="modifSupplierEmailContainer">
                        <label for="modifSupplierEmail" class="emailLabelStyle">Email</label>
                        <input type="text" name="modifSupplierEmail" id="modifSupplierEmail" maxlength="50" required placeholder="Email">
                    </div>
                    <div id="modifSupplierContactPersonContainer">
                        <label for="modifSupplierContactPerson" class="contactPersonLabelStyle">Contact Person</label>
                        <input type="text" name="modifSupplierContactPerson" id="modifSupplierContactPerson" maxlength="50" required placeholder="Contact Person">
                    </div>
                    <div id="modifSupplierAddressContainer">
                        <label for="modifSupplierAddress" class="addressLabelStyle">Address</label>
                        <input type="text" name="modifSupplierAddress" id="modifSupplierAddress" maxlength="50" required placeholder="Address">
                    </div>
                    <div id="modifSupplierPaymentTermsContainer">
                        <label for="modifSupplierPaymentTerms" class="paymentTermsLabelStyle">Payment Terms</label>
                        <input type="text" name="modifSupplierPaymentTerms" id="modifSupplierPaymentTerms" maxlength="30" required placeholder="Payment Terms">
                    </div>
                </div>
            </div>
            <div class="modal-button-container">
               <!-- Button -->
                <button class="save-button-style" id="modifSave">Save</button>
                <button class="delete-button-style" id="modifDelete">Delete</button>
            </div>
        </form>

        <!-- Confirm Delete -->
        <form method="post" action="suppliers.php" class="confirm-delete-container" id="confirm-delete-container">
        
            <div class="delete-subcontainer">
                <div class="delete-subcontainer-sub1">
                    <h1 class="delete-h1-style">Confirm Deletion</h1>
                    <p class="delete-p-style">This will delete the account permanently. You cannot undo this action.</p>
                </div>
                <div class="delete-subcontainer-sub2">
                    <input type="hidden" name="delete-supplierId" id="delete-supplierId">
                    <button class="cancel-button-style" id="cancel-button-delete">Cancel</button>
                    <button class="delete-button-style" id="delete-button-submit" name="delete-button-submit">Delete</button>
                </div>
            </div>
        </form>

        <!-- Confirm Save -->
        <form method="post" action="suppliers.php" class="confirm-save-container" id="confirm-save-container">
        
            <div class="save-subcontainer">
                <div class="save-subcontainer-sub1">
                    <h1 class="save-h1-style">Save Changes</h1>
                    <p class="save-p-style">You have made changes. Do you want to discard or save them?</p>
                </div>
                <div class="save-subcontainer-sub2">
                    <input type="hidden" name="save-supplierId" id="save-supplierId">
                    <input type="hidden" name="save-supplierName" id="save-supplierName">
                    <input type="hidden" name="save-supplierEmail" id="save-supplierEmail">
                    <input type="hidden" name="save-supplierContactPerson" id="save-supplierContactPerson">
                    <input type="hidden" name="save-supplierAddress" id="save-supplierAddress">
                    <input type="hidden" name="save-supplierPaymentTerms" id="save-supplierPaymentTerms">
                    <button class="cancel-button-style" id="cancel-button-save">Cancel</button>
                    <button class="confirm-save-button-style" id="save-button-submit" name="save-button-submit" type="submit">Save</button>
                </div>
            </div>
        </form>

        <!-- Content -->
        <div class="box-style">
            <div class="content-container1">
                <input type="text" name="search" id="search" class="searchBar">
                <button class="add-button-style" id="open">Add Suppliers</button>
            </div>
            <div class="content-container2" id="content-container2">
                <!-- JavaScript -->
                 
            </div>
         </div>

         
    </section>
    <script src="/js/suppliers.js"></script>
</body>
</html>

<?php

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["createSave"])){
        if(empty($_POST["supplierName"]) || empty($_POST["supplierEmail"]) || empty($_POST["supplierContactPerson"]) || empty($_POST["supplierAddress"]) || empty($_POST["supplierPaymentTerms"])){
            echo "<script>alert('Get Out');</script>";
        }

        $supplierName = $_POST["supplierName"];
        $supplierEmail = $_POST["supplierEmail"];
        $supplierContactPerson = $_POST["supplierContactPerson"];
        $supplierAddress = $_POST["supplierAddress"];
        $supplierPaymentTerms = $_POST["supplierPaymentTerms"];

        $sql = "INSERT INTO suppliers (name, email, contact_person, address, payment_terms) VALUES (?, ?, ?, ?, ?)";
        $statement = $conn->prepare($sql);
        $statement->bind_param("sssss", $supplierName, $supplierEmail, $supplierContactPerson, $supplierAddress, $supplierPaymentTerms);
        $statement->execute();
        $statement->close();
    }
?>

<?php

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["save-button-submit"])){
        
        $supplierId = $_POST["save-supplierId"];
        $supplierName = $_POST["save-supplierName"];
        $supplierEmail = $_POST["save-supplierEmail"];
        $supplierContactPerson = $_POST["save-supplierContactPerson"];
        $supplierAddress = $_POST["save-supplierAddress"];
        $supplierPaymentTerms = $_POST["save-supplierPaymentTerms"];

        $sql = "UPDATE suppliers SET name = ?, email = ?, contact_person = ?, address = ?, payment_terms = ? WHERE supplier_id = ?";
        $statement = $conn->prepare($sql);
        $statement->bind_param("sssssi", $supplierName, $supplierEmail, $supplierContactPerson, $supplierAddress, $supplierPaymentTerms, $supplierId);
        $statement->execute();
        $statement->close();
    }
?>

<?php

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete-button-submit"])){
        
        $supplierId = $_POST["delete-supplierId"];

        $sql = "DELETE FROM suppliers WHERE supplier_id = ?";
        $statement = $conn->prepare($sql);
        $statement->bind_param("i", $supplierId);
        $statement->execute();
        $statement->close();
    }
?>