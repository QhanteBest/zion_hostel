<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ==========================================
// LOAD LOGGED-IN ADMIN INFORMATION
// ==========================================

$admin = null;

if (isset($_SESSION['user_id'])) {

    $user_id = $_SESSION['user_id'];

    $sql = "
        SELECT
            users.username,
            users.profile_image,
            staff.staff_fname,
            staff.staff_lname

        FROM users

        INNER JOIN staff
            ON users.staff_id = staff.staff_id

        WHERE users.user_id = ?
    ";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {

        mysqli_stmt_bind_param($stmt, "i", $user_id);

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        $admin = mysqli_fetch_assoc($result);

    }

}

// ==========================================
// PROFILE IMAGE
// ==========================================

$image = $base_url . "images/admins.png";

if (
    $admin &&
    !empty($admin['profile_image']) &&
    file_exists(__DIR__ . "/../uploads/" . $admin['profile_image'])
) {

    $image = $base_url . "uploads/" . $admin['profile_image'];

}

?>

<aside class="sidebar">

    <div class="profile">

        <img
            src="<?php echo $image; ?>"
            alt="Administrator"
        >

        <h3>

            <?php

            if ($admin) {

                echo htmlspecialchars(
                    $admin['staff_fname'] . " " . $admin['staff_lname']
                );

            } else {

                echo "Administrator";

            }

            ?>

        </h3>

        <p>Hostel Administrator</p>

    </div>

    <nav>

        <ul>

            <li>
                <a href="<?php echo $base_url; ?>index.php">
                    <i class="fa-solid fa-house"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li>
                <a href="<?php echo $base_url; ?>pages/students.php">
                    <i class="fa-solid fa-user-graduate"></i>
                    <span>Students</span>
                </a>
            </li>

            <li>
                <a href="<?php echo $base_url; ?>pages/rooms.php">
                    <i class="fa-solid fa-bed"></i>
                    <span>Room Management</span>
                </a>
            </li>

            <li>
                <a href="<?php echo $base_url; ?>pages/allocation.php">
                    <i class="fa-solid fa-building-user"></i>
                    <span>Room Allocation</span>
                </a>
            </li>

            <li>
                <a href="<?php echo $base_url; ?>pages/payments.php">
                    <i class="fa-solid fa-credit-card"></i>
                    <span>Payments</span>
                </a>
            </li>

            <li>
                <a href="<?php echo $base_url; ?>pages/receipts.php">
                    <i class="fa-solid fa-file-invoice-dollar"></i>
                    <span>Receipts</span>
                </a>
            </li>

            <li>
                <a href="<?php echo $base_url; ?>pages/staff.php">
                    <i class="fa-solid fa-users"></i>
                    <span>Staff</span>
                </a>
            </li>

            <li>
                <a href="<?php echo $base_url; ?>pages/complaints.php">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <span>Complaints</span>
                </a>
            </li>

            <li>
                <a href="<?php echo $base_url; ?>pages/maintenance.php">
                    <i class="fa-solid fa-screwdriver-wrench"></i>
                    <span>Maintenance</span>
                </a>
            </li>

            <li>
                <a href="<?php echo $base_url; ?>pages/visitors.php">
                    <i class="fa-solid fa-person-walking"></i>
                    <span>Visitors</span>
                </a>
            </li>

            <li>
                <a href="<?php echo $base_url; ?>pages/reports.php">
                    <i class="fa-solid fa-chart-column"></i>
                    <span>Reports</span>
                </a>
            </li>

            <li>
                <a href="<?php echo $base_url; ?>pages/settings.php">
                    <i class="fa-solid fa-gear"></i>
                    <span>Settings</span>
                </a>
            </li>

            <li>
                <a href="<?php echo $base_url; ?>pages/account.php">
                    <i class="fa-solid fa-user-gear"></i>
                    <span>My Account</span>
                </a>
            </li>

            <li>
                <a href="<?php echo $base_url; ?>logout.php"
                   onclick="return confirm('Are you sure you want to logout?');">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Logout</span>
                </a>
            </li>

        </ul>

    </nav>

</aside>