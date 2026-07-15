<?php
include "../includes/auth.php";
include "../includes/config.php";

if (!isset($_GET['id'])) {
    header("Location: payments.php");
    exit();
}

$payment_id = $_GET['id'];

$sql = "DELETE FROM payment
        WHERE payment_id='$payment_id'";

if (mysqli_query($conn, $sql)) {

    header("Location: payments.php");
    exit();

} else {

    echo "Error deleting payment: " . mysqli_error($conn);

}

?>