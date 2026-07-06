<?php

$base_url = "../";

include "../includes/config.php";

if (!isset($_GET['id'])) {
    header("Location: allocation.php");
    exit();
}

$allocation_id = $_GET['id'];

$result = mysqli_query($conn,
"SELECT * FROM allocation WHERE allocation_id='$allocation_id'");

$allocation = mysqli_fetch_assoc($result);

if (!$allocation) {
    die("Allocation not found.");
}

include "../includes/header.php";
include "../includes/sidebar.php";
?>

<main class="main-content">

<div class="page-title">

<div>
<h2>Edit Allocation</h2>
<p>Update room allocation.</p>
</div>

<a href="allocation.php" class="add-btn">
← Back
</a>

</div>

<div class="form-container">

<form action="update_allocation.php" method="POST">

<input type="hidden"
name="allocation_id"
value="<?php echo $allocation['allocation_id']; ?>">

<div class="form-grid">

<div class="form-group">

<label>Student</label>

<select name="student_id" required>

<?php

$students = mysqli_query($conn,
"SELECT * FROM student ORDER BY student_fname");

while($student=mysqli_fetch_assoc($students))
{

$selected="";

if($student['student_id']==$allocation['student_id'])
{
    $selected="selected";
}

?>

<option value="<?php echo $student['student_id']; ?>" <?php echo $selected; ?>>

<?php
echo $student['student_fname']." ".$student['student_lname'];
?>

</option>

<?php } ?>

</select>

</div>

<div class="form-group">

<label>Room</label>

<select name="room_no" required>

<?php

$rooms=mysqli_query($conn,
"SELECT * FROM room ORDER BY room_no");

while($room=mysqli_fetch_assoc($rooms))
{

$selected="";

if($room['room_no']==$allocation['room_no'])
{
$selected="selected";
}

?>

<option value="<?php echo $room['room_no']; ?>" <?php echo $selected; ?>>

<?php
echo $room['room_no']." (".$room['room_type'].")";
?>

</option>

<?php } ?>

</select>

</div>

<div class="form-group">

<label>Start Date</label>

<input
type="date"
name="start_date"
value="<?php echo $allocation['start_date']; ?>"
required>

</div>

<div class="form-group">

<label>End Date</label>

<input
type="date"
name="end_date"
value="<?php echo $allocation['end_date']; ?>"
required>

</div>

</div>

<div class="form-buttons">

<button
type="submit"
name="update"
class="save-btn">

Update Allocation

</button>

<a href="allocation.php"
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