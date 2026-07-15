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

            a.allocation_id,
            a.room_no,
            a.start_date,
            a.end_date,
            s.student_fname,
            s.student_lname

        FROM allocation a

        JOIN student s
        ON a.student_id = s.student_id

        WHERE

            a.allocation_id LIKE '%$search%'
            OR a.room_no LIKE '%$search%'
            OR a.start_date LIKE '%$search%'
            OR a.end_date LIKE '%$search%'
            OR s.student_fname LIKE '%$search%'
            OR s.student_lname LIKE '%$search%'

        ORDER BY a.allocation_id ASC";

$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result)>0){

while($row=mysqli_fetch_assoc($result)){

?>

<tr>

    <td><?php echo $row['allocation_id']; ?></td>

    <td>

        <?php

        echo $row['student_fname']." ".$row['student_lname'];

        ?>

    </td>

    <td><?php echo $row['room_no']; ?></td>

    <td><?php echo $row['start_date']; ?></td>

    <td><?php echo $row['end_date']; ?></td>

    <td>

        <a href="edit_allocation.php?id=<?php echo $row['allocation_id']; ?>" class="edit-btn">

            Edit

        </a>

        <a href="delete_allocation.php?id=<?php echo $row['allocation_id']; ?>"
           class="delete-btn"
           onclick="return confirm('Delete this allocation?');">

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

No allocation found.

</td>

</tr>

<?php

}

?>