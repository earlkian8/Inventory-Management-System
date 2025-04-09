document.addEventListener("DOMContentLoaded", function(){
    const checkout = document.getElementById("checkout");
    const checkoutContainer = document.getElementById("checkout-container");
    const overlay = document.getElementById("overlay");
    const installment = document.getElementById("installment");
    const installmentContainer = document.getElementById("installment-container");

    installment.addEventListener("click", function(event){
        event.preventDefault();
        collectCartItems();
        overlay.classList.add("show");
        installmentContainer.classList.add("show");
    });
    checkout.addEventListener("click", function(event){
        event.preventDefault();

        collectCartItems();
        
        overlay.classList.add("show");
        checkoutContainer.classList.add("show");
    });

    overlay.addEventListener("click", function(event){

        if (event.target === overlay) {
            event.preventDefault();
            overlay.classList.remove("show");
            checkoutContainer.classList.remove("show");
            installmentContainer.classList.remove("show");
        }
    });
    
    fetchItemActive();
    calculateChange();
    document.getElementById('downpayment').addEventListener('input', calculateMonthlyPayment);
    document.getElementById('months').addEventListener('change', calculateMonthlyPayment);
    document.getElementById('interest').addEventListener('input', calculateMonthlyPayment);

    document.getElementById('interest').addEventListener('change', function() {
        const value = parseFloat(this.value) || 0;
        
        if (value < 0) {
            this.value = 0;
            this.setCustomValidity("Interest cannot be less than 0%");
        } else if (value > 12) {
            this.value = 12;
            this.setCustomValidity("Interest cannot be more than 12%");
        } else {
            this.setCustomValidity("");
        }
        
        calculateMonthlyPayment();
    });
});

function collectCartItems() {
    const cartRows = document.querySelectorAll('#cart tr');
    let cartItems = [];
    
    cartRows.forEach(row => {
        const itemId = row.querySelector('.delete-button-style')?.getAttribute('data-item-id');
        if (!itemId) return;
        
        const quantityInput = row.querySelector('.quantity-input');
        const discountInput = row.querySelector('.discount-input');
        const totalCell = row.querySelector('.total-cell');
        
        if (quantityInput && discountInput && totalCell) {
            const quantity = parseInt(quantityInput.value) || 0;
            const discount = parseInt(discountInput.value) || 0;
            const total = parseFloat(totalCell.textContent) || 0;
            const unitPrice = parseFloat(row.querySelectorAll('.td-cart-style')[1].textContent) || 0;
            
            cartItems.push({
                item_id: itemId,
                quantity: quantity,
                unit_price: unitPrice,
                discount_percent: discount,
                total_price: total
            });
        }
    });

    const cartItemsInput = document.getElementById('cartItems');
    const installmentCartItemsInput = document.getElementById('installmentCartItems');
    
    if (cartItemsInput) {
        cartItemsInput.value = JSON.stringify(cartItems);
    }
    if (installmentCartItemsInput) {
        installmentCartItemsInput.value = JSON.stringify(cartItems);
    }
}

let allItems = [];
function fetchItemActive(){
    fetch("api/item_active_api.php")
    .then(response => response.json())
    .then(data => {
        const content = document.getElementById("content");
        if(data.status === "success"){
            content.innerHTML = "";
            allItems = data.itemActive;
            data.itemActive.forEach(items =>{
                content.innerHTML += `
                    <tr class="tr-body-style" data-item-id=${items.item_id}>
                        <td class="td-style">${items.name}</td>
                        <td class="td-style">${items.sku}</td>
                        <td class="td-style">₱${items.unitPrice}</td>
                        <td class="td-style"><button class="add-button-style" data-item-id=${items.item_id}>Add</button></td>
                    </tr>
                `;  
            });

            document.querySelectorAll(".add-button-style").forEach(button =>{
                button.addEventListener("click", function(){
                    const itemId = this.getAttribute("data-item-id");
                    const items = data.itemActive.find(i => i.item_id == itemId);

                    if(items){
                        addItemtoCart(items);
                    }
                });
            });
        }
    })
    .catch(error => console.error("Failed Fetching Items", error));
}

function addItemtoCart(items) {
    const cart = document.getElementById("cart");
    const newRow = document.createElement('tr');
    newRow.className = 'tr-body-cart-style';
    newRow.innerHTML = `
            <td class="td-cart-style">${items.name}</td>
            <td class="td-cart-style">${items.unitPrice}</td>
            <td class="td-cart-style"><div class="discount-container">
                <input type="number" class="quantity-input" value="0" min="1" max="${items.quantity}" autocomplete="off">
            </div></td>
            <td class="td-cart-style"><div class="discount-container">
                <input type="number" class="discount-input" value="0" autocomplete="off">%</div></td>
            <td class="td-cart-style total-cell">${items.unitPrice}</td>
            <td class="td-cart-style" id='deleteTd'>
                <button class="delete-button-style" data-item-id="${items.item_id}">Delete</button>
            </td>
    `;
    cart.appendChild(newRow);

    const quantityInput = newRow.querySelector('.quantity-input');
    const discountInput = newRow.querySelector('.discount-input');
    const totalCell = newRow.querySelector('.total-cell');

    function updateTotal() {
        const quantity = parseInt(quantityInput.value) || 0;
        const availableQuantity = parseInt(items.quantity);

        if (quantity > availableQuantity) {
            this.setCustomValidity(`Maximum available quantity is ${availableQuantity}`);
            quantityInput.value = availableQuantity;
            return;
        }
        

        const discount = parseInt(discountInput.value) || 0;
        const subtotal = items.unitPrice * quantity;
        const total = subtotal - (subtotal * (discount / 100));
        totalCell.textContent = total.toFixed(2);
        calculateGrandTotal();
    }

    quantityInput.addEventListener('input', updateTotal);
    discountInput.addEventListener('input', updateTotal);

    quantityInput.addEventListener('change', function() {
        const value = parseInt(this.value) || 0;
        const max = parseInt(items.quantity);
        
        if (value > max) {
            this.setCustomValidity("Cash amount must be greater than or equal to the total amount");
            this.value = max;
            updateTotal();
        }
        
        if (value < 1) {
            this.value = 1;
            updateTotal();
        }
    });
    discountInput.addEventListener("change", function(){
        const value = parseInt(this.value || 0);
        const max = 100;

        if (value > max) {
            this.setCustomValidity("Discount cannot exceed 100%");
            this.value = max;
            updateTotal();
        } else {
            this.setCustomValidity("");
            if (value < 0) {
                this.value = 0;
                updateTotal();
            }
        }
    });

    const deleteButton = newRow.querySelector('.delete-button-style');
    deleteButton.addEventListener('click', function() {
        newRow.remove();
        calculateGrandTotal();
    });
}

function calculateGrandTotal() {
    const cartRows = document.querySelectorAll('#cart tr');
    let subtotal = 0;
    
    cartRows.forEach(row => {
        const totalCell = row.querySelector('.total-cell');
        if (totalCell) {
            subtotal += parseFloat(totalCell.textContent) || 0;
        }
    });
    
    const tax = subtotal * 0.12;
    
    const total = subtotal + tax;
    
    document.getElementById("subTotal").textContent = subtotal.toFixed(2);
    document.getElementById("tax").textContent = tax.toFixed(2);
    document.getElementById("total").textContent = total.toFixed(2);

    document.getElementById("paySubTotal").value = parseFloat(document.getElementById("subTotal").textContent);
    document.getElementById("payTaxAmount").value = parseFloat(document.getElementById("tax").textContent);
    document.getElementById("payTotalAmount").value = parseFloat(document.getElementById("total").textContent);

    document.getElementById("installmentSubTotal").value = parseFloat(document.getElementById("subTotal").textContent);
    document.getElementById("installmentTaxAmount").value = parseFloat(document.getElementById("tax").textContent);
    document.getElementById("installmentTotalAmount").value = parseFloat(document.getElementById("total").textContent);

    document.getElementById("checkoutSubtotal").textContent = parseFloat(document.getElementById("subTotal").textContent);
    document.getElementById("checkoutTax").textContent = parseFloat(document.getElementById("tax").textContent);
    document.getElementById("checkoutTotal").textContent = parseFloat(document.getElementById("total").textContent);

    document.getElementById("installmentSubtotalDisplay").textContent = parseFloat(document.getElementById("subTotal").textContent);
    document.getElementById("installmentTaxDisplay").textContent = parseFloat(document.getElementById("tax").textContent);
    document.getElementById("installmentTotalDisplay").textContent = parseFloat(document.getElementById("total").textContent);
}

function searchProduct() {
    const searchInput = document.getElementById("search").value.toLowerCase();
    const content = document.getElementById("content");
    
    if (!searchInput) {
        content.innerHTML = "";
        allItems.forEach(items => {
            content.innerHTML += `
                <tr class="tr-body-style" data-item-id=${items.item_id}>
                    <td class="td-style">${items.name}</td>
                    <td class="td-style">${items.sku}</td>
                    <td class="td-style">₱${items.unitPrice}</td>
                    <td class="td-style"><button class="add-button-style" data-item-id=${items.item_id}>Add</button></td>
                </tr>
            `;
        });
        
        document.querySelectorAll(".add-button-style").forEach(button => {
            button.addEventListener("click", function() {
                const itemId = this.getAttribute("data-item-id");
                const items = allItems.find(i => i.item_id == itemId);
                if(items) {
                    addItemtoCart(items);
                }
            });
        });
        return;
    }

    const filteredItems = allItems.filter(item => {
        return (
            item.name.toLowerCase().includes(searchInput) ||
            item.sku.toLowerCase().includes(searchInput)
        );
    });
    
    content.innerHTML = "";
    filteredItems.forEach(items => {
        content.innerHTML += `
            <tr class="tr-body-style" data-item-id=${items.item_id}>
                <td class="td-style">${items.name}</td>
                <td class="td-style">${items.sku}</td>
                <td class="td-style">₱${items.unitPrice}</td>
                <td class="td-style"><button class="add-button-style" data-item-id=${items.item_id}>Add</button></td>
            </tr>
        `;
    });

    document.querySelectorAll(".add-button-style").forEach(button => {
        button.addEventListener("click", function() {
            const itemId = this.getAttribute("data-item-id");
            const items = allItems.find(i => i.item_id == itemId);
            if(items) {
                addItemtoCart(items);
            }
        });
    });
}

function calculateChange() {
    const cashInput = document.getElementById("cash");
    const changeInput = document.getElementById("change");
    const totalAmount = parseFloat(document.getElementById("payTotalAmount").value) || 0;

    if (cashInput) {
        cashInput.addEventListener("input", function() {
            const cashAmount = parseFloat(this.value) || 0;
            
            if (cashAmount < totalAmount) {
                changeInput.value = "";
                this.setCustomValidity("Cash amount must be greater than or equal to the total amount");
            } else {
                const change = cashAmount - totalAmount;
                changeInput.value = change.toFixed(2);
                this.setCustomValidity("");
            }
        });
    }
}

function calculateMonthlyPayment() {
    const totalAmount = parseFloat(document.getElementById("payTotalAmount").value) || 0;
    const downpayment = parseFloat(document.getElementById('downpayment').value) || 0;
    const months = parseInt(document.getElementById('months').value) || 0;
    const interestRate = parseFloat(document.getElementById('interest').value) || 0;

    if (downpayment > totalAmount) {
        document.getElementById('downpayment').setCustomValidity("Downpayment cannot exceed total amount");
        document.getElementById('monthlyAmount').value = '';
        return;
    } else {
        document.getElementById('downpayment').setCustomValidity("");
    }

    const remainingAmount = totalAmount - downpayment;
    
    if (months > 0 && remainingAmount > 0) {
        const monthlyInterestRate = interestRate / 100 / 12;
        const numerator = remainingAmount * monthlyInterestRate * Math.pow(1 + monthlyInterestRate, months);
        const denominator = Math.pow(1 + monthlyInterestRate, months) - 1;
        const monthlyPayment = numerator / denominator;
        
        document.getElementById('monthlyAmount').value = monthlyPayment.toFixed(2);

        document.getElementById('payDownpayment').value = downpayment;
        document.getElementById('payMonthlyPayment').value = months;
        document.getElementById('payMonthlyAmount').value = monthlyPayment.toFixed(2);
    } else {
        document.getElementById('monthlyAmount').value = '';
    }
}