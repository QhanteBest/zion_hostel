<?php
// Session should expire when the browser session ends
ini_set('session.cookie_lifetime', '0');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {

    header("Location: ../login.php");

    exit();

}

?>