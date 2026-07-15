<?php

include "../includes/auth.php";
include "../includes/config.php";

$search = "";

if(isset($_POST['search'])){

    $search = mysqli_real_escape_string(
        $conn,
        trim($_POST['search'])
    );

}

$sql = "SELECT

            complaint.*,
            student.student_fname,
            student.student_lname,
            staff.staff_fname,
            staff.staff_lname

        FROM complaint

        JOIN student
        ON complaint.Student_ID = student.student_id

        JOIN staff
        ON complaint.Staff_ID = staff.staff_id

        WHERE

            complaint.Complaint_ID LIKE '%$search%'
            OR complaint.Description LIKE '%$search%'
            OR complaint.Status LIKE '%$search%'
            OR student.student_fname LIKE '%$search%'
            OR student.student_lname LIKE '%$search%'
            OR staff.staff_fname LIKE '%$search%'
            OR staff.staff_lname LIKE '%$search%'

        ORDER BY complaint.Complaint_ID ASC";

$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result)>0){

while($row=mysqli_fetch_assoc($result)){

$status = strtolower(trim($row['Status']));

$class = "";

if($status=="open"){

    $class="status-open";

}
elseif($status=="resolved"){

    $class="status-resolved";

}
elseif($status=="in progress"){

    $class="status-progress";

}

?>

<tr>

<td><?php echo $row['Complaint_ID']; ?></td>

<td>

<?php echo $row['student_fname']." ".$row['student_lname']; ?>

</td>

<td><?php echo $row['Description']; ?></td>

<td>

<span class="status <?php echo $class; ?>">

<?php echo $row['Status']; ?>

</span>

</td>

<td>

<?php echo $row['staff_fname']." ".$row['staff_lname']; ?>

</td>

<td>

<a href="edit_complaint.php?id=<?php echo $row['Complaint_ID']; ?>" class="edit-btn">

Edit

</a>

<a href="delete_complaint.php?id=<?php echo $row['Complaint_ID']; ?>"
class="delete-btn"
onclick="return confirm('Are you sure you want to delete this complaint?');">

Delete

</a>

</td>

</tr>

<?php

}

}else{

?>

<tr>

<td colspan="6" style="text-align:center;padding:2rem;">

No complaint found.

</td>

</tr>

<?php

}

?>