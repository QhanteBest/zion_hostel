<?php

include "../includes/config.php";

if (isset($_POST['update'])) {

    $Maintenance_ID = $_POST['Maintenance_ID'];
    $Maintenance_Type = $_POST['Maintenance_Type'];
    $Maintenance_Status = $_POST['Maintenance_Status'];
    $Room_no = $_POST['Room_no'];
    $Staff_ID = $_POST['Staff_ID'];

    $sql = "UPDATE maintenance SET
            Maintenance_Type='$Maintenance_Type',
            Maintenance_Status='$Maintenance_Status',
            Room_no='$Room_no',
            Staff_ID='$Staff_ID'
            WHERE Maintenance_ID='$Maintenance_ID'";

    if (mysqli_query($conn, $sql)) {

        header("Location: maintenance.php");
        exit();

    } else {

        echo "Error updating maintenance: " . mysqli_error($conn);

    }

} else {

    header("Location: maintenance.php");
    exit();

}

?>