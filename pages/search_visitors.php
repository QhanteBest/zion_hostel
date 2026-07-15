<?php

include "../includes/auth.php";
include "../includes/config.php";

$search = "";

if(isset($_POST['search'])){

    $search = mysqli_real_escape_string($conn, trim($_POST['search']));

}

$sql = "SELECT

visitor.*,
student.student_fname,
student.student_lname,
staff.staff_fname,
staff.staff_lname

FROM visitor

JOIN student
ON visitor.Student_ID = student.student_id

JOIN staff
ON visitor.Approved_By = staff.staff_id

WHERE

visitor.Visitor_ID LIKE '%$search%'
OR visitor.Visitor_Name LIKE '%$search%'
OR visitor.Visitor_Phone_number LIKE '%$search%'
OR visitor.Purpose LIKE '%$search%'
OR visitor.Check_In_Time LIKE '%$search%'
OR visitor.Check_Out_Time LIKE '%$search%'
OR student.student_fname LIKE '%$search%'
OR student.student_lname LIKE '%$search%'
OR staff.staff_fname LIKE '%$search%'
OR staff.staff_lname LIKE '%$search%'

ORDER BY visitor.Visitor_ID ASC";

$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result)>0){

while($row=mysqli_fetch_assoc($result)){

?>

<tr>

<td><?php echo $row['Visitor_ID']; ?></td>

<td><?php echo $row['Visitor_Name']; ?></td>

<td><?php echo $row['Visitor_Phone_number']; ?></td>

<td>

<?php

echo $row['student_fname']." ".$row['student_lname'];

?>

</td>

<td><?php echo $row['Purpose']; ?></td>

<td>

<?php

echo $row['staff_fname']." ".$row['staff_lname'];

?>

</td>

<td><?php echo $row['Check_In_Time']; ?></td>

<td>

<?php

echo $row['Check_Out_Time'] ? $row['Check_Out_Time'] : "Still Inside";

?>

</td>

<td class="action-column">

<a href="edit_visitor.php?id=<?php echo $row['Visitor_ID']; ?>" class="edit-btn">

Edit

</a>

<br><br>

<a href="delete_visitor.php?id=<?php echo $row['Visitor_ID']; ?>"
class="delete-btn"
onclick="return confirm('Are you sure you want to delete this visitor?');">

Delete

</a>

</td>

</tr>

<?php

}

}else{

?>

<tr>

<td colspan="9" style="text-align:center;padding:2rem;">

No visitor found.

</td>

</tr>

<?php

}

?>