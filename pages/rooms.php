<?php
$base_url = "../";

include "../includes/header.php";
include "../includes/config.php";
include "../includes/sidebar.php";
?>

<main class="main-content">

    <div class="page-title">

        <div>
            <h2>Rooms</h2>
            <p>Manage all hostel rooms.</p>
        </div>

        <a href="add_room.php" class="add-btn">
            + Add Room
        </a>

    </div>

    <div class="table-container">

        <table>

            <thead>

                <tr>

                    <th>Room No</th>
                    <th>Room Type</th>
                    <th>Capacity</th>
                    <th>Occupancy</th>
                    <th>Status</th>
                    <th>Action</th>

                </tr>

            </thead>

            <tbody>

            <?php

            $rooms = mysqli_query($conn,
            "SELECT * FROM room ORDER BY room_no ASC");

            while($row = mysqli_fetch_assoc($rooms))
            {
            ?>

                <tr>

                    <td><?php echo $row['room_no']; ?></td>

                    <td><?php echo $row['room_type']; ?></td>

                    <td><?php echo $row['capacity']; ?></td>

                    <td><?php echo $row['current_occupancy']; ?></td>

                    <td><?php echo $row['status']; ?></td>

                    <td>

                        <a href="edit_room.php?id=<?php echo $row['room_no']; ?>" class="edit-btn">
                            Edit
                        </a>

                        <a href="delete_room.php?id=<?php echo $row['room_no']; ?>"
                        class="delete-btn"
                        onclick="return confirm('Delete this room?');">
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