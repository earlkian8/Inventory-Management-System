document.addEventListener("DOMContentLoaded", function(){
    fetchCompany();
});

function fetchCompany(){
    fetch("../api/company_api.php")
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            const companyName = document.getElementById("company-name");
            companyName.innerHTML = data.company.name;
        }
    })
    .catch(error => console.error("Error fetching company", error));
}