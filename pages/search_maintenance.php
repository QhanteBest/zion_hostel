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

maintenance.*,
room.room_no,
staff.staff_fname,
staff.staff_lname

FROM maintenance

JOIN room
ON maintenance.Room_no = room.room_no

JOIN staff
ON maintenance.Staff_ID = staff.staff_id

WHERE

maintenance.Maintenance_ID LIKE '%$search%'
OR maintenance.Maintenance_Type LIKE '%$search%'
OR maintenance.Maintenance_Status LIKE '%$search%'
OR room.room_no LIKE '%$search%'
OR staff.staff_fname LIKE '%$search%'
OR staff.staff_lname LIKE '%$search%'

ORDER BY Maintenance_ID ASC";

$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result)>0){

while($row=mysqli_fetch_assoc($result)){

$status = strtolower(trim($row['Maintenance_Status']));

$class = "";

if($status=="pending"){

    $class="status-pending";

}
elseif($status=="resolved" || $status=="completed"){

    $class="status-resolved";

}
elseif($status=="in progress"){

    $class="status-progress";

}

?>

<tr>

<td><?php echo $row['Maintenance_ID']; ?></td>

<td><?php echo $row['Maintenance_Type']; ?></td>

<td>

<span class="status <?php echo $class; ?>">

<?php echo $row['Maintenance_Status']; ?>

</span>

</td>

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

}else{

?>

<tr>

<td colspan="6" style="text-align:center;padding:2rem;">

No maintenance record found.

</td>

</tr>

<?php

}

?>