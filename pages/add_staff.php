<?php

$base_url = "../";

include "../includes/config.php";
include "../includes/header.php";
include "../includes/sidebar.php";

?>

<main class="main-content">

    <div class="page-title">

        <div>
            <h2>Add New Staff</h2>
            <p>Register a new staff member.</p>
        </div>

        <a href="staff.php" class="add-btn">
            ← Back to Staff
        </a>

    </div>

    <div class="form-container">

        <form action="save_staff.php" method="POST">

            <div class="form-grid">

                <div class="form-group">
                    <label>Staff ID</label>
                    <input type="number" name="staff_id" required>
                </div>

                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="staff_fname" required>
                </div>

                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="staff_lname" required>
                </div>

                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" name="staff_phone_number" required>
                </div>

                <div class="form-group">
                    <label>Role</label>
                    <input type="text" name="staff_role" required>

                </div>

            </div>

            <div class="form-buttons">

                <button type="submit" class="save-btn">
                    Save Staff
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