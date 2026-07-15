// ==========================================
// LIVE SEARCH - PAYMENTS
// ==========================================

const searchInput = document.getElementById("search");

const clearButton = document.getElementById("clearSearch");

loadPayments();

searchInput.addEventListener("keyup", function(){

    const value = this.value.trim();

    loadPayments(value);

    if(value === ""){

        clearButton.style.display = "none";

    }else{

        clearButton.style.display = "flex";

    }

});

clearButton.addEventListener("click", function(){

    searchInput.value = "";

    clearButton.style.display = "none";

    loadPayments();

    searchInput.focus();

});

function loadPayments(search=""){

    const xhr = new XMLHttpRequest();

    xhr.open("POST","search_payments.php",true);

    xhr.setRequestHeader(
        "Content-type",
        "application/x-www-form-urlencoded"
    );

    xhr.onload=function(){

        if(this.status==200){

            document.getElementById("paymentTable").innerHTML=this.responseText;

        }

    };

    xhr.send("search="+encodeURIComponent(search));

}