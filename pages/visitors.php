<?php

$base_url = "../";

include "../includes/header.php";
include "../includes/config.php";
include "../includes/sidebar.php";

?>

<main class="main-content">

<div class="page-title">

    <div>
        <h2>Visitors</h2>
        <p>Manage hostel visitors.</p>
    </div>

    <a href="add_visitor.php" class="add-btn">
        + Add Visitor
    </a>

</div>

<div class="table-container">

<table>

<thead>

<tr>
    <th>Visitor ID</th>
    <th>Visitor's Name</th>
    <th>Phone Number</th>
    <th>Student Name</th>
    <th>Purpose</th>
    <th>Approved By</th>
    <th>Check - In</th>
    <th>Check - Out</th>
    <th>Action</th>
</tr>

</thead>

<tbody>

<?php

$visitors = mysqli_query($conn,

"SELECT visitor.*,
student.student_fname,
student.student_lname,
staff.staff_fname,
staff.staff_lname

FROM visitor

JOIN student
ON visitor.Student_ID = student.student_id

JOIN staff
ON visitor.Approved_By = staff.staff_id

ORDER BY Visitor_ID ASC");

while($row = mysqli_fetch_assoc($visitors))
{

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

?>

</tbody>

</table>

</div>

</main>

<?php
include "../includes/footer.php";
?>