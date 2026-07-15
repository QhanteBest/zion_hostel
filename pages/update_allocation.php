<?php
include "../includes/auth.php";
include "../includes/config.php";

if (isset($_POST['update'])) {

    $allocation_id = $_POST['allocation_id'];
    $student_id = $_POST['student_id'];
    $room_no = $_POST['room_no'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    if ($end_date <= $start_date) {
        die("End Date must be later than Start Date.");
    }

    // Get the old room
    $old = mysqli_fetch_assoc(mysqli_query($conn,
    "SELECT room_no
     FROM allocation
     WHERE allocation_id='$allocation_id'"));

    $old_room = $old['room_no'];

    // If room has changed
    if ($old_room != $room_no) {

        // Reduce old room occupancy
        mysqli_query($conn,
        "UPDATE room
         SET current_occupancy=current_occupancy-1
         WHERE room_no='$old_room'");

        // Increase new room occupancy
        mysqli_query($conn,
        "UPDATE room
         SET current_occupancy=current_occupancy+1
         WHERE room_no='$room_no'");
    }

    // Update allocation
    mysqli_query($conn,
    "UPDATE allocation SET
        student_id='$student_id',
        room_no='$room_no',
        start_date='$start_date',
        end_date='$end_date'
     WHERE allocation_id='$allocation_id'");

    // Recalculate status for both rooms
    $rooms = array($old_room, $room_no);

    foreach ($rooms as $r) {

        $data = mysqli_fetch_assoc(mysqli_query($conn,
        "SELECT capacity, current_occupancy
         FROM room
         WHERE room_no='$r'"));

        $capacity = $data['capacity'];
        $occupancy = $data['current_occupancy'];

        if ($occupancy <= 0) {

            $occupancy = 0;

            mysqli_query($conn,
            "UPDATE room
             SET current_occupancy=0,
                 status='Vacant'
             WHERE room_no='$r'");

        }
        elseif ($occupancy < $capacity) {

            mysqli_query($conn,
            "UPDATE room
             SET status='Occupied'
             WHERE room_no='$r'");

        }
        else {

            mysqli_query($conn,
            "UPDATE room
             SET status='Full'
             WHERE room_no='$r'");

        }

    }

    header("Location: allocation.php");
    exit();
}
?>