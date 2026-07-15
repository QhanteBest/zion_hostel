// ==========================================
// LIVE SEARCH - ROOM ALLOCATION
// ==========================================

const searchInput = document.getElementById("search");

const clearButton = document.getElementById("clearSearch");

loadAllocations();

searchInput.addEventListener("keyup", function(){

    const value = this.value.trim();

    loadAllocations(value);

    if(value === ""){

        clearButton.style.display = "none";

    }else{

        clearButton.style.display = "flex";

    }

});

clearButton.addEventListener("click", function(){

    searchInput.value = "";

    clearButton.style.display = "none";

    loadAllocations();

    searchInput.focus();

});

function loadAllocations(search=""){

    const xhr = new XMLHttpRequest();

    xhr.open("POST","search_allocation.php",true);

    xhr.setRequestHeader(
        "Content-type",
        "application/x-www-form-urlencoded"
    );

    xhr.onload=function(){

        if(this.status==200){

            document.getElementById("allocationTable").innerHTML=this.responseText;

        }

    };

    xhr.send("search="+encodeURIComponent(search));

}