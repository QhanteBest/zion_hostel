// ==========================================
// LIVE SEARCH - STAFF
// ==========================================

const searchInput = document.getElementById("search");

const clearButton = document.getElementById("clearSearch");

loadStaff();

searchInput.addEventListener("keyup", function(){

    const value = this.value.trim();

    loadStaff(value);

    if(value === ""){

        clearButton.style.display = "none";

    }else{

        clearButton.style.display = "flex";

    }

});

clearButton.addEventListener("click", function(){

    searchInput.value = "";

    clearButton.style.display = "none";

    loadStaff();

    searchInput.focus();

});

function loadStaff(search=""){

    const xhr = new XMLHttpRequest();

    xhr.open("POST","search_staff.php",true);

    xhr.setRequestHeader(
        "Content-type",
        "application/x-www-form-urlencoded"
    );

    xhr.onload=function(){

        if(this.status==200){

            document.getElementById("staffTable").innerHTML=this.responseText;

        }

    };

    xhr.send("search="+encodeURIComponent(search));

}