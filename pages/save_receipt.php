<?php

include "../includes/config.php";

if (isset($_POST['Receipt_ID'])) {

    $Receipt_ID = $_POST['Receipt_ID'];
    $Receipt_Issue_Date = $_POST['Receipt_Issue_Date'];
    $Payment_ID = $_POST['Payment_ID'];

    // Check if this payment already has a receipt
    $check = mysqli_query($conn,
    "SELECT * FROM receipt
    WHERE Payment_ID='$Payment_ID'");

    if (mysqli_num_rows($check) > 0) {

        echo "<script>
        alert('This payment already has a receipt.');
        window.location='add_receipt.php';
        </script>";
        exit();

    }

    // Get payment details automatically
    $payment = mysqli_query($conn,
    "SELECT * FROM payment
    WHERE payment_id='$Payment_ID'");

    $data = mysqli_fetch_assoc($payment);

    $Student_ID = $data['student_id'];
    $Payment_Date = $data['payment_date'];
    $Payment_Status = $data['payment_status'];

    // Save receipt
    $sql = "INSERT INTO receipt
    (Receipt_ID, Receipt_Issue_Date, Payment_Date, Payment_Status, Student_ID, Payment_ID)
    VALUES
    ('$Receipt_ID',
    '$Receipt_Issue_Date',
    '$Payment_Date',
    '$Payment_Status',
    '$Student_ID',
    '$Payment_ID')";

    if (mysqli_query($conn, $sql)) {

        header("Location: receipts.php");
        exit();

    } else {

        echo "Error: " . mysqli_error($conn);

    }

}
?>