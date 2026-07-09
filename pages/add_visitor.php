<?php

$base_url = "../";

include "../includes/config.php";
include "../includes/header.php";
include "../includes/sidebar.php";

?>

<main class="main-content">

<div class="page-title">

    <div>
        <h2>Add Visitor</h2>
        <p>Register a new visitor.</p>
    </div>

    <a href="visitors.php" class="add-btn">
        ← Back to Visitors
    </a>

</div>

<div class="form-container">

<form action="save_visitor.php" method="POST">

<div class="form-grid">

<div class="form-group">

<label>Visitor ID</label>

<input
type="number"
name="Visitor_ID"
required>

</div>

<div class="form-group">

<label>Visitor Name</label>

<input
type="text"
name="Visitor_Name"
required>

</div>

<div class="form-group">

<label>Phone Number</label>

<input
type="text"
name="Visitor_Phone_number"
required>

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

<label>Approved By</label>

<select name="Approved_By" required>

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

<label>Check In Time</label>

<input
type="datetime-local"
name="Check_In_Time"
required>

</div>

<div class="form-group">

<label>Check Out Time</label>

<input
type="datetime-local"
name="Check_Out_Time">

</div>

<div class="form-group">

<label>Purpose</label>

<input
type="text"
name="Purpose"
placeholder="e.g. Family Visit"
required>

</div>

</div>

<div class="form-buttons">

<button
type="submit"
class="save-btn">

Save Visitor

</button>

<a href="visitors.php"
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