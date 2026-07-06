<?php

$base_url = "../";

include "../includes/header.php";
include "../includes/config.php";
include "../includes/sidebar.php";

?>

<main class="main-content">

    <div class="page-title">

        <div>
            <h2>Staff</h2>
            <p>Manage hostel staff members.</p>
        </div>

        <a href="add_staff.php" class="add-btn">
            + Add Staff
        </a>

    </div>

    <div class="table-container">

        <table>

            <thead>

                <tr>
                    <th>Staff ID</th>
                    <th>Full Name</th>
                    <th>Phone Number</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>

            </thead>

            <tbody>

<?php

$staff = mysqli_query($conn,
"SELECT * FROM staff
ORDER BY staff_id ASC");

while($row = mysqli_fetch_assoc($staff))
{

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
?>

            </tbody>

        </table>

    </div>

</main>

<?php
include "../includes/footer.php";
?>