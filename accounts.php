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
    <link rel="stylesheet" href="/css/account-style.css">
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
                    <p class="p-side-style" style="font-family: PoppinsMedium;">Accounts</p>
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
                    <p class="p-side-style" >Categories</p>
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

    <section class="section-style" id="section-id">
        <!-- Content -->

        <!-- Create Modal-->
        <form method="post" action="accounts.php" class="modal-container" id="modal-container">
            <div class="modal-text-container">
                <!---->
            <h1 class="h1-style">Create Account</h1>
            </div>
            <div class="modal-input-container">
                <!---->
                <div class="modal-input-subcontainer1">
                    <div class="modal-input-subcontainer-sub1">
                        <div id="firstNameContainer">
                            <label for="firstName" class="firstNameLabelStyle">First Name</label>
                            <input type="text" name="firstName" id="firstName" required maxlength="50" placeholder="First Name" class="required-input">
                        </div>
                        <div id="middleNameContainer">
                            <label for="middleName" class="middleNameLabelStyle">Middle Name</label>
                            <input type="text" name="middleName" id="middleName" maxlength="50" placeholder="Middle Name" class="required-input">
                        </div>
                        <div id="lastNameContainer">
                            <label for="lastName" class="lastNameLabelStyle">Last Name</label>
                            <input type="text" name="lastName" id="lastName" required maxlength="50" placeholder="Last Name" class="required-input">
                        </div>
                    </div>
                    <div class="modal-input-subcontainer-sub2">
                        <div id="emailContainer">
                            <label for="email" class="emailLabelStyle">Email</label>
                            <input type="email" name="email" id="email" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" maxlength="50" placeholder="Email" class="required-input">
                        </div>
                        <div id="usernameContainer">
                            <label for="username" class="usernameLabelStyle">Username</label>
                            <input type="text" name="username" id="username" required maxlength="30" placeholder="Username" class="required-input">
                        </div>
                        <div id="addressContainer">
                            <label for="address" class="addressLabelStyle">Address</label>
                            <input type="text" name="address" id="address" required maxlength="100" placeholder="Address" class="required-input">
                        </div>
                        <div id="passwordContainer">
                            <label for="password" class="passwordLabelStyle">Password</label>
                            <input type="password" name="password" id="password" required maxlength="255" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{8,}" 
                            title="Must contain at least 8 characters, including one uppercase, one lowercase, one number, and one special character." placeholder="Password" class="required-input">
                        </div>
                    </div>
                </div>
                <div class="modal-input-subcontainer2">
                    <div class="modal-input-subcontainer2-sub3">
                        <div id="genderContainer">
                            <label for="gender" class="genderLabelStyle">Gender</label>
                            <select name="gender" id="gender" class="select-style" required class="required-input">
                                <option value="" class="option-style">Select Gender</option> 
                                <option value="Male" class="option-style">Male</option>
                                <option value="Female" class="option-style">Female</option>
                            </select>
                        </div>
                        <div id="accountTypeContainer"> 
                            <label for="accountType" class="accountTypeLabelStyle">Account Type</label>
                            <select name="accountType" id="accountType" class="select-style" required class="required-input">
                                <option value="" class="option-style">Select Account Type</option>
                                <option value="Admin" class="option-style">Admin</option>
                                <option value="User" class="option-style">User</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-input-subcontainer2-sub4">
                        <div id="dateBirthContainer">
                            <label for="dateBirth" class="label-style">Date of Birth</label>
                            <input type="date" name="dateBirth" id="dateBirth" required placeholder="Date of Birth" pattern="^(19[0-9]{2}|20[0-9]{2})-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|30)$" 
                            title="Year must be 1900 or later, month must be 01-12, and day must be 01-30." class="required-input">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-button-container">
                <!---->
                <button class="save-button-style" id="save" name="save-submit" type="submit">Save</button>
                <button class="discard-button-style" id="discard">Discard</button>
            </div>
        </form>

        <!-- Modif Modal -->

        <form method="post" action="accounts.php" class="modal-account-details" id="modal-account-details">
            <!-- Account Details -->
            <div class="modal-text-container">
                <!---->
            <h1 class="h1-style" id="name-account"></h1>
            <img src="/images/arrow-icon-383838.png" alt="back" class="back-img-style" id="back-content">
            </div>
            <div class="modal-input-container">
                <!---->
                <div class="modal-input-subcontainer1">
                    <div class="modal-input-subcontainer-sub1">
                        <input type="hidden" name="accountId" id="accountId">
                        <div id="modifFirstNameContainer">
                            <label for="accountfirstName" class="firstNameLabelStyle">First Name</label>
                            <input type="text" name="accountFirstName" id="accountFirstName" required maxlength="50" placeholder="First Name" class="required-input">
                        </div>
                        <div id="modifMiddleNameContainer">
                            <label for="accountMiddleName" class="middleNameLabelStyle">Middle Name</label>
                            <input type="text" name="accountMiddleName" id="accountMiddleName" maxlength="50" placeholder="Middle Name" class="required-input">
                        </div>
                        <div id="modifLastNameContainer">
                            <label for="accountLastName" class="lastNameLabelStyle">Last Name</label>
                            <input type="text" name="accountLastName" id="accountLastName" required maxlength="50" placeholder="Last Name" class="required-input">
                        </div>
                    </div>
                    <div class="modal-input-subcontainer-sub2">
                        <div id="modifEmailContainer">
                            <label for="accountEmail" class="emailLabelStyle">Email</label>
                            <input type="email" name="accountEmail" id="accountEmail" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" maxlength="50" placeholder="Email" class="required-input">
                        </div>
                        <div id="modifUsernameContainer">
                            <label for="accountUsername" class="usernameLabelStyle">Username</label>
                            <input type="text" name="accountUsername" id="accountUsername" required maxlength="30" placeholder="Username" class="required-input">
                        </div>
                        <div id="modifAddressContainer">
                            <label for="accountAddress" class="addressLabelStyle">Address</label>
                            <input type="text" name="accountAddress" id="accountAddress" required maxlength="100" placeholder="Address" class="required-input">
                        </div>
                        <div id="modifPasswordContainer">
                            <label for="accountPassword" class="passwordLabelStyle">Password</label>
                            <input type="password" name="accountPassword" id="accountPassword" required maxlength="255" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{8,}" 
                            title="Must contain at least 8 characters, including one uppercase, one lowercase, one number, and one special character." placeholder="Password" class="required-input">
                        </div>
                    </div>
                </div>
                <div class="modal-input-subcontainer2">
                    <div class="modal-input-subcontainer2-sub3">
                        <div id="modifGenderContainer">
                            <label for="accountGender" class="genderLabelStyle">Gender</label>
                            <select name="accountGender" id="accountGender" class="select-style" required class="required-input">
                                <option value="" class="option-style">Select Gender</option> 
                                <option value="Male" class="option-style">Male</option>
                                <option value="Female" class="option-style">Female</option>
                            </select>
                        </div>
                        <div id="modifAccountTypeContainer">
                            <label for="accountAccountType" class="accountTypeLabelStyle">Account Type</label>
                            <select name="accountAccountType" id="accountAccountType" class="select-style" required class="required-input">
                                <option value="" class="option-style">Select Account Type</option>
                                <option value="Admin" class="option-style">Admin</option>
                                <option value="User" class="option-style">User</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-input-subcontainer2-sub4">
                        <div id="modifDateBirthContainer">
                            <label for="accountdateBirth" class="label-style">Date of Birth</label>
                            <input type="date" name="accountDateBirth" id="accountDateBirth" required placeholder="Date of Birth" pattern="^(19[0-9]{2}|20[0-9]{2})-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|30)$" 
                            title="Year must be 1900 or later, month must be 01-12, and day must be 01-30." class="required-input">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-button-container">
                <!---->
                <button class="account-save-button-style" id="modifSave" name="modif-submit">Save</button>
                <button class="account-delete-button-style" id="accountDelete" name="accountDelete">Delete</button>
            </div>
        </form>

        <!-- Confirm Delete -->
        <form method="post" action="accounts.php" class="confirm-delete-container" id="confirm-delete-container">
        
            <div class="delete-subcontainer">
                <div class="delete-subcontainer-sub1">
                    <h1 class="delete-h1-style">Confirm Deletion</h1>
                    <p class="delete-p-style">This will delete the account permanently. You cannot undo this action.</p>
                </div>
                <div class="delete-subcontainer-sub2">
                    <input type="hidden" name="accountId" id="delete-accountId">
                    <button class="cancel-button-style" id="cancel-button-delete">Cancel</button>
                    <button class="delete-button-style" id="delete-button-submit" name="delete-button-submit">Delete</button>
                </div>
            </div>
        </form>

        <!-- Confirm Save -->
        <form method="post" action="accounts.php" class="confirm-save-container" id="confirm-save-container">
        
            <div class="save-subcontainer">
                <div class="save-subcontainer-sub1">
                    <h1 class="save-h1-style">Save Changes</h1>
                    <p class="save-p-style">You have made changes. Do you want to discard or save them?</p>
                </div>
                <div class="save-subcontainer-sub2">
                    <input type="hidden" name="save-accountId" id="save-accountId">
                    <input type="hidden" name="save-firstName" id="save-firstName">
                    <input type="hidden" name="save-middleName" id="save-middleName">
                    <input type="hidden" name="save-lastName" id="save-lastName">
                    <input type="hidden" name="save-email" id="save-email">
                    <input type="hidden" name="save-address" id="save-address">
                    <input type="hidden" name="save-username" id="save-username">
                    <input type="hidden" name="save-password" id="save-password">
                    <input type="hidden" name="save-gender" id="save-gender">
                    <input type="hidden" name="save-accountType" id="save-accountType">
                    <input type="hidden" name="save-dateBirth" id="save-dateBirth">
                    <button class="cancel-button-style" id="cancel-button-save">Cancel</button>
                    <button class="confirm-save-button-style" id="save-button-submit" name="save-button-submit" type="submit">Save</button>
                </div>
            </div>
        </form>

        <!-- Warning Delete Pop Up-->
        <div class="warning-delete-pop-up" id="warning-delete-pop-up">
            <h1 class="warning-h1-style">Warning</h1>
            <p class="warning-p-style">Unable to delete account!</p>
        </div>
        
        <!-- Content -->
        <div class="box-style">
            <div class="content-container1">
                <input type="text" name="search" id="search" class="searchBar">
                <button class="add-button-style" id="open">Create Account</button>
            </div>
            <ul class="content-container2" id="content">
                <!-- JavaScript -->
                 
            </ul>
        </div>
    </section>
    <script src="/js/account.js"></script>
</body>
</html>

<?php

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["save-submit"])){
        
        if(empty($_POST["firstName"]) || empty($_POST["lastName"]) || empty($_POST["email"]) || empty($_POST["username"]) ||
           empty($_POST["address"]) || empty($_POST["password"]) || empty($_POST["gender"]) || empty($_POST["accountType"]) ||
           empty($_POST["dateBirth"])){

            echo "<script>alert('Get Out');</script>";
           }
        
        $firstName = $_POST["firstName"];
        $middleName = $_POST["middleName"];
        $lastName = $_POST["lastName"];
        $email = $_POST["email"];
        $username = $_POST["username"];
        $address = $_POST["address"];
        $password = $_POST["password"];
        $gender = $_POST["gender"];
        $accountType = $_POST["accountType"];
        $dateBirth = $_POST["dateBirth"];

        $sql = "INSERT INTO accounts (first_name, middle_name, last_name, email, address, username, password, gender, account_type, date_of_birth) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssss", $firstName, $middleName, $lastName, $email, $address, $username, $password, $gender, $accountType, $dateBirth);
        $stmt->execute();
        $stmt->close();

    }
?>

<?php

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["save-button-submit"])){
        
        $accountID = $_POST["save-accountId"];
        $firstName = $_POST["save-firstName"];
        $middleName = $_POST["save-middleName"];
        $lastName = $_POST["save-lastName"];
        $email = $_POST["save-email"];
        $username = $_POST["save-username"];
        $address = $_POST["save-address"];
        $password = $_POST["save-password"];
        $gender = $_POST["save-gender"];
        $accountType = $_POST["save-accountType"];
        $dateBirth = $_POST["save-dateBirth"];

        $sql = "UPDATE accounts SET first_name = ?, middle_name = ?, last_name = ?, email = ?, address = ?, username = ?, password = ?, gender = ?, account_type = ?, date_of_birth = ? WHERE account_id = ?;";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssssi", $firstName, $middleName, $lastName, $email, $address, $username, $password, $gender, $accountType, $dateBirth, $accountID);
        $stmt->execute();
        $stmt->close();

    }
?>

<?php

    $sql = "SELECT * FROM accounts";
    $result = $conn->query($sql);

    if($result->num_rows == 1){
        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete-button-submit"])){
            include "/pop-up/one-account-deletion.php";
        }
        
    }else{
        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete-button-submit"])){

            $accountID = $_POST["accountId"];
            $sql2 = "DELETE FROM accounts WHERE account_id = ?;";
    
            $stmt = $conn->prepare($sql2);
            $stmt->bind_param("i", $accountID);
            $stmt->execute();
            $stmt->close();
    
        }
    }
?>



