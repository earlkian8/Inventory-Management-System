document.addEventListener("DOMContentLoaded", function(){

    const createItemsModal = document.getElementById("modal-container");
    const addItemsModal = document.getElementById("open");
    const discardItemsModal = document.getElementById("createDiscard");

    addItemsModal.addEventListener("click", function(){
        createItemsModal.classList.add("show");
    });

    discardItemsModal.addEventListener("click", function(){
        createItemsModal.classList.remove("show");
    });
    fetchItems();
});

function fetchItems(){
    fetch("../fetch/fetch_items.php")
    .then(response => response.json())
    .then(data => {
        const content = document.getElementById("content-container2");
        content.innerHTML = "";

        data.forEach((item) => {
            let li = document.createElement("li");
            li.textContent = `${item.name}`;

            li.addEventListener("click", function(){
                showModal(item);
            });
            content.prepend(li);
        });
    })
    .catch(error => console.error("Error fetching items", error));
}

function showModal(item){
    const name = document.getElementById("name-content");
    const modifItemModal = document.getElementById("modif-modal-container");
    const back = document.getElementById("back-content");

    name.textContent = `${item.name}`;

    document.getElementById("modifItemId").value = item.item_id;
    document.getElementById("modifItemName").value = item.name;
    document.getElementById("modifCostPrice").value = item.costPrice;
    document.getElementById("modifQuantity").value = item.quantity;
    document.getElementById("modifUnitPrice").value = item.unitPrice;
    document.getElementById("modifSku").value = item.sku;
    document.getElementById("modifReorderLevel").value = item.reorderLevel;
    document.getElementById("modifItemSupplier").value = item.supplier_id;
    document.getElementById("modifItemCategory").value = item.category_id;
    document.getElementById("modifItemWarehouse").value = item.warehouse_id;
    document.getElementById("modifItemStatus").value = item.status;

    modifItemModal.classList.add("show");

    back.addEventListener("click", function(event){
        event.preventDefault();
        modifItemModal.classList.remove("show");
    });

    const confirmSaveModal = document.getElementById("confirm-save-container");
    const modifSaveItemsModal = document.getElementById("modifSave");

    modifSaveItemsModal.addEventListener("click", function(event){
        event.preventDefault();
        document.getElementById("saveModifItemId").value = document.getElementById("modifItemId").value;
        document.getElementById("saveModifItemName").value = document.getElementById("modifItemName").value;
        document.getElementById("saveModifCostPrice").value = document.getElementById("modifCostPrice").value;
        document.getElementById("saveModifQuantity").value = document.getElementById("modifQuantity").value;
        document.getElementById("saveModifUnitPrice").value = document.getElementById("modifUnitPrice").value;
        document.getElementById("saveModifSku").value = document.getElementById("modifSku").value;
        document.getElementById("saveModifReorderLevel").value = document.getElementById("modifReorderLevel").value;
        document.getElementById("saveModifItemSupplier").value = document.getElementById("modifItemSupplier").value;
        document.getElementById("saveModifItemCategory").value = document.getElementById("modifItemCategory").value;
        document.getElementById("saveModifItemWarehouse").value = document.getElementById("modifItemWarehouse").value;
        document.getElementById("saveModifItemStatus").value = document.getElementById("modifItemStatus").value;
        confirmSaveModal.classList.add("show");
    });

    const confirmDeleteModal = document.getElementById("confirm-delete-container");
    const modifDeleteItemsModal = document.getElementById("modifDelete");

    modifDeleteItemsModal.addEventListener("click", function(event){
        event.preventDefault();
        document.getElementById("deleteItemsId").value = document.getElementById("modifItemId").value;
        confirmDeleteModal.classList.add("show");
    });

    const deleteItemsButton = document.getElementById("delete-button-submit");
    deleteItemsButton.addEventListener("click", function(){
        
        confirmDeleteModal.classList.remove("show");
        modifCategoriesModal.classList.remove("show");
    });

    const cancelDeleteButton = document.getElementById("cancel-button-delete");
    const cancelSaveButton = document.getElementById("cancel-button-save");

    cancelDeleteButton.addEventListener("click", function(event){
        event.preventDefault();
        confirmDeleteModal.classList.remove("show");
    });
    
    cancelSaveButton.addEventListener("click", function(event){
        event.preventDefault();
        confirmSaveModal.classList.remove("show");
    });
}