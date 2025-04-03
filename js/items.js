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

    fetchItems();
});

let allItems = [];
function fetchItems(){
    fetch("api/item_api.php")
    .then(response => response.json())
    .then(data =>{
        if(data.status === "success"){
            allItems = data.items;
            const content = document.getElementById("content");
            content.innerHTML = "";
            data.items.forEach(item =>{
                content.innerHTML += `
                    <tr class="tr-body-style" data-item-id="${item.item_id}">
                            <td class="td-style">${item.name}</td>
                            <td class="td-style">₱${item.costPrice}</td>
                            <td class="td-style">₱${item.unitPrice}</td>
                            <td class="td-style">${item.quantity}</td>
                            <td class="td-style">${item.supplierName}</td>
                            <td class="td-style">${item.categoryName}</td>
                            <td class="td-style">${item.status}</td>
                    </tr>
                `;
            });

            document.querySelectorAll(".tr-body-style").forEach(button=>{
                button.addEventListener("click", function(){
                    const itemId = this.getAttribute("data-item-id");
                    const itemData = data.items.find(i => i.item_id == itemId);
                    if(itemData){
                        showEditModal(itemData);
                    }else{
                        console.log("not found");
                        console.log(itemId);
                    }
                });
            });
        }

        
    })
    .catch(error => console.error("Failed Fetching Items", error));
}

function showEditModal(items){
    const modifModalContainer = document.getElementById("modif-modal-container");
    const overlay = document.getElementById("overlay");
    
    document.getElementById("modifName").value = items.name;
    document.getElementById("modifCostPrice").value = items.costPrice;
    document.getElementById("modifQuantity").value = items.quantity;
    document.getElementById("modifUnitPrice").value = items.unitPrice;
    document.getElementById("modifSku").value = items.sku;
    document.getElementById("modifReorderLevel").value = items.reorderLevel;
    document.getElementById("modifStatus").value = items.status;
    document.getElementById("modifSupplier").value = items.supplier_id;
    document.getElementById("modifCategory").value = items.category_id;
    
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
        document.getElementById("saveItemId").value = items.item_id;
        document.getElementById("saveName").value = document.getElementById("modifName").value;
        document.getElementById("saveCostPrice").value = document.getElementById("modifCostPrice").value;
        document.getElementById("saveQuantity").value = document.getElementById("modifQuantity").value;
        document.getElementById("saveUnitPrice").value = document.getElementById("modifUnitPrice").value;
        document.getElementById("saveSku").value = document.getElementById("modifSku").value;
        document.getElementById("saveReorderLevel").value = document.getElementById("modifReorderLevel").value;
        document.getElementById("saveStatus").value = document.getElementById("modifStatus").value;
        document.getElementById("saveSupplier").value = document.getElementById("modifSupplier").value;
        document.getElementById("saveCategory").value = document.getElementById("modifCategory").value;
        confirmSaveContainer.classList.add("show");
        
    });

    const del = document.getElementById("delete");
    const confirmDeleteContainer = document.getElementById("confirm-delete-container");

    del.addEventListener("click", function(event){
        event.preventDefault();
        document.getElementById("deleteItemId").value = items.item_id;
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

function searchItems() {
    const searchInput = document.getElementById("search").value.toLowerCase();
    const content = document.getElementById("content");
    
    if (!searchInput) {
        // If search is empty, show all items
        fetchItems();
        return;
    }
    
    // Filter items based on all searchable fields
    const filteredItems = allItems.filter(item => {
        return (
            item.name.toLowerCase().includes(searchInput) ||
            (item.sku && item.sku.toLowerCase().includes(searchInput)) ||
            (item.supplierName && item.supplierName.toLowerCase().includes(searchInput)) ||
            (item.categoryName && item.categoryName.toLowerCase().includes(searchInput)) ||
            (item.status && item.status.toLowerCase().includes(searchInput)) ||
            (item.costPrice && item.costPrice.toString().includes(searchInput)) ||
            (item.unitPrice && item.unitPrice.toString().includes(searchInput)) ||
            (item.quantity && item.quantity.toString().includes(searchInput))
        );
    });
    
    // Display filtered items
    content.innerHTML = "";
    filteredItems.forEach(item => {
        content.innerHTML += `
            <tr class="tr-body-style" data-item-id="${item.item_id}">
                <td class="td-style">${item.name}</td>
                <td class="td-style">₱${item.costPrice}</td>
                <td class="td-style">₱${item.unitPrice}</td>
                <td class="td-style">${item.quantity}</td>
                <td class="td-style">${item.supplierName}</td>
                <td class="td-style">${item.categoryName}</td>
                <td class="td-style">${item.status}</td>
            </tr>
        `;
    });
    
    // Reattach event listeners to the filtered rows
    document.querySelectorAll(".tr-body-style").forEach(row => {
        row.addEventListener("click", function() {
            const itemId = this.getAttribute("data-item-id");
            const itemData = allItems.find(i => i.item_id == itemId);
            if(itemData) {
                showEditModal(itemData);
            }
        });
    });
}