<?php
// Session should expire when the browser session ends
ini_set('session.cookie_lifetime', '0');
session_start();
include "includes/config.php";


// Check if the login form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];

    $password = $_POST['password'];


    // Find the user and get the staff information
    $sql = "SELECT
                users.user_id,
                users.username,
                users.password,
                users.staff_id,
                staff.staff_fname,
                staff.staff_lname,
                staff.staff_role

            FROM users

            JOIN staff
            ON users.staff_id = staff.staff_id

            WHERE users.username = ?";


    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "s",
        $username
    );

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $user = mysqli_fetch_assoc($result);


    // Check the user and verify the password
    if ($user && password_verify($password, $user['password'])) {


        // Create the login session
        $_SESSION['user_id'] = $user['user_id'];

        $_SESSION['username'] = $user['username'];

        $_SESSION['staff_id'] = $user['staff_id'];

        $_SESSION['staff_name'] =
            $user['staff_fname'] . " " . $user['staff_lname'];

        $_SESSION['staff_role'] = $user['staff_role'];


        // Send the user to the dashboard
        header("Location: index.php");

        exit();


    } else {


        // Wrong username or password
        header("Location: login.php?error=1");

        exit();

    }

} else {


    // If someone opens this file directly
    header("Location: login.php");

    exit();

}

?>