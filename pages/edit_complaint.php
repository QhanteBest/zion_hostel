<?php

$base_url = "../";
include "../includes/auth.php";
include "../includes/config.php";

if (!isset($_GET['id'])) {
    header("Location: complaints.php");
    exit();
}

$Complaint_ID = $_GET['id'];

$result = mysqli_query($conn,
"SELECT * FROM complaint
WHERE Complaint_ID='$Complaint_ID'");

$complaint = mysqli_fetch_assoc($result);

if (!$complaint) {
    echo "Complaint not found.";
    exit();
}

include "../includes/header.php";
include "../includes/sidebar.php";

?>

<main class="main-content">

    <div class="page-title">

        <div>
            <h2>Edit Complaint</h2>
            <p>Update complaint information.</p>
        </div>

        <a href="complaints.php" class="add-btn">
            ← Back to Complaints
        </a>

    </div>

    <div class="form-container">

        <form action="update_complaint.php" method="POST">

            <input
            type="hidden"
            name="Complaint_ID"
            value="<?php echo $complaint['Complaint_ID']; ?>">

            <div class="form-grid">

                <div class="form-group">
                    <label>Complaint ID</label>
                    <input
                    type="text"
                    value="<?php echo $complaint['Complaint_ID']; ?>"
                    readonly>
                </div>

                <div class="form-group">
                    <label>Student</label>

                    <select name="Student_ID" required>

                        <?php

                        $students = mysqli_query($conn,
                        "SELECT student_id, student_fname, student_lname
                        FROM student
                        ORDER BY student_fname");

                        while($row=mysqli_fetch_assoc($students))
                        {
                        ?>

                        <option
                        value="<?php echo $row['student_id']; ?>"
                        <?php
                        if($complaint['Student_ID']==$row['student_id'])
                        echo "selected";
                        ?>>

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

                        <?php

                        $staff = mysqli_query($conn,
                        "SELECT staff_id, staff_fname, staff_lname
                        FROM staff
                        ORDER BY staff_fname");

                        while($row=mysqli_fetch_assoc($staff))
                        {
                        ?>

                        <option
                        value="<?php echo $row['staff_id']; ?>"
                        <?php
                        if($complaint['Staff_ID']==$row['staff_id'])
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

                    <select name="Status" required>

                        <option value="Open"
                        <?php if($complaint['Status']=="Open") echo "selected"; ?>>
                        Open
                        </option>

                        <option value="In Progress"
                        <?php if($complaint['Status']=="In Progress") echo "selected"; ?>>
                        In Progress
                        </option>

                        <option value="Resolved"
                        <?php if($complaint['Status']=="Resolved") echo "selected"; ?>>
                        Resolved
                        </option>

                        <option value="Closed"
                        <?php if($complaint['Status']=="Closed") echo "selected"; ?>>
                        Closed
                        </option>

                    </select>

                </div>

                <div class="form-group" style="grid-column:1/-1;">

                    <label>Description</label>

                    <textarea
                    name="Description"
                    rows="5"
                    required><?php echo $complaint['Description']; ?></textarea>

                </div>

            </div>

            <div class="form-buttons">

                <button
                type="submit"
                name="update"
                class="save-btn">

                    Update Complaint

                </button>

                <a href="complaints.php" class="cancel-btn">
                    Cancel
                </a>

            </div>

        </form>

    </div>

</main>

<?php
include "../includes/footer.php";
?>