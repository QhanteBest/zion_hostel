<?php
$base_url = "../";
include "../includes/auth.php";
include "../includes/config.php";
include "../includes/header.php";
include "../includes/sidebar.php";
?>

<main class="main-content">

    <div class="page-title">
        <div>
            <h2>Allocate Room</h2>
            <p>Assign a room to a student.</p>
        </div>

        <a href="allocation.php" class="add-btn">
            ← Back to Allocation
        </a>
    </div>

    <div class="form-container">

        <form action="save_allocation.php" method="POST">

            <div class="form-grid">

                <div class="form-group">
                    <label>Student</label>

                    <select name="student_id" required>

                        <option value="">Select Student</option>

                        <?php

                        $students = mysqli_query($conn,
                        "SELECT * FROM student ORDER BY student_fname ASC");

                        while($student = mysqli_fetch_assoc($students))
                        {
                        ?>

                        <option value="<?php echo $student['student_id']; ?>">

                            <?php
                            echo $student['student_id']." - ".
                                 $student['student_fname']." ".
                                 $student['student_lname'];
                            ?>

                        </option>

                        <?php } ?>

                    </select>

                </div>

                <div class="form-group">

                    <label>Room</label>

                    <select name="room_no" required>

                        <option value="">Select Room</option>

                        <?php

                        $rooms = mysqli_query($conn,

                        "SELECT * FROM room
                        WHERE status!='Full'
                        ORDER BY room_no ASC");

                        while($room = mysqli_fetch_assoc($rooms))
                        {
                        ?>

                        <option value="<?php echo $room['room_no']; ?>">

                            <?php

                            echo $room['room_no'].
                            " (".$room['room_type'].") - ".
                            $room['status'];

                            ?>

                        </option>

                        <?php } ?>

                    </select>

                </div>

                <div class="form-group">
                    <label>Start Date</label>

                    <input
                    type="date"
                    name="start_date"
                    required>

                </div>

                <div class="form-group">

                    <label>End Date</label>

                    <input
                    type="date"
                    name="end_date"
                    required>

                </div>

            </div>

            <div class="form-buttons">

                <button
                type="submit"
                class="save-btn">

                Allocate Room

                </button>

                <a href="allocation.php"
                class="cancel-btn">

                Cancel

                </a>

            </div>

        </form>

    </div>

</main>

<?php
include "../includes/footer.php";
?>