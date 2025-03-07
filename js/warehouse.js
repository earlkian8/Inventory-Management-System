document.addEventListener("DOMContentLoaded", function(){

    const createWarehouseModal = document.getElementById("modal-container");
    const addWarehouseButton = document.getElementById("open");
    const discardWarehouseButton = document.getElementById("createDiscard");
    addWarehouseButton.addEventListener("click", function(){
        createWarehouseModal.classList.add("show");
    });

    discardWarehouseButton.addEventListener("click", function(){
        createWarehouseModal.classList.remove("show");
    });
    fetchWarehouse();
})

function fetchWarehouse(){
    fetch("../fetch/fetch_warehouse.php")
    .then(response => response.json())
    .then(data =>{
        let content = document.getElementById("content-container2");
        content.innerHTML = "";

        data.forEach((warehouse) => {
            const modifWarehouseModal = document.getElementById("modif-modal-container");
            const back = document.getElementById("back-content");
            let li = document.createElement("li");
            li.textContent = `${warehouse.name}`;

            li.addEventListener("click", function(){
                showModal(warehouse);
            });

            back.addEventListener("click", function(){
                modifWarehouseModal.classList.remove("show");
            });

            content.prepend(li);
        });
    })
    .catch(error => console.error("Error fetching warehouse", error));
}

function showModal(warehouse){
    const modifWarehouseModal = document.getElementById("modif-modal-container");
    const name = document.getElementById("name-content");
    name.textContent = `${warehouse.name}`;
    document.getElementById("modifWarehouseId").value = warehouse.warehouse_id;
    document.getElementById("modifWarehouseName").value = warehouse.name;
    document.getElementById("modifMaximumStockLevel").value = warehouse.max_stock_level;
    document.getElementById("modifWarehouseAddress").value = warehouse.address;
    document.getElementById("modifWarehouseManager").value = warehouse.warehouse_manager;
    document.getElementById("modifWarehouseStatus").value = warehouse.status;

    modifWarehouseModal.classList.add("show");

    const modifDeleteWarehouseModal = document.getElementById("modifDelete");
    const confirmDeleteModal = document.getElementById("confirm-delete-container");

    modifDeleteWarehouseModal.addEventListener("click", function(event){
        event.preventDefault();
        document.getElementById("delete-warehouseId").value = warehouse.warehouse_id;
        confirmDeleteModal.classList.add("show");
    });

    const deleteWarehouseButton = document.getElementById("delete-button-submit");
    deleteWarehouseButton.addEventListener("click", function(){
        
        confirmDeleteModal.classList.remove("show");
        modifWarehouseModal.classList.remove("show");
    });

    const modifSaveWarehouseModal = document.getElementById("modifSave");
    const confirmSaveModal = document.getElementById("confirm-save-container");
    
    modifSaveWarehouseModal.addEventListener("click", function(event){
        event.preventDefault();
        document.getElementById("save-warehouseId").value = document.getElementById("modifWarehouseId").value;
        document.getElementById("save-warehouseName").value = document.getElementById("modifWarehouseName").value;
        document.getElementById("save-maximumStockLevel").value = document.getElementById("modifMaximumStockLevel").value;
        document.getElementById("save-warehouseAddress").value = document.getElementById("modifWarehouseAddress").value;
        document.getElementById("save-warehouseManager").value = document.getElementById("modifWarehouseManager").value;
        document.getElementById("save-warehouseStatus").value = document.getElementById("modifWarehouseStatus").value;
        confirmSaveModal.classList.add("show");
    });

    const confirmWarehouseButton = document.getElementById("save-button-submit");

    confirmWarehouseButton.addEventListener("click", function(){
        confirmmSaveModal.classList.remove("show");
        modifWarehouseModal.classList.remove("show");
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