<?php
$base_url = "../";

include "../includes/config.php";

if (!isset($_GET['id'])) {
    header("Location: rooms.php");
    exit();
}

$room_no = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM room WHERE room_no='$room_no'");

$room = mysqli_fetch_assoc($result);

if (!$room) {
    echo "Room not found.";
    exit();
}

include "../includes/header.php";
include "../includes/sidebar.php";
?>

<main class="main-content">

    <div class="page-title">

        <div>
            <h2>Edit Room</h2>
            <p>Update room information.</p>
        </div>

        <a href="rooms.php" class="add-btn">
            ← Back to Rooms
        </a>

    </div>

    <div class="form-container">

        <form action="update_room.php" method="POST">

            <input type="hidden" name="room_no"
            value="<?php echo $room['room_no']; ?>">

            <div class="form-grid">

                <div class="form-group">
                    <label>Room Number</label>
                    <input type="text"
                    value="<?php echo $room['room_no']; ?>">
                </div>

                <div class="form-group">
                    <label>Room Type</label>

                    <select name="room_type" required>

                        <option value="1-in-1"
                        <?php if($room['room_type']=="1-in-1") echo "selected"; ?>>
                        1-in-1
                        </option>

                        <option value="2-in-1"
                        <?php if($room['room_type']=="2-in-1") echo "selected"; ?>>
                        2-in-1
                        </option>

                        <option value="3-in-1"
                        <?php if($room['room_type']=="3-in-1") echo "selected"; ?>>
                        3-in-1
                        </option>

                    </select>

                </div>

                <div class="form-group">
                    <label>Capacity</label>

                    <input type="number"
                    name="capacity"
                    value="<?php echo $room['capacity']; ?>"
                    min="1"
                    required>

                </div>

                <div class="form-group">

                    <label>Current Occupancy</label>

                    <input type="number"
                    name="current_occupancy"
                    value="<?php echo $room['current_occupancy']; ?>"
                    min="0"
                    required>

                </div>

            </div>

            <div class="form-buttons">

                <button type="submit"
                name="update"
                class="save-btn">
                    Update Room
                </button>

                <a href="rooms.php"
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