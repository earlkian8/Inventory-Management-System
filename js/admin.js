document.addEventListener("DOMContentLoaded", function(){
    const back = document.getElementById("back");
    back.addEventListener("click", function(event){
        event.preventDefault();
        window.location.href = "company.php";
    });
});