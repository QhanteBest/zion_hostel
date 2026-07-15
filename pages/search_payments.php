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

            p.payment_id,
            p.payment_amount,
            p.payment_method,
            p.payment_date,
            p.payment_status,
            s.student_fname,
            s.student_lname

        FROM payment p

        JOIN student s
        ON p.student_id = s.student_id

        WHERE

            p.payment_id LIKE '%$search%'
            OR p.payment_amount LIKE '%$search%'
            OR p.payment_method LIKE '%$search%'
            OR p.payment_date LIKE '%$search%'
            OR p.payment_status LIKE '%$search%'
            OR s.student_fname LIKE '%$search%'
            OR s.student_lname LIKE '%$search%'

        ORDER BY p.payment_id ASC";

$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result)>0){

while($row=mysqli_fetch_assoc($result)){

$status = strtolower(trim($row['payment_status']));

$class="";

if($status=="paid"){

    $class="status-paid";

}
elseif($status=="pending"){

    $class="status-pending";

}

?>

<tr>

<td><?php echo $row['payment_id']; ?></td>

<td>

<?php

echo $row['student_fname']." ".$row['student_lname'];

?>

</td>

<td>

GH₵ <?php echo number_format($row['payment_amount'],2); ?>

</td>

<td><?php echo $row['payment_method']; ?></td>

<td>

<?php echo date("d M Y",strtotime($row['payment_date'])); ?>

</td>

<td>

<span class="status <?php echo $class; ?>">

<?php echo $row['payment_status']; ?>

</span>

</td>

<td>

<a href="edit_payment.php?id=<?php echo $row['payment_id']; ?>" class="edit-btn">

Edit

</a>

<a href="delete_payment.php?id=<?php echo $row['payment_id']; ?>"
class="delete-btn"
onclick="return confirm('Delete this payment?');">

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

No payment found.

</td>

</tr>

<?php

}

?>