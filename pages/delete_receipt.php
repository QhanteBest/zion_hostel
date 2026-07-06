<?php

include "../includes/config.php";

if (!isset($_GET['id'])) {

    header("Location: receipts.php");
    exit();

}

$Receipt_ID = $_GET['id'];

$sql = "DELETE FROM receipt
WHERE Receipt_ID='$Receipt_ID'";

if (mysqli_query($conn, $sql)) {

    header("Location: receipts.php");
    exit();

} else {

    echo "Error deleting receipt: " . mysqli_error($conn);

}

?>