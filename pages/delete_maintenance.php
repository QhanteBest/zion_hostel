<?php

include "../includes/config.php";

if (!isset($_GET['id'])) {

    header("Location: maintenance.php");
    exit();

}

$Maintenance_ID = $_GET['id'];

// Check if the maintenance record exists
$check = mysqli_query($conn,
"SELECT * FROM maintenance
WHERE Maintenance_ID='$Maintenance_ID'");

if (mysqli_num_rows($check) == 0) {

    echo "<script>
    alert('Maintenance record not found.');
    window.location='maintenance.php';
    </script>";

    exit();

}

// Delete the maintenance record
$sql = "DELETE FROM maintenance
WHERE Maintenance_ID='$Maintenance_ID'";

if (mysqli_query($conn, $sql)) {

    header("Location: maintenance.php");
    exit();

} else {

    echo "Error deleting maintenance: " . mysqli_error($conn);

}

?>