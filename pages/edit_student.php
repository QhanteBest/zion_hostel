<?php
$base_url = "../";
include "../includes/auth.php";
include "../includes/config.php";

if (!isset($_GET['id'])) {
    header("Location: students.php");
    exit();
}

$student_id = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM student WHERE student_id='$student_id'");

$student = mysqli_fetch_assoc($result);

if (!$student) {
    echo "Student not found.";
    exit();
}

include "../includes/header.php";
include "../includes/sidebar.php";
?>

<main class="main-content">

    <div class="page-title">

        <div>
            <h2>Edit Student</h2>
            <p>Update student information.</p>
        </div>

        <a href="students.php" class="add-btn">
            ← Back to Students
        </a>

    </div>

    <div class="form-container">

        <form action="update_student.php" method="POST">

            <input type="hidden" name="student_id" value="<?php echo $student['student_id']; ?>">

            <div class="form-grid">

                <div class="form-group">
                    <label>First Name</label>
                    <input
                        type="text"
                        name="student_fname"
                        value="<?php echo $student['student_fname']; ?>"
                        required>
                </div>

                <div class="form-group">
                    <label>Last Name</label>
                    <input
                        type="text"
                        name="student_lname"
                        value="<?php echo $student['student_lname']; ?>"
                        required>
                </div>

                <div class="form-group">
                    <label>Phone Number</label>
                    <input
                        type="text"
                        name="student_phone_number"
                        value="<?php echo $student['student_phone_number']; ?>"
                        required>
                </div>

                <div class="form-group">
                    <label>Emergency Contact Name</label>
                    <input
                        type="text"
                        name="emergency_contact_name"
                        value="<?php echo $student['emergency_contact_name']; ?>"
                        required>
                </div>

                <div class="form-group">
                    <label>Emergency Contact Number</label>
                    <input
                        type="text"
                        name="emergency_contact_number"
                        value="<?php echo $student['emergency_contact_number']; ?>"
                        required>
                </div>

            </div>

            <div class="form-buttons">

                <button type="submit" class="save-btn">
                    Update Student
                </button>

                <a href="students.php" class="cancel-btn">
                    Cancel
                </a>

            </div>

        </form>

    </div>

</main>

<?php
include "../includes/footer.php";
?>