document.addEventListener("DOMContentLoaded", function(){
    const start = document.getElementById("start");
    start.addEventListener("click", function(event){
        event.preventDefault();
        window.location.href = "company.php";
    });
});