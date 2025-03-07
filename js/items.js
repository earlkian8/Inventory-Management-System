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

        data.forEach((items) =>{
            name.textContent = `${items.name}`;
            let li = document.createElement("li");
            li.textContent = `${items.name}`;

            li.addEventListener("click", function(){
                showModal(items);
            });
            content.prepend(li);

        });
    })
    .catch(error => console.error("Error fetching items", error));
}

function showModal(items){
    const name = document.getElementById("name-content");
    const modifItemModal = document.getElementById("modif-modal-container");
    name.textContent = `${items.name}`;

    document.getElementById("modifItemId").value = items.item_id;
    document.getElementById("modifItemName").value = items.name;
    document.getElementById("modifCostPrice").value = items.costPrice;
    document.getElementById("modifQuantity").value = items.quantity;
    document.getElementById("modifUnitPrice").value = items.unitPrice;
    document.getElementById("modifSku").value = items.sku;
    document.getElementById("modifReorderLevel").value = items.reorderLevel;
    document.getElementById("modifItemSupplier").value = items.name;
    document.getElementById("modifItemCategory").value = items.name;
    document.getElementById("modifItemWarehouse").value = items.name;
    document.getElementById("modifItemStatus").value = items.name;

    modifItemModal.classList.add("show");
}