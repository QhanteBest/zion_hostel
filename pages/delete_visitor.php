<?php
include "../includes/auth.php";
include "../includes/config.php";

if (!isset($_GET['id'])) {

    header("Location: visitors.php");
    exit();

}

$Visitor_ID = $_GET['id'];

// Check if visitor exists
$check = mysqli_query($conn,
"SELECT * FROM visitor
WHERE Visitor_ID='$Visitor_ID'");

if (mysqli_num_rows($check) == 0) {

    echo "<script>
    alert('Visitor record not found.');
    window.location='visitors.php';
    </script>";

    exit();

}

// Delete visitor
$sql = "DELETE FROM visitor
WHERE Visitor_ID='$Visitor_ID'";

if (mysqli_query($conn, $sql)) {

    header("Location: visitors.php");
    exit();

} else {

    echo "Error deleting visitor: " . mysqli_error($conn);

}

?>