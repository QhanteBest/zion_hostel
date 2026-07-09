<?php

include "../includes/config.php";

if (isset($_POST['update'])) {

    $Visitor_ID = $_POST['Visitor_ID'];
    $Visitor_Name = $_POST['Visitor_Name'];
    $Visitor_Phone_number = $_POST['Visitor_Phone_number'];
    $Check_In_Time = $_POST['Check_In_Time'];
    $Check_Out_Time = $_POST['Check_Out_Time'];
    $Purpose = $_POST['Purpose'];
    $Approved_By = $_POST['Approved_By'];
    $Student_ID = $_POST['Student_ID'];

    // If Check-Out Time is empty, store NULL
    if (empty($Check_Out_Time)) {

        $Check_Out_Time = "NULL";

    } else {

        $Check_Out_Time = "'$Check_Out_Time'";

    }

    $sql = "UPDATE visitor SET
            Visitor_Name='$Visitor_Name',
            Visitor_Phone_number='$Visitor_Phone_number',
            Check_In_Time='$Check_In_Time',
            Check_Out_Time=$Check_Out_Time,
            Purpose='$Purpose',
            Approved_By='$Approved_By',
            Student_ID='$Student_ID'
            WHERE Visitor_ID='$Visitor_ID'";

    if (mysqli_query($conn, $sql)) {

        header("Location: visitors.php");
        exit();

    } else {

        echo "Error updating visitor: " . mysqli_error($conn);

    }

} else {

    header("Location: visitors.php");
    exit();

}

?>