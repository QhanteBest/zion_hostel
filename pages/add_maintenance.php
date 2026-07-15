<?php

$base_url = "../";
include "../includes/auth.php";
include "../includes/config.php";
include "../includes/header.php";
include "../includes/sidebar.php";

?>

<main class="main-content">

    <div class="page-title">

        <div>
            <h2>Add Maintenance</h2>
            <p>Create a new maintenance record.</p>
        </div>

        <a href="maintenance.php" class="add-btn">
            ← Back to Maintenance
        </a>

    </div>

    <div class="form-container">

        <form action="save_maintenance.php" method="POST">

            <div class="form-grid">

                <div class="form-group">
                    <label>Maintenance ID</label>
                    <input type="number" name="Maintenance_ID" required>
                </div>

                <div class="form-group">
                    <label>Maintenance Type</label>

                    <input
                    type="text"
                    name="Maintenance_Type"
                    placeholder="e.g. Plumbing"
                    required>

                </div>

                <div class="form-group">
                    <label>Room</label>

                    <select name="Room_no" required>

                        <option value="">Select Room</option>

                        <?php

                        $rooms = mysqli_query($conn,
                        "SELECT room_no
                        FROM room
                        ORDER BY room_no");

                        while($row = mysqli_fetch_assoc($rooms))
                        {
                        ?>

                        <option value="<?php echo $row['room_no']; ?>">

                            <?php echo $row['room_no']; ?>

                        </option>

                        <?php } ?>

                    </select>

                </div>

                <div class="form-group">
                    <label>Assigned Staff</label>

                    <select name="Staff_ID" required>

                        <option value="">Select Staff</option>

                        <?php

                        $staff = mysqli_query($conn,
                        "SELECT staff_id, staff_fname, staff_lname
                        FROM staff
                        ORDER BY staff_fname");

                        while($row = mysqli_fetch_assoc($staff))
                        {
                        ?>

                        <option value="<?php echo $row['staff_id']; ?>">

                            <?php
                            echo $row['staff_fname']." ".$row['staff_lname'];
                            ?>

                        </option>

                        <?php } ?>

                    </select>

                </div>

                <div class="form-group">
                    <label>Status</label>

                    <select name="Maintenance_Status" required>

                        <option value="Pending">Pending</option>
                        <option value="In Progress">In Progress</option>
                        <option value="Completed">Completed</option>

                    </select>

                </div>

            </div>

            <div class="form-buttons">

                <button type="submit" class="save-btn">
                    Save Maintenance
                </button>

                <a href="maintenance.php" class="cancel-btn">
                    Cancel
                </a>

            </div>

        </form>

    </div>

</main>

<?php
include "../includes/footer.php";
?>