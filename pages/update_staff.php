<?php

include "../includes/config.php";

if (isset($_POST['update'])) {

    $staff_id = $_POST['staff_id'];
    $staff_fname = $_POST['staff_fname'];
    $staff_lname = $_POST['staff_lname'];
    $staff_phone_number = $_POST['staff_phone_number'];
    $staff_role = $_POST['staff_role'];

    $sql = "UPDATE staff SET
            staff_fname='$staff_fname',
            staff_lname='$staff_lname',
            staff_phone_number='$staff_phone_number',
            staff_role='$staff_role'
            WHERE staff_id='$staff_id'";

    if (mysqli_query($conn, $sql)) {

        header("Location: staff.php");
        exit();

    } else {

        echo "Error updating staff: " . mysqli_error($conn);

    }

} else {

    header("Location: staff.php");
    exit();

}

?>