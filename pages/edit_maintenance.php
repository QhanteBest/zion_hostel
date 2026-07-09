<?php

$base_url = "../";

include "../includes/config.php";

if (!isset($_GET['id'])) {

    header("Location: maintenance.php");
    exit();

}

$Maintenance_ID = $_GET['id'];

$result = mysqli_query($conn,
"SELECT * FROM maintenance
WHERE Maintenance_ID='$Maintenance_ID'");

$maintenance = mysqli_fetch_assoc($result);

if (!$maintenance) {

    echo "Maintenance record not found.";
    exit();

}

include "../includes/header.php";
include "../includes/sidebar.php";

?>

<main class="main-content">

    <div class="page-title">

        <div>
            <h2>Edit Maintenance</h2>
            <p>Update maintenance information.</p>
        </div>

        <a href="maintenance.php" class="add-btn">
            ← Back to Maintenance
        </a>

    </div>

    <div class="form-container">

        <form action="update_maintenance.php" method="POST">

            <input
            type="hidden"
            name="Maintenance_ID"
            value="<?php echo $maintenance['Maintenance_ID']; ?>">

            <div class="form-grid">

                <div class="form-group">

                    <label>Maintenance ID</label>

                    <input
                    type="text"
                    value="<?php echo $maintenance['Maintenance_ID']; ?>"
                    readonly>

                </div>

                <div class="form-group">

                    <label>Maintenance Type</label>

                    <input
                    type="text"
                    name="Maintenance_Type"
                    value="<?php echo $maintenance['Maintenance_Type']; ?>"
                    required>

                </div>

                <div class="form-group">

                    <label>Room</label>

                    <select name="Room_no" required>

                        <?php

                        $rooms = mysqli_query($conn,
                        "SELECT room_no FROM room ORDER BY room_no");

                        while($row = mysqli_fetch_assoc($rooms))
                        {
                        ?>

                        <option
                        value="<?php echo $row['room_no']; ?>"
                        <?php
                        if($maintenance['Room_no'] == $row['room_no'])
                        echo "selected";
                        ?>>

                            <?php echo $row['room_no']; ?>

                        </option>

                        <?php } ?>

                    </select>

                </div>

                <div class="form-group">

                    <label>Assigned Staff</label>

                    <select name="Staff_ID" required>

                        <?php

                        $staff = mysqli_query($conn,
                        "SELECT staff_id, staff_fname, staff_lname
                        FROM staff
                        ORDER BY staff_fname");

                        while($row = mysqli_fetch_assoc($staff))
                        {
                        ?>

                        <option
                        value="<?php echo $row['staff_id']; ?>"
                        <?php
                        if($maintenance['Staff_ID'] == $row['staff_id'])
                        echo "selected";
                        ?>>

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

                        <option value="Pending"
                        <?php if($maintenance['Maintenance_Status']=="Pending") echo "selected"; ?>>
                            Pending
                        </option>

                        <option value="In Progress"
                        <?php if($maintenance['Maintenance_Status']=="In Progress") echo "selected"; ?>>
                            In Progress
                        </option>

                        <option value="Completed"
                        <?php if($maintenance['Maintenance_Status']=="Completed") echo "selected"; ?>>
                            Completed
                        </option>

                    </select>

                </div>

            </div>

            <div class="form-buttons">

                <button
                type="submit"
                name="update"
                class="save-btn">

                    Update Maintenance

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