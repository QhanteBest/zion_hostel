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

            receipt.*,
            student.student_fname,
            student.student_lname

        FROM receipt

        JOIN student
        ON receipt.Student_ID = student.student_id

        WHERE

            Receipt_ID LIKE '%$search%'
            OR Payment_ID LIKE '%$search%'
            OR Receipt_Issue_Date LIKE '%$search%'
            OR Payment_Date LIKE '%$search%'
            OR Payment_Status LIKE '%$search%'
            OR student_fname LIKE '%$search%'
            OR student_lname LIKE '%$search%'

        ORDER BY Receipt_ID ASC";

$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result)>0){

while($row=mysqli_fetch_assoc($result)){

$status = strtolower(trim($row['Payment_Status']));

$class = "";

if($status=="paid"){

    $class="status-paid";

}
elseif($status=="pending"){

    $class="status-pending";

}

?>

<tr>

<td><?php echo $row['Receipt_ID']; ?></td>

<td>

<?php

echo $row['student_fname']." ".$row['student_lname'];

?>

</td>

<td><?php echo $row['Payment_ID']; ?></td>

<td><?php echo $row['Receipt_Issue_Date']; ?></td>

<td><?php echo $row['Payment_Date']; ?></td>

<td>

<span class="status <?php echo $class; ?>">

<?php echo $row['Payment_Status']; ?>

</span>

</td>

<td>

<a href="edit_receipt.php?id=<?php echo $row['Receipt_ID']; ?>" class="edit-btn">

Edit

</a>

<a href="delete_receipt.php?id=<?php echo $row['Receipt_ID']; ?>"
class="delete-btn"
onclick="return confirm('Delete this receipt?');">

Delete

</a>

</td>

</tr>

<?php

}

}else{

?>

<tr>

<td colspan="7" style="text-align:center;padding:2rem;">

No receipt found.

</td>

</tr>

<?php

}

?>