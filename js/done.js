document.addEventListener("DOMContentLoaded", function(){
    const finish = document.getElementById("finish");

    finish.addEventListener("click", function(event){
        event.preventDefault();
        window.location.href = "../index.php";
    });
});