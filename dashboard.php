<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventify</title>
    <link rel="stylesheet" href="style/dashboard.css">
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
        <div class="navigation-container active" id="dashboard-nav">
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
    <div class="content-container">
        <div class="box-container">
            <div class="count-container">
                <div class="countBox-container">
                    <div class="img-container">
                        <img src="images/account-icon-383838.png" alt="User" class="img-count-style">
                    </div>
                    <div class="text-container">
                        <h1 class="h-count-style" id="accountCount">3</h1>
                        <p class="p-count-style">Accounts</p>
                    </div>
                </div>
                <div class="countBox-container">
                <div class="img-container">
                        <img src="images/suppliers-icon-383838.png" alt="User" class="img-count-style">
                    </div>
                    <div class="text-container">
                        <h1 class="h-count-style" id="supplierCount">23</h1>
                        <p class="p-count-style">Suppliers</p>
                    </div>
                </div>
                <div class="countBox-container">
                <div class="img-container">
                        <img src="images/categories-icon-383838.png" alt="User" class="img-count-style">
                    </div>
                    <div class="text-container">
                        <h1 class="h-count-style" id="categoryCount">10</h1>
                        <p class="p-count-style">Categories</p>
                    </div>
                </div>
                <div class="countBox-container">
                <div class="img-container">
                        <img src="images/items-icon-383838.png" alt="User" class="img-count-style">
                    </div>
                    <div class="text-container">
                        <h1 class="h-count-style" id="itemCount">24678</h1>
                        <p class="p-count-style">Total Stocks</p>
                    </div>
                </div>
                <div class="countBox-container">
                <div class="img-container">
                        <img src="images/items-icon-383838.png" alt="User" class="img-count-style">
                    </div>
                    <div class="text-container" >
                        <h1 class="h-count-style" id="itemLowCount">13</h1>
                        <p class="p-count-style">Low Stocks</p>
                    </div>
                </div>
                <div class="countBox-container">
                <div class="img-container">
                        <img src="images/items-icon-383838.png" alt="User" class="img-count-style">
                    </div>
                    <div class="text-container">
                        <h1 class="h-count-style" id="itemOutCount">3</h1>
                        <p class="p-count-style">Out of Stocks</p>
                    </div>
                </div>
            </div>
            <div class="stock-container">
                <div class="table-container">

                </div>
                <div class="table-container">
                    
                </div>
                <div class="table-container">
                    
                </div>
            </div>
        </div>
    </div>
    <script src="js/dashboard.js"></script>
    <script src="js/company-name.js"></script>
</body>
</html>