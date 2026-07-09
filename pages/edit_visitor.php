<?php

$base_url = "../";

include "../includes/config.php";

if (!isset($_GET['id'])) {

    header("Location: visitors.php");
    exit();

}

$Visitor_ID = $_GET['id'];

$result = mysqli_query($conn,
"SELECT * FROM visitor
WHERE Visitor_ID='$Visitor_ID'");

$visitor = mysqli_fetch_assoc($result);

if (!$visitor) {

    echo "Visitor not found.";
    exit();

}

include "../includes/header.php";
include "../includes/sidebar.php";

?>

<main class="main-content">

    <div class="page-title">

        <div>
            <h2>Edit Visitor</h2>
            <p>Update visitor information.</p>
        </div>

        <a href="visitors.php" class="add-btn">
            ← Back to Visitors
        </a>

    </div>

    <div class="form-container">

        <form action="update_visitor.php" method="POST">

            <input
            type="hidden"
            name="Visitor_ID"
            value="<?php echo $visitor['Visitor_ID']; ?>">

            <div class="form-grid">

                <div class="form-group">
                    <label>Visitor ID</label>

                    <input
                    type="text"
                    value="<?php echo $visitor['Visitor_ID']; ?>"
                    readonly>

                </div>

                <div class="form-group">

                    <label>Visitor Name</label>

                    <input
                    type="text"
                    name="Visitor_Name"
                    value="<?php echo $visitor['Visitor_Name']; ?>"
                    required>

                </div>

                <div class="form-group">

                    <label>Phone Number</label>

                    <input
                    type="text"
                    name="Visitor_Phone_number"
                    value="<?php echo $visitor['Visitor_Phone_number']; ?>"
                    required>

                </div>

                <div class="form-group">

                    <label>Student</label>

                    <select name="Student_ID" required>

                        <?php

                        $students = mysqli_query($conn,
                        "SELECT student_id, student_fname, student_lname
                        FROM student
                        ORDER BY student_fname");

                        while($row = mysqli_fetch_assoc($students))
                        {
                        ?>

                        <option
                        value="<?php echo $row['student_id']; ?>"
                        <?php if($visitor['Student_ID'] == $row['student_id']) echo "selected"; ?>>

                        <?php
                        echo $row['student_fname']." ".$row['student_lname'];
                        ?>

                        </option>

                        <?php } ?>

                    </select>

                </div>

                <div class="form-group">

                    <label>Approved By</label>

                    <select name="Approved_By" required>

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
                        <?php if($visitor['Approved_By'] == $row['staff_id']) echo "selected"; ?>>

                        <?php
                        echo $row['staff_fname']." ".$row['staff_lname'];
                        ?>

                        </option>

                        <?php } ?>

                    </select>

                </div>

                <div class="form-group">

                    <label>Check In Time</label>

                    <input
                    type="datetime-local"
                    name="Check_In_Time"
                    value="<?php echo date('Y-m-d\TH:i', strtotime($visitor['Check_In_Time'])); ?>"
                    required>

                </div>

                <div class="form-group">

                    <label>Check Out Time</label>

                    <input
                    type="datetime-local"
                    name="Check_Out_Time"
                    value="<?php echo $visitor['Check_Out_Time'] ? date('Y-m-d\TH:i', strtotime($visitor['Check_Out_Time'])) : ''; ?>">

                </div>

                <div class="form-group" style="grid-column:1/-1;">

                    <label>Purpose</label>

                    <input
                    type="text"
                    name="Purpose"
                    value="<?php echo $visitor['Purpose']; ?>"
                    required>

                </div>

            </div>

            <div class="form-buttons">

                <button
                type="submit"
                name="update"
                class="save-btn">

                    Update Visitor

                </button>

                <a href="visitors.php" class="cancel-btn">
                    Cancel
                </a>

            </div>

        </form>

    </div>

</main>

<?php
include "../includes/footer.php";
?>