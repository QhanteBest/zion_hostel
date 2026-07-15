<?php
include "../includes/auth.php";
include "../includes/config.php";

if (isset($_POST['Visitor_ID'])) {

    $Visitor_ID = $_POST['Visitor_ID'];
    $Visitor_Name = $_POST['Visitor_Name'];
    $Visitor_Phone_number = $_POST['Visitor_Phone_number'];
    $Check_In_Time = $_POST['Check_In_Time'];
    $Check_Out_Time = $_POST['Check_Out_Time'];
    $Purpose = $_POST['Purpose'];
    $Approved_By = $_POST['Approved_By'];
    $Student_ID = $_POST['Student_ID'];

    // Check if Visitor ID already exists
    $check = mysqli_query($conn,
    "SELECT * FROM visitor
    WHERE Visitor_ID='$Visitor_ID'");

    if (mysqli_num_rows($check) > 0) {

        echo "<script>
        alert('Visitor ID already exists.');
        window.location='add_visitor.php';
        </script>";

        exit();

    }

    // If Check-Out Time is empty, save NULL
    if (empty($Check_Out_Time)) {

        $Check_Out_Time = "NULL";

    } else {

        $Check_Out_Time = "'$Check_Out_Time'";

    }

    $sql = "INSERT INTO visitor
    (Visitor_ID,
    Visitor_Name,
    Visitor_Phone_number,
    Check_In_Time,
    Check_Out_Time,
    Purpose,
    Approved_By,
    Student_ID)

    VALUES

    ('$Visitor_ID',
    '$Visitor_Name',
    '$Visitor_Phone_number',
    '$Check_In_Time',
    $Check_Out_Time,
    '$Purpose',
    '$Approved_By',
    '$Student_ID')";

    if (mysqli_query($conn, $sql)) {

        header("Location: visitors.php");
        exit();

    } else {

        echo "Error: " . mysqli_error($conn);

    }

}

?>