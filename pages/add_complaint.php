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
            <h2>Add New Complaint</h2>
            <p>Register a student complaint.</p>
        </div>

        <a href="complaints.php" class="add-btn">
            ← Back to Complaints
        </a>

    </div>

    <div class="form-container">

        <form action="save_complaint.php" method="POST">

            <div class="form-grid">

                <div class="form-group">
                    <label>Complaint ID</label>
                    <input type="number" name="Complaint_ID" required>
                </div>

                <div class="form-group">
                    <label>Student</label>

                    <select name="Student_ID" required>

                        <option value="">Select Student</option>

                        <?php

                        $students = mysqli_query($conn,
                        "SELECT student_id, student_fname, student_lname
                        FROM student
                        ORDER BY student_fname");

                        while($row=mysqli_fetch_assoc($students))
                        {
                        ?>

                        <option value="<?php echo $row['student_id']; ?>">

                            <?php
                            echo $row['student_fname']." ".$row['student_lname'];
                            ?>

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

                        while($row=mysqli_fetch_assoc($staff))
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

                    <select name="Status" required>

                        <option value="Open">Open</option>
                        <option value="In Progress">In Progress</option>
                        <option value="Resolved">Resolved</option>
                        <option value="Closed">Closed</option>

                    </select>

                </div>

                <div class="form-group" style="grid-column:1 / -1;">
                    <label>Description</label>

                    <textarea
                    name="Description"
                    rows="5"
                    required></textarea>

                </div>

            </div>

            <div class="form-buttons">

                <button
                type="submit"
                class="save-btn">

                    Save Complaint

                </button>

                <a href="complaints.php"
                class="cancel-btn">

                    Cancel

                </a>

            </div>

        </form>

    </div>

</main>

<?php
include "../includes/footer.php";
?>