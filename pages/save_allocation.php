<?php
include "../includes/auth.php";
include "../includes/config.php";

if (isset($_POST['student_id'])) {

    $student_id = $_POST['student_id'];
    $room_no = $_POST['room_no'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Check that End Date is after Start Date
    if ($end_date <= $start_date) {
        die("End Date must be later than Start Date.");
    }

    // Check if student already has a room
    $check_student = mysqli_query($conn,
        "SELECT * FROM allocation WHERE student_id='$student_id'");

    if (mysqli_num_rows($check_student) > 0) {
        die("This student has already been allocated a room.");
    }

    // Get the next Allocation ID
    $result = mysqli_query($conn,
        "SELECT MAX(allocation_id) AS max_id FROM allocation");

    $row = mysqli_fetch_assoc($result);

    if ($row['max_id'] == NULL) {
        $allocation_id = 30001;
    } else {
        $allocation_id = $row['max_id'] + 1;
    }

    // Insert Allocation
    $sql = "INSERT INTO allocation
    (allocation_id, start_date, end_date, student_id, room_no)
    VALUES
    ('$allocation_id','$start_date','$end_date','$student_id','$room_no')";

    if (mysqli_query($conn, $sql)) {

        // Increase room occupancy
        mysqli_query($conn,
        "UPDATE room
         SET current_occupancy = current_occupancy + 1
         WHERE room_no='$room_no'");

        // Get updated room details
        $room = mysqli_fetch_assoc(mysqli_query($conn,
        "SELECT capacity, current_occupancy
         FROM room
         WHERE room_no='$room_no'"));

        $capacity = $room['capacity'];
        $occupancy = $room['current_occupancy'];

        // Update room status automatically
        if ($occupancy == 0) {
            $status = "Vacant";
        } elseif ($occupancy < $capacity) {
            $status = "Occupied";
        } else {
            $status = "Full";
        }

        mysqli_query($conn,
        "UPDATE room
         SET status='$status'
         WHERE room_no='$room_no'");

        header("Location: allocation.php");
        exit();

    } else {

        echo "Error: " . mysqli_error($conn);

    }

}
?>