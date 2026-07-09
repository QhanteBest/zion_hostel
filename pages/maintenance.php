<?php

$base_url = "../";

include "../includes/header.php";
include "../includes/config.php";
include "../includes/sidebar.php";

?>

<main class="main-content">

<div class="page-title">

    <div>

        <h2>Maintenance</h2>

        <p>Manage hostel maintenance records.</p>

    </div>

    <a href="add_maintenance.php" class="add-btn">

        + Add Maintenance

    </a>

</div>

<div class="table-container">

<table>

<thead>

<tr>

<th>Maintenance ID</th>
<th>Type</th>
<th>Status</th>
<th>Room</th>
<th>Assigned Staff</th>
<th>Action</th>

</tr>

</thead>

<tbody>

<?php

$maintenance = mysqli_query($conn,

"SELECT maintenance.*,
room.room_no,
staff.staff_fname,
staff.staff_lname

FROM maintenance

JOIN room
ON maintenance.Room_no = room.room_no

JOIN staff
ON maintenance.Staff_ID = staff.staff_id

ORDER BY Maintenance_ID ASC");

while($row=mysqli_fetch_assoc($maintenance))
{

?>

<tr>

<td><?php echo $row['Maintenance_ID']; ?></td>

<td><?php echo $row['Maintenance_Type']; ?></td>

<td><?php echo $row['Maintenance_Status']; ?></td>

<td><?php echo $row['room_no']; ?></td>

<td>

<?php

echo $row['staff_fname']." ".$row['staff_lname'];

?>

</td>

<td>

<a href="edit_maintenance.php?id=<?php echo $row['Maintenance_ID']; ?>" class="edit-btn">
Edit
</a>

<a href="delete_maintenance.php?id=<?php echo $row['Maintenance_ID']; ?>"
class="delete-btn"
onclick="return confirm('Are you sure you want to delete this maintenance record?');">
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