// ==========================================
// LIVE SEARCH - REPORTS
// ==========================================

const searchInput = document.getElementById("search");

const clearButton = document.getElementById("clearSearch");

loadReports();

searchInput.addEventListener("keyup", function(){

    const value = this.value.trim();

    loadReports(value);

    if(value === ""){

        clearButton.style.display = "none";

    }else{

        clearButton.style.display = "flex";

    }

});

clearButton.addEventListener("click", function(){

    searchInput.value = "";

    clearButton.style.display = "none";

    loadReports();

    searchInput.focus();

});

function loadReports(search=""){

    const xhr = new XMLHttpRequest();

    xhr.open("POST","search_reports.php",true);

    xhr.setRequestHeader(
        "Content-type",
        "application/x-www-form-urlencoded"
    );

    xhr.onload=function(){

        if(this.status==200){

            document.getElementById("reportTable").innerHTML=this.responseText;

        }

    };

    xhr.send("search="+encodeURIComponent(search));

}