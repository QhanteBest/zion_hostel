<?php

include "../includes/config.php";

if (!isset($_GET['id'])) {

    header("Location: staff.php");
    exit();

}

$staff_id = $_GET['id'];

/* Optional safety check: ensure staff exists */
$check = mysqli_query($conn,
"SELECT * FROM staff WHERE staff_id='$staff_id'");

if (mysqli_num_rows($check) == 0) {

    echo "<script>
    alert('Staff not found.');
    window.location='staff.php';
    </script>";

    exit();
}

/* Delete staff */
$sql = "DELETE FROM staff WHERE staff_id='$staff_id'";

if (mysqli_query($conn, $sql)) {

    header("Location: staff.php");
    exit();

} else {

    echo "Error deleting staff: " . mysqli_error($conn);

}

?>