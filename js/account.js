document.addEventListener("DOMContentLoaded", function () {

    const modal = document.getElementById("modal-container");
    const openBtn = document.getElementById("open");
    const closeBtn = document.getElementById("discard");
    const saveBtn = document.getElementById("save");
    const inputs = document.querySelectorAll(".required-input");
    

    openBtn.addEventListener("click", function () {
        modal.classList.add("show");
    });

    closeBtn.addEventListener("click", function () {
        modal.classList.remove("show");
        clearInputs();
    });

    saveBtn.addEventListener("click", function (event) {
        let allFilled = true;
        inputs.forEach(input => {
            if (input.value.trim() === "") {
                allFilled = false;
                input.classList.add("error");
            } else {
                input.classList.remove("error");
            }
        });

        if (allFilled) {
            modal.classList.remove("show");
        }
    });

    function clearInputs() {
        inputs.forEach(input => {
            input.value = "";
            input.classList.remove("error");
        });
    }

    

    fetchAccounts();
});

function fetchAccounts() {
    fetch("../fetch/fetch_account.php")
        .then(response => response.json())
        .then(data => {
            let content = document.getElementById("content");
            content.innerHTML = "";

            data.forEach((account) => {
                const accountModal = document.getElementById("modal-account-details");
                const back = document.getElementById("back-content");
                let li = document.createElement("li");
                li.classList.add("account-item");
                li.textContent = `${account.first_name} ${account.middle_name ? account.middle_name + " " : ""}${account.last_name}`;

                li.addEventListener("click", function () {
                    showModal(account, data);
                });

                back.addEventListener("click", function(){
                    
                    accountModal.classList.remove("show");
                    
        
                })

                

                content.prepend(li);
            });
        })
        .catch(error => console.error("Error fetching accounts:", error));
}

function showModal(account, data) {
    const accountModal = document.getElementById("modal-account-details");
    const name = document.getElementById("name-account");
    name.textContent = `${account.first_name} ${account.middle_name ? account.middle_name + " " : ""}${account.last_name}`;

    document.getElementById("accountId").value = account.account_id;
    document.getElementById("accountFirstName").value = account.first_name;
    document.getElementById("accountMiddleName").value = account.middle_name || "";
    document.getElementById("accountLastName").value = account.last_name;
    document.getElementById("accountEmail").value = account.email;
    document.getElementById("accountUsername").value = account.username;
    document.getElementById("accountAddress").value = account.address;
    document.getElementById("accountPassword").value = account.password;
    document.getElementById("accountGender").value = account.gender;
    document.getElementById("accountAccountType").value = account.account_type;
    document.getElementById("accountDateBirth").value = account.date_of_birth;

    accountModal.classList.add("show");

    const deleteButton = document.getElementById("accountDelete");
    const confirmDeleteModal = document.getElementById("confirm-delete-container");
    const cancel = document.getElementById("cancel-button-delete");
    let cancelClicked = false;

    deleteButton.addEventListener("click", function(event){
        event.preventDefault();
        document.getElementById("delete-accountId").value = account.account_id;
        confirmDeleteModal.classList.add("show");

    });

    cancel.addEventListener("click", function (event) {
        event.preventDefault();
        cancelClicked = true;
        confirmDeleteModal.classList.remove("show");

    });

    cancelClicked = false;

    const saveButton = document.getElementById("modifSave");
    const confirmSaveModal = document.getElementById("confirm-save-container");

    saveButton.addEventListener("click", function(event){
        event.preventDefault();
        document.getElementById("save-accountId").value = document.getElementById("accountId").value;
        document.getElementById("save-firstName").value = document.getElementById("accountFirstName").value;
        document.getElementById("save-middleName").value = document.getElementById("accountMiddleName").value;
        document.getElementById("save-lastName").value = document.getElementById("accountLastName").value;
        document.getElementById("save-email").value = document.getElementById("accountEmail").value;
        document.getElementById("save-address").value = document.getElementById("accountAddress").value;
        document.getElementById("save-username").value = document.getElementById("accountUsername").value;
        document.getElementById("save-password").value = document.getElementById("accountPassword").value;
        document.getElementById("save-gender").value = document.getElementById("accountGender").value;
        document.getElementById("save-accountType").value = document.getElementById("accountAccountType").value;
        document.getElementById("save-dateBirth").value = document.getElementById("accountDateBirth").value;
        confirmSaveModal.classList.add("show");
    });

    const deleteButtonSubmit = document.getElementById("confirm-delete-container");
    const warningDeleteButton = document.getElementById("warning-delete-pop-up");

    deleteButtonSubmit.addEventListener("click", function(event){
        if(data.length === 1 && cancelClicked === false){
            event.preventDefault();
            confirmDeleteModal.classList.remove("show");
            accountModal.classList.remove("show");
            setTimeout(() => {
                warningDeleteButton.classList.add("show"); // Show warning
    
                setTimeout(() => {
                    warningDeleteButton.classList.remove("show"); // Hide warning after 2s
                }, 2000);
            }, 100); // Initial delay before showing warning
        }
    });
    
    const cancelSaveButton = document.getElementById("cancel-button-save");

    cancelSaveButton.addEventListener("click", function(){
        event.preventDefault();
        confirmSaveModal.classList.remove("show");
    });

}

window.onclick = function (event) {
    const modal = document.getElementById("modal-account-details");
    if (event.target === modal) {
        
        modal.classList.remove("show");
    }
};