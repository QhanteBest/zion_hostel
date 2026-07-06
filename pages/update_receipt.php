<?php

include "../includes/config.php";

if (isset($_POST['update'])) {

    $Receipt_ID = $_POST['Receipt_ID'];
    $Receipt_Issue_Date = $_POST['Receipt_Issue_Date'];

    $sql = "UPDATE receipt SET
            Receipt_Issue_Date='$Receipt_Issue_Date'
            WHERE Receipt_ID='$Receipt_ID'";

    if (mysqli_query($conn, $sql)) {

        header("Location: receipts.php");
        exit();

    } else {

        echo "Error updating receipt: " . mysqli_error($conn);

    }

} else {

    header("Location: receipts.php");
    exit();

}

?>