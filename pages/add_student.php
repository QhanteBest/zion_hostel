<?php
$base_url = "../";

include "../includes/config.php";
include "../includes/header.php";
include "../includes/sidebar.php";
?>

<main class="main-content">

    <div class="page-title">

        <div>
            <h2>Add New Student</h2>
            <p>Register a new student into the hostel.</p>
        </div>

        <a href="students.php" class="add-btn">
            ← Back to Students
        </a>

    </div>

    <div class="form-container">

        <form action="save_student.php" method="POST">

            <div class="form-grid">

                

                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="student_fname" required>
                </div>

                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="student_lname" required>
                </div>
                <div class="form-group">
                    <label>Student ID</label>
                    <input type="number" name="student_id" required>
                </div>

                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" name="student_phone_number" required>
                </div>

                <div class="form-group">
                    <label>Emergency Contact Name</label>
                    <input type="text" name="emergency_contact_name" required>
                </div>

                <div class="form-group">
                    <label>Emergency Contact Number</label>
                    <input type="text" name="emergency_contact_number" required>
                </div>

            </div>

            <div class="form-buttons">

                <button type="submit" class="save-btn">
                    Save Student
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