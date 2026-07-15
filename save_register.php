<?php

include "includes/config.php";


// Only allow form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $staff_id = $_POST['staff_id'];
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];


    // 1. Check whether passwords match
    if ($password !== $confirm_password) {

        header("Location: register.php?error=password");
        exit();

    }


    // 2. Check whether the Staff ID exists
    $staff_sql = "SELECT staff_id
                  FROM staff
                  WHERE staff_id = ?";

    $staff_stmt = mysqli_prepare($conn, $staff_sql);

    mysqli_stmt_bind_param(
        $staff_stmt,
        "i",
        $staff_id
    );

    mysqli_stmt_execute($staff_stmt);

    $staff_result = mysqli_stmt_get_result($staff_stmt);


    if (mysqli_num_rows($staff_result) == 0) {

        header("Location: register.php?error=staff");
        exit();

    }


    // 3. Check whether this staff member already has an account
    $account_sql = "SELECT user_id
                    FROM users
                    WHERE staff_id = ?";

    $account_stmt = mysqli_prepare($conn, $account_sql);

    mysqli_stmt_bind_param(
        $account_stmt,
        "i",
        $staff_id
    );

    mysqli_stmt_execute($account_stmt);

    $account_result = mysqli_stmt_get_result($account_stmt);


    if (mysqli_num_rows($account_result) > 0) {

        header("Location: register.php?error=account");
        exit();

    }


    // 4. Check whether username already exists
    $username_sql = "SELECT user_id
                     FROM users
                     WHERE username = ?";

    $username_stmt = mysqli_prepare($conn, $username_sql);

    mysqli_stmt_bind_param(
        $username_stmt,
        "s",
        $username
    );

    mysqli_stmt_execute($username_stmt);

    $username_result = mysqli_stmt_get_result($username_stmt);


    if (mysqli_num_rows($username_result) > 0) {

        header("Location: register.php?error=username");
        exit();

    }


    // 5. Secure the password
    $hashed_password = password_hash(
        $password,
        PASSWORD_DEFAULT
    );


    // 6. Save the new account
    $insert_sql = "INSERT INTO users
                   (username, password, staff_id)
                   VALUES (?, ?, ?)";

    $insert_stmt = mysqli_prepare($conn, $insert_sql);

    mysqli_stmt_bind_param(
        $insert_stmt,
        "ssi",
        $username,
        $hashed_password,
        $staff_id
    );


    if (mysqli_stmt_execute($insert_stmt)) {

        header("Location: login.php?registered=1");
        exit();

    } else {

        header("Location: register.php?error=general");
        exit();

    }

} else {

    header("Location: register.php");
    exit();

}

?>