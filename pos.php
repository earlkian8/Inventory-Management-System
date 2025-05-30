<?php
include "api/database.php";
include "class/Invoice.php";
include "class/Installment.php";

$database = new Database();
$conn = $database->getConnection();

$invoice = new Invoice($conn);
$installment = new Installment($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["pay"])) {
    $subtotal = $_POST["paySubTotal"];
    $taxAmount = $_POST["payTaxAmount"];
    $totalAmount = $_POST["payTotalAmount"];
    $cashReceived = $_POST["cash"];
    $changeAmount = $_POST["change"];
    $cartItems = isset($_POST["cartItems"]) ? json_decode($_POST["cartItems"], true) : [];

    error_log("POST pay received: subtotal=$subtotal, taxAmount=$taxAmount, totalAmount=$totalAmount, cashReceived=$cashReceived, changeAmount=$changeAmount, cartItems=" . json_encode($cartItems));

    if (empty($cartItems)) {
        $error = "No items in the cart. Please add items to proceed.";
        error_log("Error: No items in cart for checkout");
    } elseif (!is_numeric($subtotal) || !is_numeric($taxAmount) || !is_numeric($totalAmount) || 
             !is_numeric($cashReceived) || !is_numeric($changeAmount)) {
        $error = "Invalid input values. Please check the amounts.";
        error_log("Error: Invalid numeric inputs for checkout");
    } else {
        $invoiceId = $invoice->addInvoice($subtotal, $taxAmount, $totalAmount, $cashReceived, $changeAmount);
        
        if ($invoiceId && $invoice->addInvoiceItems($invoiceId, $cartItems)) {
            $success = "Checkout transaction successful!";
            error_log("Checkout transaction succeeded: invoiceId=$invoiceId");
        } else {
            $error = "Checkout transaction failed. Please try again.";
            error_log("Checkout transaction failed for invoiceId=$invoiceId");
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["payInstallment"])) {
    $subtotal = $_POST["installmentSubTotal"];
    $taxAmount = $_POST["installmentTaxAmount"];
    $totalAmount = $_POST["installmentTotalAmount"];
    $downpayment = $_POST["downpayment"];
    $months = (string)$_POST["months"];
    $interest = $_POST["interest"];
    $monthlyAmount = $_POST["monthlyAmount"];
    $cartItems = isset($_POST["installmentCartItems"]) ? json_decode($_POST["installmentCartItems"], true) : [];

    error_log("POST payInstallment received: subtotal=$subtotal, taxAmount=$taxAmount, totalAmount=$totalAmount, downpayment=$downpayment, months=$months, interest=$interest, monthlyAmount=$monthlyAmount, cartItems=" . json_encode($cartItems));

    if (empty($cartItems)) {
        $error = "No items in the cart. Please add items to proceed.";
        error_log("Error: No items in cart for installment");
    } elseif (!is_numeric($subtotal) || !is_numeric($taxAmount) || !is_numeric($totalAmount) || 
             !is_numeric($downpayment) || !is_numeric($interest) || !is_numeric($monthlyAmount) || empty($months)) {
        $error = "Invalid input values. Please check the amounts.";
        error_log("Error: Invalid numeric inputs for installment");
    } else {
        try {
            $installmentId = $installment->addInstallment($subtotal, $taxAmount, $totalAmount, $downpayment, $months, $interest, $monthlyAmount);
            if (!$installmentId) {
                throw new Exception("Failed to create installment record");
            }

            if (!$installment->addInstallmentItems($installmentId, $cartItems)) {
                throw new Exception("Failed to add installment items");
            }

            $success = "Installment transaction successful!";
            error_log("Installment transaction succeeded: installmentId=$installmentId");
        } catch (Exception $e) {
            $error = "Installment transaction failed: " . $e->getMessage();
            error_log("Installment transaction failed for installmentId=$installmentId: " . $e->getMessage());
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventify</title>
    <link rel="stylesheet" href="style/pos.css">
</head>
<body>
    <?php if (isset($error)): ?>
        <script>alert("<?php echo htmlspecialchars($error); ?>");</script>
    <?php endif; ?>
    <?php if (isset($success)): ?>
        <script>alert("<?php echo htmlspecialchars($success); ?>"); window.location.href="pos.php";</script>
    <?php endif; ?>

    <div class="overlay" id="overlay"></div>
    <form method="post" action="pos.php" class="checkout-container" id="checkout-container">
        <input type="hidden" name="paySubTotal" id="paySubTotal">
        <input type="hidden" name="payTaxAmount" id="payTaxAmount">
        <input type="hidden" name="payTotalAmount" id="payTotalAmount">
        <input type="hidden" name="cartItems" id="cartItems">
        <table class="table-checkout-style">
            <tr class="tr-checkout-style">
                <td class="td-name-td-checkout">Subtotal:</td>
                <td class="td-total-td-checkout" id="checkoutSubtotal"></td>
            </tr>
            <tr class="tr-checkout-style">
                <td class="td-name-td-checkout">Tax (12%):</td>
                <td class="td-total-td-checkout" id="checkoutTax"></td>
            </tr>
            <tr class="tr-checkout-style">
                <td class="td-name-td-checkout">Total:</td>
                <td class="td-total-td-checkout" id="checkoutTotal"></td>
            </tr>
        </table>
        <div class="space-lol"></div>
        <div class="input-cash-container">
            <label for="cash" class="label-style">Cash</label>
            <input type="number" name="cash" id="cash" autocomplete="off" required oninput="calculateChange()">
        </div>
        <div class="input-cash-container">
            <label for="cash" class="label-style">Change</label>
            <input type="number" name="change" id="change" readonly>
        </div>
        <button class="button-pay-style" name="pay">Pay</button>
    </form>

    <form action="pos.php" method="post" class="installment-container" id="installment-container">
        <input type="hidden" name="installmentSubTotal" id="installmentSubTotal">
        <input type="hidden" name="installmentTaxAmount" id="installmentTaxAmount">
        <input type="hidden" name="installmentTotalAmount" id="installmentTotalAmount">
        <input type="hidden" name="installmentCartItems" id="installmentCartItems">
        <table class="table-checkout-style">
            <tr class="tr-checkout-style">
                <td class="td-name-td-checkout">Subtotal:</td>
                <td class="td-total-td-checkout" id="installmentSubtotalDisplay"></td>
            </tr>
            <tr class="tr-checkout-style">
                <td class="td-name-td-checkout">Tax (12%):</td>
                <td class="td-total-td-checkout" id="installmentTaxDisplay"></td>
            </tr>
            <tr class="tr-checkout-style">
                <td class="td-name-td-checkout">Total:</td>
                <td class="td-total-td-checkout" id="installmentTotalDisplay"></td>
            </tr>
        </table>
        <div class="input-downpayment-container">
            <label for="downpayment" class="label-style">Downpayment</label>
            <input type="number" name="downpayment" id="downpayment" autocomplete="off" required>
        </div>
        <div class="input-months-container">
            <label for="months" class="label-style">Monthly Payment (months)</label>
            <select name="months" id="months" required>
                <option value="" disabled selected>Select months</option>
                <option value="3">3 months</option>
                <option value="6">6 months</option>
                <option value="12">12 months</option>
                <option value="24">24 months</option>
                <option value="36">36 months</option>
            </select>
        </div>
        <div class="input-interest-container">
            <label for="interest" class="label-style">Interest</label>
            <input type="number" name="interest" id="interest" autocomplete="off" required>
        </div>
        <div class="input-monthly-container" id="monthlyAmountContainer">
            <label for="monthlyAmount" class="label-style">Monthly Amount</label>
            <input type="number" name="monthlyAmount" id="monthlyAmount" readonly>
        </div>
        <button class="button-pay-style" name="payInstallment">Pay Installment</button>
    </form>

    <div class="header-container">
        <h1 class="company-name" id="company-name"></h1>
        <img src="images/inventify-logo-ffffff.png" alt="logo" class="icon-style">
        <div class="icon-container">
            <img src="images/logout-icon-ffffff.png" alt="Logout" class="icon-style-con" id="logoutId">
        </div>
    </div>
    <div class="main-container">
        <div class="product-container">
            <div class="title-container">
                <h1 class="h1-title-style">PRODUCT</h1>
            </div>
            <div class="search-container">
                <input type="text" name="search" id="search" placeholder="Search by Name or SKU" autocomplete="off" oninput="searchProduct()">
            </div>
            <table class="table-product-style">
                <thead>
                    <tr class="tr-head-style">
                        <th class="th-style" id="nameTh">Name</th>
                        <th class="th-style" id="skuTh">SKU</th>
                        <th class="th-style" id="unitPriceTh">Unit Price</th>
                        <th class="th-style" id="actionTh">Action</th>
                    </tr>
                </thead>
                <tbody id="content"></tbody>
            </table>
        </div>
        <div class="content-container">
            <div class="table-cart-container">
                <table class="table-cart-style">
                    <tr class="tr-head-cart-style">
                        <th class="th-cart-style">Items</th>
                        <th class="th-cart-style">Unit Price</th>
                        <th class="th-cart-style">Quantity</th>
                        <th class="th-cart-style">Discount</th>
                        <th class="th-cart-style">Total</th>
                        <th class="th-cart-style" id="deleteTh">Delete</th>
                    </tr>                       
                    <tbody id="cart"></tbody>
                </table>
            </div>
            <div class="total-container">
                <table class="table-total-style">
                    <tr class="tr-total-style">
                        <td class="td-name-td">Subtotal:</td>
                        <td class="td-total-td" id="subTotal"></td>
                    </tr>
                    <tr class="tr-total-style">
                        <td class="td-name-td">Tax (12%):</td>
                        <td class="td-total-td" id="tax"></td>
                    </tr>
                    <tr class="tr-total-style">
                        <td class="td-name-td">Total:</td>
                        <td class="td-total-td" id="total"></td>
                    </tr>
                </table>
                <div class="buttons">
                    <button class="button-checkout-style" id="checkout">Proceed to Checkout</button>
                    <button class="button-installment-style" id="installment">Proceed to Installment</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById("logoutId").addEventListener("click", function(){
            window.location.href = "login.php"
        });
    </script>
    <script src="js/company-name.js"></script>
    <script src="js/pos.js"></script>
</body>
</html>