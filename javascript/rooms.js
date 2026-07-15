// ==========================================
// LIVE SEARCH - ROOMS
// ==========================================

const searchInput = document.getElementById("search");

const clearButton = document.getElementById("clearSearch");

loadRooms();

searchInput.addEventListener("keyup", function(){

    const value = this.value.trim();

    loadRooms(value);

    if(value === ""){

        clearButton.style.display = "none";

    }else{

        clearButton.style.display = "flex";

    }

});

clearButton.addEventListener("click", function(){

    searchInput.value = "";

    clearButton.style.display = "none";

    loadRooms();

    searchInput.focus();

});

function loadRooms(search = ""){

    const xhr = new XMLHttpRequest();

    xhr.open("POST", "search_rooms.php", true);

    xhr.setRequestHeader(
        "Content-type",
        "application/x-www-form-urlencoded"
    );

    xhr.onload = function(){

        if(this.status == 200){

            document.getElementById("roomTable").innerHTML = this.responseText;

        }

    };

    xhr.send("search=" + encodeURIComponent(search));

}