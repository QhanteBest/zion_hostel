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

$sql = "SELECT *

        FROM staff

        WHERE

        staff_id LIKE '%$search%'
        OR staff_fname LIKE '%$search%'
        OR staff_lname LIKE '%$search%'
        OR staff_phone_number LIKE '%$search%'
        OR staff_role LIKE '%$search%'

        ORDER BY staff_id ASC";

$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result)>0){

while($row=mysqli_fetch_assoc($result)){

?>

<tr>

<td><?php echo $row['staff_id']; ?></td>

<td>

<?php

echo $row['staff_fname']." ".$row['staff_lname'];

?>

</td>

<td><?php echo $row['staff_phone_number']; ?></td>

<td><?php echo $row['staff_role']; ?></td>

<td>

<a href="edit_staff.php?id=<?php echo $row['staff_id']; ?>" class="edit-btn">

Edit

</a>

<a href="delete_staff.php?id=<?php echo $row['staff_id']; ?>"
class="delete-btn"
onclick="return confirm('Are you sure you want to delete this staff member?');">

Delete

</a>

</td>

</tr>

<?php

}

}else{

?>

<tr>

<td colspan="5" style="text-align:center;padding:2rem;">

No staff member found.

</td>

</tr>

<?php

}

?>