// ==========================================
// LIVE SEARCH - MAINTENANCE
// ==========================================

const searchInput = document.getElementById("search");

const clearButton = document.getElementById("clearSearch");

loadMaintenance();

searchInput.addEventListener("keyup", function(){

    const value = this.value.trim();

    loadMaintenance(value);

    if(value === ""){

        clearButton.style.display = "none";

    }else{

        clearButton.style.display = "flex";

    }

});

clearButton.addEventListener("click", function(){

    searchInput.value = "";

    clearButton.style.display = "none";

    loadMaintenance();

    searchInput.focus();

});

function loadMaintenance(search=""){

    const xhr = new XMLHttpRequest();

    xhr.open("POST","search_maintenance.php",true);

    xhr.setRequestHeader(
        "Content-type",
        "application/x-www-form-urlencoded"
    );

    xhr.onload=function(){

        if(this.status==200){

            document.getElementById("maintenanceTable").innerHTML=this.responseText;

        }

    };

    xhr.send("search="+encodeURIComponent(search));

}