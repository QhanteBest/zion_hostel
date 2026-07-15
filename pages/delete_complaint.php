<?php
include "../includes/auth.php";
include "../includes/config.php";

if (!isset($_GET['id'])) {

    header("Location: complaints.php");
    exit();

}

$Complaint_ID = $_GET['id'];

// Check if complaint exists
$check = mysqli_query($conn,
"SELECT * FROM complaint
WHERE Complaint_ID='$Complaint_ID'");

if (mysqli_num_rows($check) == 0) {

    echo "<script>
    alert('Complaint not found.');
    window.location='complaints.php';
    </script>";

    exit();

}

// Delete complaint
$sql = "DELETE FROM complaint
WHERE Complaint_ID='$Complaint_ID'";

if (mysqli_query($conn, $sql)) {

    header("Location: complaints.php");
    exit();

} else {

    echo "Error deleting complaint: " . mysqli_error($conn);

}

?>