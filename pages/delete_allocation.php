<?php

include "../includes/config.php";

if (isset($_GET['id'])) {

    $allocation_id = $_GET['id'];

    // Get the room number before deleting
    $result = mysqli_query($conn,
    "SELECT room_no FROM allocation
     WHERE allocation_id='$allocation_id'");

    $allocation = mysqli_fetch_assoc($result);

    if (!$allocation) {
        header("Location: allocation.php");
        exit();
    }

    $room_no = $allocation['room_no'];

    // Delete the allocation
    mysqli_query($conn,
    "DELETE FROM allocation
     WHERE allocation_id='$allocation_id'");

    // Reduce room occupancy
    mysqli_query($conn,
    "UPDATE room
     SET current_occupancy=current_occupancy-1
     WHERE room_no='$room_no'");

    // Get updated room information
    $room = mysqli_fetch_assoc(mysqli_query($conn,
    "SELECT capacity,current_occupancy
     FROM room
     WHERE room_no='$room_no'"));

    $capacity = $room['capacity'];
    $occupancy = $room['current_occupancy'];

    // Determine new status
    if ($occupancy <= 0) {

        $occupancy = 0;

        mysqli_query($conn,
        "UPDATE room
         SET current_occupancy=0,
             status='Vacant'
         WHERE room_no='$room_no'");

    }
    elseif ($occupancy < $capacity) {

        mysqli_query($conn,
        "UPDATE room
         SET status='Occupied'
         WHERE room_no='$room_no'");

    }
    else {

        mysqli_query($conn,
        "UPDATE room
         SET status='Full'
         WHERE room_no='$room_no'");

    }

    header("Location: allocation.php");
    exit();

}
?>