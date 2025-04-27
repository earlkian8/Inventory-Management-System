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

    fetchAccounts();
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

let allAccounts = [];

function fetchAccounts(){
    fetch("api/account_api.php")
    .then(response => response.json())
    .then(data =>{
        if(data.status === "success"){
            allAccounts = data.acc;
            const content = document.getElementById("content");
            content.innerHTML = "";
            data.acc.forEach(accounts =>{
                content.innerHTML += `
                    <tr class="tr-body-style" account-id="${accounts.account_id}">
                            <td class="td-style">${accounts.first_name} ${accounts.middle_name ? accounts.middle_name + " " : ""} ${accounts.last_name}</td>
                            <td class="td-style">${accounts.username}</td>
                            <td class="td-style">${accounts.account_type}</td>
                    </tr>
                `;
            });
        }

        document.querySelectorAll(".tr-body-style").forEach(button=>{
            button.addEventListener("click", function(){
                const accId = this.getAttribute("account-id");
                const accData = data.acc.find(a => a.account_id == accId);
                if(accData){
                    showEditModal(accData);
                }
            });
        });
    })
    .catch(error => console.error("Failed Fetching Accounts", error));
}

function showEditModal(accData){
    const modifModalContainer = document.getElementById("modif-modal-container");
    const overlay = document.getElementById("overlay");
    
    document.getElementById("modifAccountId").value = accData.account_id;
    document.getElementById("modifFirstName").value = accData.first_name;
    document.getElementById("modifMiddleName").value = accData.middle_name;
    document.getElementById("modifLastName").value = accData.last_name;
    document.getElementById("modifEmail").value = accData.email;
    document.getElementById("modifAddress").value = accData.address;
    document.getElementById("modifUsername").value = accData.username;
    document.getElementById("modifPassword").value = accData.password;
    document.getElementById("modifGender").value = accData.gender;
    document.getElementById("modifAccountType").value = accData.account_type;
    document.getElementById("modifDateOfBirth").value = accData.date_of_birth;
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
        document.getElementById("saveAccountId").value = accData.account_id;
        document.getElementById("saveFirstName").value = document.getElementById("modifFirstName").value;
        document.getElementById("saveMiddleName").value = document.getElementById("modifMiddleName").value;
        document.getElementById("saveLastName").value = document.getElementById("modifLastName").value;
        document.getElementById("saveEmail").value = document.getElementById("modifEmail").value;
        document.getElementById("saveAddress").value = document.getElementById("modifAddress").value;
        document.getElementById("saveUsername").value = document.getElementById("modifUsername").value;
        document.getElementById("savePassword").value = document.getElementById("modifPassword").value;
        document.getElementById("saveGender").value = document.getElementById("modifGender").value;
        document.getElementById("saveAccountType").value = document.getElementById("modifAccountType").value;
        document.getElementById("saveDateOfBirth").value = document.getElementById("modifDateOfBirth").value;
        confirmSaveContainer.classList.add("show");
        
    });

    const del = document.getElementById("delete");
    const confirmDeleteContainer = document.getElementById("confirm-delete-container");

    del.addEventListener("click", function(event){
        event.preventDefault();
        document.getElementById("deleteAccountId").value = accData.account_id;
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

// Goated DeepSeek
function searchAccounts() {
    const searchInput = document.getElementById("search").value.toLowerCase();
    const content = document.getElementById("content");
    
    if (!searchInput) {
        // If search is empty, show all accounts
        fetchAccounts();
        return;
    }
    
    // Filter accounts based on search input
    const filteredAccounts = allAccounts.filter(account => {
        const fullName = `${account.first_name} ${account.middle_name || ''} ${account.last_name}`.toLowerCase();
        return fullName.includes(searchInput) || 
               account.username.toLowerCase().includes(searchInput) || 
               account.account_type.toLowerCase().includes(searchInput);
    });
    
    // Display filtered accounts
    content.innerHTML = "";
    filteredAccounts.forEach(account => {
        content.innerHTML += `
            <tr class="tr-body-style" account-id="${account.account_id}">
                <td class="td-style">${account.first_name} ${account.middle_name ? account.middle_name + " " : ""} ${account.last_name}</td>
                <td class="td-style">${account.username}</td>
                <td class="td-style">${account.account_type}</td>
            </tr>
        `;
    });
    
    // Reattach event listeners to the filtered rows
    document.querySelectorAll(".tr-body-style").forEach(button => {
        button.addEventListener("click", function() {
            const accId = this.getAttribute("account-id");
            const accData = allAccounts.find(a => a.account_id == accId);
            if(accData) {
                showEditModal(accData);
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