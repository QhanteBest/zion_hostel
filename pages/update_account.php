<?php

session_start();

include "../includes/config.php";


// Protect the page
if (!isset($_SESSION['user_id'])) {

    header("Location: ../login.php");

    exit();

}


// Only allow POST requests
if ($_SERVER["REQUEST_METHOD"] !== "POST") {

    header("Location: account.php");

    exit();

}


$user_id = $_SESSION['user_id'];

$staff_id = (int) $_POST['staff_id'];

$username = trim($_POST['username']);

$current_password = $_POST['current_password'];

$new_password = $_POST['new_password'];

$confirm_password = $_POST['confirm_password'];


// ==========================================
// 1. GET THE CURRENT USER ACCOUNT
// ==========================================

$sql = "SELECT user_id, username, password, staff_id
        FROM users
        WHERE user_id = ?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "i",
    $user_id
);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$user = mysqli_fetch_assoc($result);


// Account does not exist
if (!$user) {

    header("Location: ../logout.php");

    exit();

}


// ==========================================
// 2. CHECK CURRENT PASSWORD
// ==========================================

if (!password_verify($current_password, $user['password'])) {

    header("Location: account.php?error=password");

    exit();

}


// ==========================================
// 3. CHECK THAT NEW STAFF ID EXISTS
// ==========================================

$sql = "SELECT staff_id
        FROM staff
        WHERE staff_id = ?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "i",
    $staff_id
);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);


if (mysqli_num_rows($result) == 0) {

    header("Location: account.php?error=staff");

    exit();

}


// ==========================================
// 4. CHECK IF STAFF ID BELONGS TO ANOTHER USER
// ==========================================

$sql = "SELECT user_id
        FROM users
        WHERE staff_id = ?
        AND user_id != ?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "ii",
    $staff_id,
    $user_id
);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);


if (mysqli_num_rows($result) > 0) {

    header("Location: account.php?error=staff_used");

    exit();

}


// ==========================================
// 5. CHECK IF USERNAME BELONGS TO ANOTHER USER
// ==========================================

$sql = "SELECT user_id
        FROM users
        WHERE username = ?
        AND user_id != ?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "si",
    $username,
    $user_id
);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);


if (mysqli_num_rows($result) > 0) {

    header("Location: account.php?error=username");

    exit();

}


// ==========================================
// 6. CHECK NEW PASSWORD
// ==========================================

if (!empty($new_password)) {

    // Confirm passwords must match
    if ($new_password !== $confirm_password) {

        header("Location: account.php?error=match");

        exit();

    }


    // Hash the new password
    $hashed_password = password_hash(
        $new_password,
        PASSWORD_DEFAULT
    );


    // Update username, staff ID and password
    $sql = "UPDATE users
            SET username = ?,
                staff_id = ?,
                password = ?
            WHERE user_id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "sisi",
        $username,
        $staff_id,
        $hashed_password,
        $user_id
    );

} else {

    // Update only username and staff ID
    $sql = "UPDATE users
            SET username = ?,
                staff_id = ?
            WHERE user_id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "sii",
        $username,
        $staff_id,
        $user_id
    );

}


// ==========================================
// 7. SAVE CHANGES
// ==========================================

if (mysqli_stmt_execute($stmt)) {

    $_SESSION['username'] = $username;

    header("Location: account.php?updated=1");

    exit();

} else {

    header("Location: account.php?error=general");

    exit();

}

?>