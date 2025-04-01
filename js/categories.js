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

    fetchCategories();
});

let allCategories = [];
function fetchCategories(){
    fetch("api/category_api.php")
    .then(response => response.json())
    .then(data =>{
        if(data.status === "success"){
            allCategories = data.categories;
            const content = document.getElementById("content");
            content.innerHTML = "";
            data.categories.forEach(category =>{
                content.innerHTML += `
                    <tr class="tr-body-style" category-id="${category.category_id}">
                            <td class="td-style">${category.name}</td>
                            <td class="td-style">${category.description}</td>
                    </tr>
                `;
            });
        }

        document.querySelectorAll(".tr-body-style").forEach(button =>{
            button.addEventListener("click", function(){
                const catId = this.getAttribute("category-id");
                const categoriesData = data.categories.find(c => c.category_id == catId);
                if(categoriesData){
                    showEditModal(categoriesData);
                }else{
                    console.log("n/a");
                }
            });
        });
    })
    .catch(error => console.error("Failed Fetching Categories", error));
}

function showEditModal(categories){
    const modifModalContainer = document.getElementById("modif-modal-container");
    const overlay = document.getElementById("overlay");
    
    document.getElementById("modifName").value = categories.name;
    document.getElementById("modifDescription").value = categories.description;
    
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
        document.getElementById("saveCategoryId").value = categories.category_id;
        document.getElementById("saveName").value = document.getElementById("modifName").value;
        document.getElementById("saveDescription").value = document.getElementById("modifDescription").value;
        confirmSaveContainer.classList.add("show");
        
    });

    const del = document.getElementById("delete");
    const confirmDeleteContainer = document.getElementById("confirm-delete-container");

    del.addEventListener("click", function(event){
        event.preventDefault();
        document.getElementById("deleteCategoryId").value = categories.category_id;
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

function searchCategories() {
    const searchInput = document.getElementById("search").value.toLowerCase();
    const content = document.getElementById("content");
    
    if (!searchInput) {
        // If search is empty, show all categories
        fetchCategories();
        return;
    }
    
    // Filter categories based on name only
    const filteredCategories = allCategories.filter(category => {
        return category.name.toLowerCase().includes(searchInput);
    });
    
    // Display filtered categories
    content.innerHTML = "";
    filteredCategories.forEach(category => {
        content.innerHTML += `
            <tr class="tr-body-style" category-id="${category.category_id}">
                <td class="td-style">${category.name}</td>
                <td class="td-style">${category.description || ''}</td>
            </tr>
        `;
    });
    
    // Reattach event listeners to the filtered rows
    document.querySelectorAll(".tr-body-style").forEach(button => {
        button.addEventListener("click", function() {
            const catId = this.getAttribute("category-id");
            const catData = allCategories.find(c => c.category_id == catId);
            if(catData) {
                showEditModal(catData);
            }
        });
    });
}