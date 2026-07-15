<?php
include "../includes/auth.php";
include "../includes/config.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $setting_id = $_POST['setting_id'];

    $hostel_name = $_POST['hostel_name'];

    $system_name = $_POST['system_name'];

    $motto = $_POST['motto'];

    $hostel_phone = $_POST['hostel_phone'];

    $hostel_email = $_POST['hostel_email'];

    $hostel_address = $_POST['hostel_address'];

    $currency = $_POST['currency'];


    $sql = "UPDATE settings SET

        hostel_name = '$hostel_name',

        system_name = '$system_name',

        motto = '$motto',

        hostel_phone = '$hostel_phone',

        hostel_email = '$hostel_email',

        hostel_address = '$hostel_address',

        currency = '$currency'

        WHERE setting_id = '$setting_id'

    ";


    if (mysqli_query($conn, $sql)) {


        header("Location: settings.php?updated=1");

        exit();


    } else {


        echo "Error updating settings: "
             . mysqli_error($conn);


    }

} else {


    header("Location: settings.php");

    exit();


}

?>