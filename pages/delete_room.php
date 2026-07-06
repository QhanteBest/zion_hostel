<?php

include "../includes/config.php";

$room_no = $_GET['id'];

// Check if the room is allocated to any student
$check = mysqli_query($conn,
"SELECT * FROM allocation
WHERE room_no='$room_no'");

if (mysqli_num_rows($check) > 0) {

    echo "<script>
    alert('Cannot delete this room because students are allocated to it.');
    window.location='rooms.php';
    </script>";

    exit();
}

// If there are no allocations, delete the room
mysqli_query($conn,
"DELETE FROM room
WHERE room_no='$room_no'");

header("Location: rooms.php");
exit();

?>