<?php

include "../includes/config.php";

if (isset($_POST['Maintenance_ID'])) {

    $Maintenance_ID = $_POST['Maintenance_ID'];
    $Maintenance_Type = $_POST['Maintenance_Type'];
    $Maintenance_Status = $_POST['Maintenance_Status'];
    $Room_no = $_POST['Room_no'];
    $Staff_ID = $_POST['Staff_ID'];

    // Check if Maintenance ID already exists
    $check = mysqli_query($conn,
    "SELECT * FROM maintenance
    WHERE Maintenance_ID='$Maintenance_ID'");

    if (mysqli_num_rows($check) > 0) {

        echo "<script>
        alert('Maintenance ID already exists.');
        window.location='add_maintenance.php';
        </script>";

        exit();

    }

    $sql = "INSERT INTO maintenance
    (Maintenance_ID, Maintenance_Type, Maintenance_Status, Room_no, Staff_ID)
    VALUES
    ('$Maintenance_ID',
    '$Maintenance_Type',
    '$Maintenance_Status',
    '$Room_no',
    '$Staff_ID')";

    if (mysqli_query($conn, $sql)) {

        header("Location: maintenance.php");
        exit();

    } else {

        echo "Error: " . mysqli_error($conn);

    }

}

?>