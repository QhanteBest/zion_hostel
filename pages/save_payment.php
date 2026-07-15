<?php
include "../includes/auth.php";
include "../includes/config.php";

if (isset($_POST['student_id'])) {

    $student_id = $_POST['student_id'];
    $payment_amount = $_POST['payment_amount'];
    $payment_date = $_POST['payment_date'];
    $payment_method = $_POST['payment_method'];
    $payment_status = $_POST['payment_status'];

    // Generate the next Payment ID
    $result = mysqli_query($conn, "SELECT MAX(payment_id) AS max_id FROM payment");
    $row = mysqli_fetch_assoc($result);

    if ($row['max_id'] == NULL) {
        $payment_id = 40001;
    } else {
        $payment_id = $row['max_id'] + 1;
    }

    $sql = "INSERT INTO payment
    (payment_id, payment_amount, payment_method, payment_date, payment_status, student_id)
    VALUES
    ('$payment_id',
    '$payment_amount',
    '$payment_method',
    '$payment_date',
    '$payment_status',
    '$student_id')";

    if (mysqli_query($conn, $sql)) {

        header("Location: payments.php");
        exit();

    } else {

        echo "Error: " . mysqli_error($conn);

    }

}
?>