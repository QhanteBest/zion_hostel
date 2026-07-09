<?php

include "../includes/config.php";

if (isset($_POST['Complaint_ID'])) {

    $Complaint_ID = $_POST['Complaint_ID'];
    $Description = $_POST['Description'];
    $Status = $_POST['Status'];
    $Student_ID = $_POST['Student_ID'];
    $Staff_ID = $_POST['Staff_ID'];

    // Check if Complaint ID already exists
    $check = mysqli_query($conn,
    "SELECT * FROM complaint
    WHERE Complaint_ID='$Complaint_ID'");

    if (mysqli_num_rows($check) > 0) {

        echo "<script>
        alert('Complaint ID already exists.');
        window.location='add_complaint.php';
        </script>";

        exit();

    }

    $sql = "INSERT INTO complaint
    (Complaint_ID, Description, Status, Student_ID, Staff_ID)
    VALUES
    ('$Complaint_ID',
    '$Description',
    '$Status',
    '$Student_ID',
    '$Staff_ID')";

    if (mysqli_query($conn, $sql)) {

        header("Location: complaints.php");
        exit();

    } else {

        echo "Error: " . mysqli_error($conn);

    }

}

?>