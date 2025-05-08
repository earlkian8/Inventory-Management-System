document.addEventListener('DOMContentLoaded', function() {
    document.getElementById("passwordForm").addEventListener("submit", function(event){
        event.preventDefault();
        if(document.getElementById("new-password").value === document.getElementById("confirm-password").value){
            updatePassword();
        }else{
            alert("Password does not match");
        }
    });
});

function updatePassword(){
    const url = new URL(window.location.href);
    const emailData = url.searchParams.get("email");

    const formData = {
        email: emailData,
        password: document.getElementById("confirm-password").value
    }

    fetch("../api/account_api.php", {
        method: "POST",
        body: JSON.stringify(formData),
        headers: {"Content-Type": "application/json"}
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            alert("Updated Successfully!");
            window.location.href = '../login.php';
        }
    })
    .catch(error => console.error(error));
}

