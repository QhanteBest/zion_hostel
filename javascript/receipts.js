// ==========================================
// LIVE SEARCH - RECEIPTS
// ==========================================

const searchInput = document.getElementById("search");

const clearButton = document.getElementById("clearSearch");

loadReceipts();

searchInput.addEventListener("keyup", function(){

    const value = this.value.trim();

    loadReceipts(value);

    if(value === ""){

        clearButton.style.display = "none";

    }else{

        clearButton.style.display = "flex";

    }

});

clearButton.addEventListener("click", function(){

    searchInput.value = "";

    clearButton.style.display = "none";

    loadReceipts();

    searchInput.focus();

});

function loadReceipts(search=""){

    const xhr = new XMLHttpRequest();

    xhr.open("POST","search_receipts.php",true);

    xhr.setRequestHeader(
        "Content-type",
        "application/x-www-form-urlencoded"
    );

    xhr.onload=function(){

        if(this.status==200){

            document.getElementById("receiptTable").innerHTML=this.responseText;

        }

    };

    xhr.send("search="+encodeURIComponent(search));

}