<?php
    include "api/database.php";
    include "class/Suppliers.php";

    $database = new Database();
    $db = $database->getConnection();

    $supplier = new Suppliers($db);

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["create"])){
        $name = $_POST["name"];
        $email = $_POST["email"];
        $contactPerson = $_POST["contactPerson"];
        $address = $_POST["address"];
        $paymentTerms = $_POST["paymentTerms"];

        $supplier->addSupplier($name, $email, $contactPerson, $address, $paymentTerms);
    }

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["save-button-submit"])){
        $id = $_POST["saveSupplierId"];
        $name = $_POST["saveName"];
        $email = $_POST["saveEmail"];
        $contactPerson = $_POST["saveContactPerson"];
        $address = $_POST["saveAddress"];
        $paymentTerms = $_POST["savePaymentTerms"];

        $supplier->updateSupplier($id, $name, $email, $contactPerson, $address, $paymentTerms);
    }

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete-button-submit"])){
        $id = $_POST["deleteSupplierId"];

        $supplier->deleteSupplier($id);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventify</title>
    <link rel="stylesheet" href="style/suppliers.css">
</head>
<body>
    <div class="header-container">
        <h1 class="company-name" id="company-name"></h1>
        <img src="images/inventify-logo-ffffff.png" alt="logo" class="icon-style">
        <div class="icon-container">
            <img src="images/notification-icon-ffffff.png" alt="Notification" class="icon-style-con">
            <img src="images/logout-icon-ffffff.png" alt="Logout" class="icon-style-con">
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
        <div class="navigation-container active" id="suppliers-nav">
            <img src="images/suppliers-icon-ffffff.png" alt="Suppliers" class="logo-style">
            <h1 class="h1-style">SUPPLIERS</h1>
        </div>
        <div class="navigation-container" id="items-nav">
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
        <form method="post" action="suppliers.php" class="modal-container" id="modal-container">
            <div class="text-container">
                <h1 class="modal-h1-style">Create Supplier</h1>
            </div>
            <div class="input-container">
                <div class="input-label-container">
                    <label for="name" class="label-style">Name</label>
                    <input type="text" name="name" id="name" maxlength="50" required autocomplete="off">
                </div>
                <div class="input-label-container">
                    <label for="email" class="label-style">Email</label>
                    <input type="email" name="email" id="email" maxlength="150" required autocomplete="off">
                </div>
                <div class="input-label-container">
                    <label for="contactPerson" class="label-style">Contact Person</label>
                    <input type="text" name="contactPerson" id="contactPerson" maxlength="50" required autocomplete="off">
                </div>
                <div class="input-label-container">
                    <label for="address" class="label-style">Address</label>
                    <input type="text" name="address" id="address" maxlength="150" required autocomplete="off">
                </div>
                <div class="input-label-container">
                    <label for="paymentTerms" class="label-style">Payment Terms</label>
                    <input type="text" name="paymentTerms" id="paymentTerms" maxlength="30" required autocomplete="off">
                </div>
            </div>
            <div class="button-container">
                <button class="create-button-style" id="create" name="create">Create</button>
                <button class="discard-button-style" id="discard">Discard</button>
            </div>
        </form>

        <!-- Modify Modal -->
        <form method="post" action="suppliers.php" class="modif-modal-container" id="modif-modal-container">
            <div class="text-container">
                <h1 class="modal-h1-style">Edit Supplier</h1>
                <img src="images/arrow-icon-383838.png" alt="back" class="back-style" id="back">
            </div>
            <div class="input-container">
                <div class="input-label-container">
                    <label for="modifName" class="label-style">Name</label>
                    <input type="text" name="modifName" id="modifName" maxlength="50" required autocomplete="off">
                </div>
                <div class="input-label-container">
                    <label for="modifEmail" class="label-style">Email</label>
                    <input type="email" name="modifEmail" id="modifEmail" maxlength="150" required autocomplete="off">
                </div>
                <div class="input-label-container">
                    <label for="modifContactPerson" class="label-style">Contact Person</label>
                    <input type="text" name="modifContactPerson" id="modifContactPerson" maxlength="50" required autocomplete="off">
                </div>
                <div class="input-label-container">
                    <label for="modifAddress" class="label-style">Address</label>
                    <input type="text" name="modifAddress" id="modifAddress" maxlength="150" required autocomplete="off">
                </div>
                <div class="input-label-container">
                    <label for="modifPaymentTerms" class="label-style">Payment Terms</label>
                    <input type="text" name="modifPaymentTerms" id="modifPaymentTerms" maxlength="30" required autocomplete="off">
                </div>
            </div>
            <div class="button-container">
                <button class="save-button-style" id="save">Save</button>
                <button class="delete-button-style" id="delete">Delete</button>
            </div>
        </form>

        <!-- Confirm Delete -->
        <form method="post" action="suppliers.php" class="confirm-delete-container" id="confirm-delete-container">
        
            <div class="delete-subcontainer">
                <div class="delete-subcontainer-sub1">
                    <h1 class="delete-h1-style">Confirm Deletion</h1>
                    <p class="delete-p-style">This will delete the supplier permanently. You cannot undo this action.</p>
                </div>
                <div class="delete-subcontainer-sub2">
                    <input type="text" name="deleteSupplierId" id="deleteSupplierId">
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
                    <input type="hidden" name="saveSupplierId" id="saveSupplierId">
                    <input type="hidden" name="saveName" id="saveName">
                    <input type="hidden" name="saveEmail" id="saveEmail">
                    <input type="hidden" name="saveContactPerson" id="saveContactPerson">
                    <input type="hidden" name="saveAddress" id="saveAddress">
                    <input type="hidden" name="savePaymentTerms" id="savePaymentTerms">
                    <button class="cancel-button-style" id="cancel-button-save">Cancel</button>
                    <button class="confirm-save-button-style" id="save-button-submit" name="save-button-submit" type="submit">Save</button>
                </div>
            </div>
        </form>

        <div class="box-container">
            <div class="box-subcontainer1">
                <input type="text" name="search" id="search" placeholder="Search" class="search-style" oninput="searchSuppliers()" autocomplete="off"> 
                <button class="add-button-style" id="add">Create Supplier</button>
            </div>
            <div class="box-subcontainer2">
                <table class="table-style">
                    <thead>
                        <tr class="tr-head-style">
                            <th class="th-style" id="nameTh">Name</th>
                            <th class="th-style" id="emailTh">Email</th>
                            <th class="th-style" id="contactPersonTh">Contact Person</th>
                            <th class="th-style" id="addressTh">Address</th>
                            <th class="th-style" id="paymentTermsTh">Payment Terms</th>
                        </tr>
                    </thead>
                    <tbody id="content">
                        <!-- JS -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="js/suppliers.js"></script>
    <script src="js/company-name.js"></script>
</body>
</html>