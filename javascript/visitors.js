// ==========================================
// LIVE SEARCH - VISITORS
// ==========================================

const searchInput = document.getElementById("search");

const clearButton = document.getElementById("clearSearch");

loadVisitors();

searchInput.addEventListener("keyup", function(){

    const value = this.value.trim();

    loadVisitors(value);

    if(value === ""){

        clearButton.style.display = "none";

    }else{

        clearButton.style.display = "flex";

    }

});

clearButton.addEventListener("click", function(){

    searchInput.value = "";

    clearButton.style.display = "none";

    loadVisitors();

    searchInput.focus();

});

function loadVisitors(search=""){

    const xhr = new XMLHttpRequest();

    xhr.open("POST","search_visitors.php",true);

    xhr.setRequestHeader(
        "Content-type",
        "application/x-www-form-urlencoded"
    );

    xhr.onload=function(){

        if(this.status==200){

            document.getElementById("visitorTable").innerHTML=this.responseText;

        }

    };

    xhr.send("search="+encodeURIComponent(search));

}