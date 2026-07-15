<?php
include "../includes/auth.php";
include "../includes/config.php";

if (isset($_POST['update'])) {

    $Complaint_ID = $_POST['Complaint_ID'];
    $Description = $_POST['Description'];
    $Status = $_POST['Status'];
    $Student_ID = $_POST['Student_ID'];
    $Staff_ID = $_POST['Staff_ID'];

    $sql = "UPDATE complaint SET
            Description='$Description',
            Status='$Status',
            Student_ID='$Student_ID',
            Staff_ID='$Staff_ID'
            WHERE Complaint_ID='$Complaint_ID'";

    if (mysqli_query($conn, $sql)) {

        header("Location: complaints.php");
        exit();

    } else {

        echo "Error updating complaint: " . mysqli_error($conn);

    }

} else {

    header("Location: complaints.php");
    exit();

}

?>