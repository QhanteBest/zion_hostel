// ==========================================
// LIVE SEARCH - STUDENTS
// ==========================================

const searchInput = document.getElementById("search");

const clearButton = document.getElementById("clearSearch");


// ==========================================
// LOAD STUDENTS WHEN PAGE OPENS
// ==========================================

loadStudents();


// ==========================================
// SEARCH WHILE TYPING
// ==========================================

searchInput.addEventListener("keyup", function(){

    const value = this.value.trim();

    loadStudents(value);

    if(value === ""){

        clearButton.style.display = "none";

    }else{

        clearButton.style.display = "flex";

    }

});


// ==========================================
// CLEAR SEARCH
// ==========================================

clearButton.addEventListener("click", function(){

    searchInput.value = "";

    clearButton.style.display = "none";

    loadStudents();

    searchInput.focus();

});


// ==========================================
// LOAD STUDENTS FUNCTION
// ==========================================

function loadStudents(search = ""){

    const xhr = new XMLHttpRequest();

    xhr.open("POST", "search_students.php", true);

    xhr.setRequestHeader(
        "Content-type",
        "application/x-www-form-urlencoded"
    );

    xhr.onload = function(){

        if(this.status == 200){

            document.getElementById("studentTable").innerHTML = this.responseText;

        }

    };

    xhr.send("search=" + encodeURIComponent(search));

}