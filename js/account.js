document.addEventListener("DOMContentLoaded", function(){
    const open = document.getElementById("open");
    const createModalContainer = document.getElementById("modal-container");

    open.addEventListener("click", function(){
        createModalContainer.classList.add("show");

    });

    const discard = document.getElementById("discard");

    discard.addEventListener("click", function(event){
        event.preventDefault();
        createModalContainer.classList.remove("show");
    });
    fetchAccounts();
});

function fetchAccounts(){
    fetch("fetch/fetch_account.php")
    .then(response => response.json())
    .then(data =>{
        const tableContent = document.getElementById("table-content");
        // tableContent.innerHTML = "";
        data.forEach((accounts) =>{

            tableContent.innerHTML += `

            `;
        });
    
    })
    .catch(error => console.error("Error fetching accounts", error));
}