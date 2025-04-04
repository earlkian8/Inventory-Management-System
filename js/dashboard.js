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

    fetchAccountCount();
    fetchSupplierCount();
    fetchCategoryCount();
    fetchItemCount();
    fetchItemLowCount();
    fetchItemOutCount();
});

function fetchAccountCount(){
    fetch("api/account_count_api.php")
    .then(response => response.json())
    .then(data =>{
        if(data.status === "success"){
            const accountCount = document.getElementById('accountCount');
            accountCount.innerHTML = "";
            accountCount.innerHTML = data.accCount.count;
        }
    })
    .catch(error => console.error("Failed Fetching Dashboard", error));
}

function fetchSupplierCount(){
    fetch("api/supplier_count_api.php")
    .then(response => response.json())
    .then(data =>{
        if(data.status === "success"){
            const supplierCount = document.getElementById('supplierCount');
            supplierCount.innerHTML = "";
            supplierCount.innerHTML = data.supCount.count;
        }
    })
    .catch(error => console.error("Failed Fetching Dashboard", error));
}

function fetchCategoryCount(){
    fetch("api/category_count_api.php")
    .then(response => response.json())
    .then(data =>{
        if(data.status === "success"){
            const categoryCount = document.getElementById('categoryCount');
            categoryCount.innerHTML = "";
            categoryCount.innerHTML = data.catCount.count;
        }
    })
    .catch(error => console.error("Failed Fetching Dashboard", error));
}

function fetchItemCount(){
    fetch("api/item_count_api.php")
    .then(response => response.json())
    .then(data =>{
        if(data.status === "success"){
            const itemCount = document.getElementById('itemCount');
            itemCount.innerHTML = "";
            itemCount.innerHTML = data.itemCount.count;
        }
    })
    .catch(error => console.error("Failed Fetching Dashboard", error));
}

function fetchItemLowCount(){
    fetch("api/item_count_low_api.php")
    .then(response => response.json())
    .then(data =>{
        if(data.status === "success"){
            const itemLowCount = document.getElementById('itemLowCount');
            itemLowCount.innerHTML = "";
            itemLowCount.innerHTML = data.itemLowCount.count;
        }
    })
    .catch(error => console.error("Failed Fetching Dashboard", error));
}

function fetchItemOutCount(){
    fetch("api/item_count_out_api.php")
    .then(response => response.json())
    .then(data =>{
        if(data.status === "success"){
            const itemOutCount = document.getElementById('itemOutCount');
            itemOutCount.innerHTML = "";
            itemOutCount.innerHTML = data.itemOutCount.count;
        }
    })
    .catch(error => console.error("Failed Fetching Dashboard", error));
}