<?php
include "../includes/auth.php";
include "../includes/config.php";

if (isset($_POST['staff_id'])) {

    $staff_id = $_POST['staff_id'];
    $staff_fname = $_POST['staff_fname'];
    $staff_lname = $_POST['staff_lname'];
    $staff_phone_number = $_POST['staff_phone_number'];
    $staff_role = $_POST['staff_role'];

    // Check if Staff ID already exists
    $check = mysqli_query($conn,
    "SELECT * FROM staff
    WHERE staff_id='$staff_id'");

    if (mysqli_num_rows($check) > 0) {

        echo "<script>
        alert('Staff ID already exists.');
        window.location='add_staff.php';
        </script>";

        exit();
    }

    $sql = "INSERT INTO staff
    (staff_id, staff_fname, staff_lname, staff_phone_number, staff_role)
    VALUES
    ('$staff_id',
    '$staff_fname',
    '$staff_lname',
    '$staff_phone_number',
    '$staff_role')";

    if (mysqli_query($conn, $sql)) {

        header("Location: staff.php");
        exit();

    } else {

        echo "Error: " . mysqli_error($conn);

    }

}
?>