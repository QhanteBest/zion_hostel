<?php

session_start();

// If already logged in, go to dashboard
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

    <title>Register | Zion Hostel</title>

    <link rel="stylesheet" href="css/login.css">

</head>

<body>

    <div class="login-container">

        <div class="login-card">

            <div class="login-header">

                <h1>Create Account</h1>

                <p>Zion Hostel Management System</p>

            </div>


            <?php if (isset($_GET['error'])) { ?>

                <div class="error-message">

                    <?php

                    if ($_GET['error'] == "password") {

                        echo "Passwords do not match.";

                    }
                    elseif ($_GET['error'] == "staff") {

                        echo "Staff ID does not exist.";

                    }
                    elseif ($_GET['error'] == "account") {

                        echo "This staff member already has an account.";

                    }
                    elseif ($_GET['error'] == "username") {

                        echo "Username already exists.";

                    }
                    else {

                        echo "Registration failed. Please try again.";

                    }

                    ?>

                </div>

            <?php } ?>


            <form action="save_register.php" method="POST">

                <div class="form-group">

                    <label>Staff ID</label>

                    <input
                        type="number"
                        name="staff_id"
                        placeholder="Enter your Staff ID"
                        required
                    >

                </div>


                <div class="form-group">

                    <label>Username</label>

                    <input
                        type="text"
                        name="username"
                        placeholder="Create a username"
                        required
                    >

                </div>


                <div class="form-group">

                    <label>Password</label>

                    <input
                        type="password"
                        name="password"
                        placeholder="Create a password"
                        required
                    >

                </div>


                <div class="form-group">

                    <label>Confirm Password</label>

                    <input
                        type="password"
                        name="confirm_password"
                        placeholder="Confirm your password"
                        required
                    >

                </div>


                <button
                    type="submit"
                    class="login-btn"
                >
                    Register
                </button>

            </form>


            <p class="register-text">

                Already have an account?

                <a href="login.php">
                    Login
                </a>

            </p>

        </div>

    </div>

</body>

</html>