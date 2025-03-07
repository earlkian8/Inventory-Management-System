document.addEventListener("DOMContentLoaded", function(){

    const addSupplierButton = document.getElementById("open");
    const createSupplierModal = document.getElementById("modal-container");
    const discardSupplierButton = document.getElementById("createDiscard");

    addSupplierButton.addEventListener("click", function(){
        createSupplierModal.classList.add("show");
    });

    discardSupplierButton.addEventListener("click", function(){
        createSupplierModal.classList.remove("show");
    });
    fetchSuppliers();
});

function fetchSuppliers(){
    fetch("../fetch/fetch_suppliers.php")
    .then(response => response.json())
    .then(data => {
        let content = document.getElementById("content-container2");
        content.innerHTML = "";

        data.forEach((supplier) =>{
            const modifSupplierModal = document.getElementById("modif-modal-container");
            const back = document.getElementById("back-content");

            let li = document.createElement("li");
            li.textContent = `${supplier.name}`;

            li.addEventListener("click", function(){
                showModal(supplier);
            });

            back.addEventListener("click", function(){
                modifSupplierModal.classList.remove("show");
            });

            content.prepend(li);
        });
    })
    .catch(error => console.error("Error fetching suppliers", error));
}

function showModal(supplier){

    const modifSupplierModal = document.getElementById("modif-modal-container");
    const name = document.getElementById("name-content");
    name.textContent = supplier.name;
    document.getElementById("modifSupplierId").value = supplier.supplier_id;
    document.getElementById("modifSupplierName").value = supplier.name;
    document.getElementById("modifSupplierEmail").value = supplier.email;
    document.getElementById("modifSupplierContactPerson").value = supplier.contact_person;
    document.getElementById("modifSupplierAddress").value = supplier.address;
    document.getElementById("modifSupplierPaymentTerms").value = supplier.payment_terms;
    modifSupplierModal.classList.add("show");

    const modifDeleteSupplierModal = document.getElementById("modifDelete");
    const confirmDeleteModal = document.getElementById("confirm-delete-container");

    modifDeleteSupplierModal.addEventListener("click", function(event){
        event.preventDefault();
        document.getElementById("delete-supplierId").value = supplier.supplier_id;
        confirmDeleteModal.classList.add("show");
    });

    const deleteSupplierButton = document.getElementById("delete-button-submit");
    deleteSupplierButton.addEventListener("click", function(){
        
        confirmDeleteModal.classList.remove("show");
        modifSupplierModal.classList.remove("show");
    });

    const modifSaveSupplierModal = document.getElementById("modifSave");
    const confirmSaveModal = document.getElementById("confirm-save-container");
    
    modifSaveSupplierModal.addEventListener("click", function(event){
        event.preventDefault();
        document.getElementById("save-supplierId").value = document.getElementById("modifSupplierId").value;
        document.getElementById("save-supplierName").value = document.getElementById("modifSupplierName").value;
        document.getElementById("save-supplierEmail").value = document.getElementById("modifSupplierEmail").value;
        document.getElementById("save-supplierContactPerson").value = document.getElementById("modifSupplierContactPerson").value;
        document.getElementById("save-supplierAddress").value = document.getElementById("modifSupplierAddress").value;
        document.getElementById("save-supplierPaymentTerms").value = document.getElementById("modifSupplierPaymentTerms").value;
        confirmSaveModal.classList.add("show");
    });

    const confirmSupplierButton = document.getElementById("save-button-submit");

    confirmSupplierButton.addEventListener("click", function(){
        confirmSaveModal.classList.remove("show");
        modifSupplierModal.classList.remove("show");
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