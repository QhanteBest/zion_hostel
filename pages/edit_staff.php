<?php

$base_url = "../";

include "../includes/config.php";

if (!isset($_GET['id'])) {
    header("Location: staff.php");
    exit();
}

$staff_id = $_GET['id'];

$result = mysqli_query($conn,
"SELECT * FROM staff
WHERE staff_id='$staff_id'");

$staff = mysqli_fetch_assoc($result);

if (!$staff) {
    echo "Staff member not found.";
    exit();
}

include "../includes/header.php";
include "../includes/sidebar.php";

?>

<main class="main-content">

    <div class="page-title">

        <div>
            <h2>Edit Staff</h2>
            <p>Update staff information.</p>
        </div>

        <a href="staff.php" class="add-btn">
            ← Back to Staff
        </a>

    </div>

    <div class="form-container">

        <form action="update_staff.php" method="POST">

            <input
            type="hidden"
            name="staff_id"
            value="<?php echo $staff['staff_id']; ?>">

            <div class="form-grid">

                <div class="form-group">
                    <label>Staff ID</label>
                    <input
                    type="text"
                    value="<?php echo $staff['staff_id']; ?>"
                    readonly>
                </div>

                <div class="form-group">
                    <label>First Name</label>
                    <input
                    type="text"
                    name="staff_fname"
                    value="<?php echo $staff['staff_fname']; ?>"
                    required>
                </div>

                <div class="form-group">
                    <label>Last Name</label>
                    <input
                    type="text"
                    name="staff_lname"
                    value="<?php echo $staff['staff_lname']; ?>"
                    required>
                </div>

                <div class="form-group">
                    <label>Phone Number</label>
                    <input
                    type="text"
                    name="staff_phone_number"
                    value="<?php echo $staff['staff_phone_number']; ?>"
                    required>
                </div>

                <div class="form-group">
                    <label>Role</label>
                    <input
                    type="text"
                    name="staff_role"
                    value="<?php echo $staff['staff_role']; ?>"
                    required>
                </div>

            </div>

            <div class="form-buttons">

                <button
                type="submit"
                name="update"
                class="save-btn">

                    Update Staff

                </button>

                <a href="staff.php" class="cancel-btn">
                    Cancel
                </a>

            </div>

        </form>

    </div>

</main>

<?php
include "../includes/footer.php";
?>