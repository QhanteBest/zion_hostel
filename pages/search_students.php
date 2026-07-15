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
        FROM student
        WHERE student_id LIKE '%$search%'
        OR student_fname LIKE '%$search%'
        OR student_lname LIKE '%$search%'
        OR student_phone_number LIKE '%$search%'
        OR emergency_contact_name LIKE '%$search%'
        OR emergency_contact_number LIKE '%$search%'
        ORDER BY student_id ASC";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0){

    while($row = mysqli_fetch_assoc($result)){

?>

<tr>

    <td><?php echo $row['student_id']; ?></td>

    <td>

        <?php

        echo $row['student_fname']." ".$row['student_lname'];

        ?>

    </td>

    <td><?php echo $row['student_phone_number']; ?></td>

    <td><?php echo $row['emergency_contact_name']; ?></td>

    <td><?php echo $row['emergency_contact_number']; ?></td>

    <td>

        <a href="edit_student.php?id=<?php echo $row['student_id']; ?>" class="edit-btn">

            Edit

        </a>

        <a href="delete_student.php?id=<?php echo $row['student_id']; ?>"
           class="delete-btn"
           onclick="return confirm('Are you sure you want to delete this student?');">

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

        No student found.

    </td>

</tr>

<?php

}

?>