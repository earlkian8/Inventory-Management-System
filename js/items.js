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

let allItems = []
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
                    <tr class="tr-body-style" supplier-id="${item.item_id}">
                            <td class="td-style">${item.name}</td>
                            <td class="td-style">${item.costPrice}</td>
                            <td class="td-style">${item.unitPrice}</td>
                            <td class="td-style">${item.quantity}</td>
                            <td class="td-style">${item.supplierName}</td>
                            <td class="td-style">${item.categoryName}</td>
                            <td class="td-style">${item.status}</td>
                    </tr>
                `;
            });
        }
    })
    .catch(error => console.error("Failed Fetching Items", error));
}