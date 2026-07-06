<?php
$base_url = "../";

include "../includes/header.php";
include "../includes/config.php";
include "../includes/sidebar.php";
?>

<main class="main-content">

    <div class="page-title">

        <div>
            <h2>Room Allocation</h2>
            <p>Allocate hostel rooms to students.</p>
        </div>

        <a href="add_allocation.php" class="add-btn">
            + Allocate Room
        </a>

    </div>

    <div class="table-container">

        <table>

            <thead>

                <tr>
                    <th>Allocation ID</th>
                    <th>Student</th>
                    <th>Room</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Action</th>
                </tr>

            </thead>

            <tbody>

            <?php

            $allocations = mysqli_query($conn,

            "SELECT
                a.allocation_id,
                a.room_no,
                a.start_date,
                a.end_date,
                s.student_fname,
                s.student_lname

            FROM allocation a

            JOIN student s
            ON a.student_id = s.student_id

            ORDER BY a.allocation_id ASC");

            while($row = mysqli_fetch_assoc($allocations))
            {
            ?>

                <tr>

                    <td><?php echo $row['allocation_id']; ?></td>

                    <td>
                        <?php
                        echo $row['student_fname'] . " " . $row['student_lname'];
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
            ?>

            </tbody>

        </table>

    </div>

</main>

<?php
include "../includes/footer.php";
?>