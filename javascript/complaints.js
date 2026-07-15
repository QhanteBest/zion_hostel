// ==========================================
// LIVE SEARCH - COMPLAINTS
// ==========================================

const searchInput = document.getElementById("search");

const clearButton = document.getElementById("clearSearch");

loadComplaints();

searchInput.addEventListener("keyup", function(){

    const value = this.value.trim();

    loadComplaints(value);

    if(value === ""){

        clearButton.style.display = "none";

    }else{

        clearButton.style.display = "flex";

    }

});

clearButton.addEventListener("click", function(){

    searchInput.value = "";

    clearButton.style.display = "none";

    loadComplaints();

    searchInput.focus();

});

function loadComplaints(search=""){

    const xhr = new XMLHttpRequest();

    xhr.open("POST","search_complaints.php",true);

    xhr.setRequestHeader(
        "Content-type",
        "application/x-www-form-urlencoded"
    );

    xhr.onload = function(){

        if(this.status == 200){

            document.getElementById("complaintTable").innerHTML = this.responseText;

        }

    };

    xhr.send("search=" + encodeURIComponent(search));

}