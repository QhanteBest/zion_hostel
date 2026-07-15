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

            report.*,
            staff.staff_fname,
            staff.staff_lname

        FROM report

        JOIN staff
        ON report.Staff_ID = staff.staff_id

        WHERE

            report.Report_ID LIKE '%$search%'
            OR report.Report_Type LIKE '%$search%'
            OR report.Report_Name LIKE '%$search%'
            OR report.Start_Date LIKE '%$search%'
            OR report.End_Date LIKE '%$search%'
            OR staff.staff_fname LIKE '%$search%'
            OR staff.staff_lname LIKE '%$search%'

        ORDER BY report.Report_ID ASC";

$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result)>0){

while($row=mysqli_fetch_assoc($result)){

?>

<tr>

<td><?php echo $row['Report_ID']; ?></td>

<td><?php echo $row['Report_Type']; ?></td>

<td><?php echo $row['Report_Name']; ?></td>

<td><?php echo $row['Start_Date']; ?></td>

<td><?php echo $row['End_Date']; ?></td>

<td>

<?php

echo $row['staff_fname']." ".$row['staff_lname'];

?>

</td>

<td>

<a href="view_report.php?id=<?php echo $row['Report_ID']; ?>" class="edit-btn">

View

</a>

</td>

</tr>

<?php

}

}else{

?>

<tr>

<td colspan="7" style="text-align:center;padding:2rem;">

No report found.

</td>

</tr>

<?php

}

?>