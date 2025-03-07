document.addEventListener("DOMContentLoaded", function(){

    const createCategoriesModal = document.getElementById("modal-container");
    const addCategoriesModal = document.getElementById("open");
    const discardCategoriesModal = document.getElementById("createDiscard");

    addCategoriesModal.addEventListener("click", function(){
        createCategoriesModal.classList.add("show");
    });

    discardCategoriesModal.addEventListener("click", function(event){
        event.preventDefault();
        createCategoriesModal.classList.remove("show");
    });
    fetchCategories();

});

function fetchCategories(){
    fetch("../fetch/fetch_categories.php")
    .then(response => response.json())
    .then(data => {
        const content = document.getElementById("content-container2");
        content.innerHTML = "";

        data.forEach((category) =>{
            const modifCategoriesModal = document.getElementById("modif-modal-container");
            const back = document.getElementById("back-content");
            let li = document.createElement("li");
            li.textContent = `${category.name}`;

            li.addEventListener("click", function(){
                showModal(category);
            });

            back.addEventListener("click", function(){
                modifCategoriesModal.classList.remove("show");
            });
            content.prepend(li);
        });
    })
    .catch(error => console.error("Error fetching categories", error));
}

function showModal(category){
    const modifCategoriesModal = document.getElementById("modif-modal-container");
    const name = document.getElementById("name-content");
    name.textContent = `${category.name}`;

    document.getElementById("modifCategoryId").value = category.category_id;
    document.getElementById("modifCategoryName").value = category.name;
    document.getElementById("modifCategoryDescription").value = category.description;

    modifCategoriesModal.classList.add("show");

    const modifDeleteCategoriesModal = document.getElementById("modifDelete");
    const confirmDeleteModal = document.getElementById("confirm-delete-container");

    modifDeleteCategoriesModal.addEventListener("click", function(event){
        event.preventDefault();
        document.getElementById("delete-categoryId").value = category.category_id;
        confirmDeleteModal.classList.add("show");
    });

    const modifSaveCategoriesModal = document.getElementById("modifSave");
    const confirmSaveModal = document.getElementById("confirm-save-container");

    modifSaveCategoriesModal.addEventListener("click", function(event){
        event.preventDefault();
        document.getElementById("save-categoryId").value = document.getElementById("modifCategoryId").value;
        document.getElementById("save-categoryName").value = document.getElementById("modifCategoryName").value;
        document.getElementById("save-categoryDescription").value = document.getElementById("modifCategoryDescription").value;
        confirmSaveModal.classList.add("show");
    });

    const deleteCategoriesButton = document.getElementById("delete-button-submit");
    deleteCategoriesButton.addEventListener("click", function(){
        
        confirmDeleteModal.classList.remove("show");
        modifCategoriesModal.classList.remove("show");
    });

    const confirmCategoriesButton = document.getElementById("save-button-submit");
    confirmCategoriesButton.addEventListener("click", function(){
        confirmSaveModal.classList.remove("show");
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