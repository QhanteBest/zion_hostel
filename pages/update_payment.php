<?php
include "../includes/auth.php";
include "../includes/config.php";

if (isset($_POST['update'])) {

    $payment_id = $_POST['payment_id'];
    $payment_amount = $_POST['payment_amount'];
    $payment_date = $_POST['payment_date'];
    $payment_method = $_POST['payment_method'];
    $payment_status = $_POST['payment_status'];

    $sql = "UPDATE payment SET
            payment_amount='$payment_amount',
            payment_date='$payment_date',
            payment_method='$payment_method',
            payment_status='$payment_status'
            WHERE payment_id='$payment_id'";

    if (mysqli_query($conn, $sql)) {

        header("Location: payments.php");
        exit();

    } else {

        echo "Error updating payment: " . mysqli_error($conn);

    }

} else {

    header("Location: payments.php");
    exit();

}

?>