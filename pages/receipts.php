<?php

$base_url = "../";

include "../includes/header.php";
include "../includes/config.php";
include "../includes/sidebar.php";

?>

<main class="main-content">

    <div class="page-title">

        <div>
            <h2>Receipts</h2>
            <p>Manage all hostel receipts.</p>
        </div>

        <a href="add_receipt.php" class="add-btn">
            + Generate Receipt
        </a>

    </div>

    <div class="table-container">

        <table>

            <thead>

                <tr>
                    <th>Receipt ID</th>
                    <th>Student Name</th>
                    <th>Payment ID</th>
                    <th>Issue Date</th>
                    <th>Payment Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>

            </thead>

            <tbody>

<?php

$sql = mysqli_query($conn,

"SELECT
receipt.*,
student.student_fname,
student.student_lname

FROM receipt

JOIN student
ON receipt.Student_ID = student.student_id

ORDER BY Receipt_ID ASC");

while($row = mysqli_fetch_assoc($sql))
{

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

    <td><?php echo $row['Payment_Status']; ?></td>

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
?>

            </tbody>

        </table>

    </div>

</main>

<?php
include "../includes/footer.php";
?>