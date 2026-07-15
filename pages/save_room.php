<?php
include "../includes/auth.php";
include "../includes/config.php";

if (isset($_POST['room_no'])) {

    $room_no = $_POST['room_no'];
    $room_type = $_POST['room_type'];
    $capacity = $_POST['capacity'];
    $current_occupancy = $_POST['current_occupancy'];
    // Validate occupancy
    if ($current_occupancy > $capacity) {

    echo "<script>
            alert('Current Occupancy cannot be greater than Capacity.');
            window.history.back();
          </script>";
    exit();

}

    // Automatically determine room status
    if ($current_occupancy == 0) {
        $status = "Vacant";
    } elseif ($current_occupancy >= $capacity) {
        $status = "Full";
    } else {
        $status = "Occupied";
    }

    $sql = "INSERT INTO room
    (room_no, room_type, capacity, current_occupancy, status)
    VALUES
    ('$room_no','$room_type','$capacity','$current_occupancy','$status')";

    if (mysqli_query($conn, $sql)) {

        header("Location: rooms.php");
        exit();

    } else {

        echo "Error: " . mysqli_error($conn);

    }

}
?>