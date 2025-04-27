document.addEventListener("DOMContentLoaded", function(){
    const dashboardNav = document.getElementById("dashboard-nav");
    dashboardNav.addEventListener("click", function(){
        window.location.href = "dashboard.php"
    });

    const accountsNav = document.getElementById("accounts-nav");
    accountsNav.addEventListener("click", function(event){
        event.preventDefault();
        window.location.href = "accounts.php";
    });

    const categoriesNav = document.getElementById("categories-nav");
    categoriesNav.addEventListener("click", function(event){
        event.preventDefault();
        window.location.href = "categories.php";
    });

    const suppliersNav = document.getElementById("suppliers-nav");
    suppliersNav.addEventListener("click", function(event){
        event.preventDefault();
        window.location.href = "suppliers.php";
    });

    const itemsNav = document.getElementById("items-nav");
    itemsNav.addEventListener("click", function(event){
        event.preventDefault();
        window.location.href = "items.php";
    });

    const reportNav = document.getElementById("report-nav");
    reportNav.addEventListener("click", function(event){
        event.preventDefault();
        window.location.href = "report.php";
    });

    const add = document.getElementById("add");
    const modalContainer = document.getElementById("modal-container");
    const overlay = document.getElementById("overlay");

    add.addEventListener("click", function(event){
        event.preventDefault();
        overlay.classList.add("show");
        modalContainer.classList.add("show");
    });

    const discard = document.getElementById("discard");
    discard.addEventListener("click", function(event){
        event.preventDefault();
        modalContainer.classList.remove("show");
        overlay.classList.remove("show");
    });

    fetchSuppliers();
    fetchItemOut();
    fetchItemLow();
    fetchRecentlyAdded();

    document.getElementById("notificationIcon").addEventListener("click", function(event){
        event.preventDefault();
        document.getElementById("notificationContainer").classList.add("show");
    });
     document.addEventListener('click', function(e) {
        if (!notificationContainer.contains(e.target) && 
            !notificationIcon.contains(e.target)) {
                document.getElementById("notificationContainer").classList.remove("show");
        }
    });
});

let allSuppliers = [];
function fetchSuppliers(){
    fetch("api/supplier_api.php")
    .then(response => response.json())
    .then(data =>{
        if(data.status === "success"){
            allSuppliers = data.suppliers;
            const content = document.getElementById("content");
            content.innerHTML = "";
            data.suppliers.forEach(supplier =>{
                content.innerHTML += `
                    <tr class="tr-body-style" supplier-id="${supplier.supplier_id}">
                            <td class="td-style">${supplier.name}</td>
                            <td class="td-style">${supplier.email}</td>
                            <td class="td-style">${supplier.contact_person}</td>
                            <td class="td-style">${supplier.address}</td>
                            <td class="td-style">${supplier.payment_terms}</td>
                    </tr>
                `;
            });
        }

        document.querySelectorAll(".tr-body-style").forEach(button =>{
            button.addEventListener("click", function(){
                const supId = this.getAttribute("supplier-id");
                const supplierData = data.suppliers.find(s => s.supplier_id == supId);
                if(supplierData){
                    showEditModal(supplierData);
                } 
            });
        });
    })
    .catch(error => console.error("Failed Fetching Suppliers", error));
}

function showEditModal(suppliers){
    const modifModalContainer = document.getElementById("modif-modal-container");
    const overlay = document.getElementById("overlay");
    
    document.getElementById("modifName").value = suppliers.name;
    document.getElementById("modifEmail").value = suppliers.email;
    document.getElementById("modifContactPerson").value = suppliers.contact_person;
    document.getElementById("modifAddress").value = suppliers.address;
    document.getElementById("modifPaymentTerms").value = suppliers.payment_terms;
    
    modifModalContainer.classList.add("show");
    overlay.classList.add("show");

    const back = document.getElementById("back");
    back.addEventListener("click", function(event){
        event.preventDefault();
        modifModalContainer.classList.remove("show");
        overlay.classList.remove("show");
    });

    const save = document.getElementById("save");
    const confirmSaveContainer = document.getElementById("confirm-save-container");
    save.addEventListener("click", function(event){
        event.preventDefault();
        document.getElementById("saveSupplierId").value = suppliers.supplier_id;
        document.getElementById("saveName").value = document.getElementById("modifName").value;
        document.getElementById("saveEmail").value = document.getElementById("modifEmail").value;
        document.getElementById("saveContactPerson").value = document.getElementById("modifContactPerson").value;
        document.getElementById("saveAddress").value = document.getElementById("modifAddress").value;
        document.getElementById("savePaymentTerms").value = document.getElementById("modifPaymentTerms").value;
        confirmSaveContainer.classList.add("show");
        
    });

    const del = document.getElementById("delete");
    const confirmDeleteContainer = document.getElementById("confirm-delete-container");

    del.addEventListener("click", function(event){
        event.preventDefault();
        document.getElementById("deleteSupplierId").value = suppliers.supplier_id;
        confirmDeleteContainer.classList.add("show");
    });

    const cancelButtonDelete = document.getElementById('cancel-button-delete');
    cancelButtonDelete.addEventListener("click", function(event){
        event.preventDefault();
        confirmDeleteContainer.classList.remove("show");
    });

    const cancelButtonSave = document.getElementById("cancel-button-save");
    cancelButtonSave.addEventListener("click", function(event){
        event.preventDefault();
        confirmSaveContainer.classList.remove("show");
    });
}

function searchSuppliers() {
    const searchInput = document.getElementById("search").value.toLowerCase();
    const content = document.getElementById("content");
    
    if (!searchInput) {
        // If search is empty, show all suppliers
        fetchSuppliers();
        return;
    }
    
    // Filter suppliers based on all fields
    const filteredSuppliers = allSuppliers.filter(supplier => {
        return (
            supplier.name.toLowerCase().includes(searchInput) ||
            (supplier.email.toLowerCase().includes(searchInput)) ||
            (supplier.contact_person.toLowerCase().includes(searchInput)) ||
            (supplier.address.toLowerCase().includes(searchInput)) ||
            (supplier.payment_terms.toLowerCase().includes(searchInput))
        );
    });
    
    // Display filtered suppliers
    content.innerHTML = "";
    filteredSuppliers.forEach(supplier => {
        content.innerHTML += `
            <tr class="tr-body-style" supplier-id="${supplier.supplier_id}">
                <td class="td-style">${supplier.name}</td>
                <td class="td-style">${supplier.email}</td>
                <td class="td-style">${supplier.contact_person}</td>
                <td class="td-style">${supplier.address}</td>
                <td class="td-style">${supplier.payment_terms}</td>
            </tr>
        `;
    });
    
    // Reattach event listeners to the filtered rows
    document.querySelectorAll(".tr-body-style").forEach(button => {
        button.addEventListener("click", function() {
            const supId = this.getAttribute("supplier-id");
            const supData = allSuppliers.find(s => s.supplier_id == supId);
            if(supData) {
                showEditModal(supData);
            }
        });
    });
}

function fetchItemOut(){
    fetch("api/item_out_stock_api.php")
    .then(response => response.json())
    .then(data =>{
        if(data.status === "success"){
            data.itemOut.forEach(items =>{
                document.getElementById("notificationContent").innerHTML += `
                    <div class="notification-item">
                        <span class="notification-text">Out of stock alert: ${items.name}</span>
                    </div>
                `;

            });
        }
    })
    .catch(error => console.error("Failed Fetching Dashboard", error));
}

function fetchItemLow(){
    fetch("api/item_low_stock_api.php")
    .then(response => response.json())
    .then(data =>{
        if(data.status === "success"){

            data.itemLow.forEach(items =>{
                document.getElementById("notificationContent").innerHTML += `
                    <div class="notification-item">
                        <span class="notification-text">Low stock alert: ${items.name}</span>
                    </div>
                `;
            });

        }
    })
    .catch(error => console.error("Failed Fetching Dashboard", error));
}

function fetchRecentlyAdded(){
    fetch("api/item_recently_added_api.php")
    .then(response => response.json())
    .then(data =>{
        if(data.status === "success"){          
            data.recentlyAdded.slice(0, 5).forEach(items => {
                document.getElementById("notificationContent").innerHTML += `
                    <div class="notification-item">
                        <span class="notification-text">Recently Added: ${items.name}</span>
                    </div>
                `;
            });
        }
    })
    .catch(error => console.error("Failed Fetching Dashboard", error));
}