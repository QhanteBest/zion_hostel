<?php

session_start();

// If already logged in, go directly to dashboard
if (isset($_SESSION['user_id'])) {

    header("Location: index.php");

    exit();

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Zion Hostel Login</title>

    <link
        rel="stylesheet"
        href="css/login.css"
    >

</head>

<body>

    <div class="login-container">

        <div class="login-card">

            <div class="login-header">

                <h1>Zion Hostel</h1>

                <p>Management System</p>

            </div>


            <!-- Registration Success Message -->

            <?php if (isset($_GET['registered'])) { ?>

                <div class="success-message">

                    Account created successfully. You can now log in.

                </div>

            <?php } ?>


            <!-- Login Error Message -->

            <?php if (isset($_GET['error'])) { ?>

                <div class="error-message">

                    Invalid username or password.

                </div>

            <?php } ?>


            <form action="process_login.php" method="POST">

                <div class="form-group">

                    <label>Username</label>

                    <input
                        type="text"
                        name="username"
                        placeholder="Enter your username"
                        required
                    >

                </div>


                <div class="form-group">

                    <label>Password</label>

                    <input
                        type="password"
                        name="password"
                        placeholder="Enter your password"
                        required
                    >

                </div>


                <button
                    type="submit"
                    class="login-btn"
                >
                    Login
                </button>

            </form>


            <p class="register-text">

                Don't have an account?

                <a href="register.php">
                    Register
                </a>

            </p>

        </div>

    </div>

</body>

</html>