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
            <h2>Add New Room</h2>
            <p>Create a new hostel room.</p>
        </div>

        <a href="rooms.php" class="add-btn">
            ← Back to Rooms
        </a>

    </div>

    <div class="form-container">

        <form action="save_room.php" method="POST">

            <div class="form-grid">

                <div class="form-group">
                    <label>Room Number</label>
                    <input type="text" name="room_no" placeholder="e.g. R11" required>
                </div>

                <div class="form-group">
                    <label>Room Type</label>
                    <select name="room_type" required>
                        <option value="">Select Room Type</option>
                        <option value="1-in-1">1-in-1</option>
                        <option value="2-in-1">2-in-1</option>
                        <option value="3-in-1">3-in-1</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Capacity</label>
                    <input type="number" name="capacity" min="1" required>
                </div>

                <div class="form-group">
                    <label>Current Occupancy</label>
                    <input type="number" name="current_occupancy" min="0" required>
                </div>

            </div>

            <div class="form-buttons">

                <button type="submit" class="save-btn">
                    Save Room
                </button>

                <a href="rooms.php" class="cancel-btn">
                    Cancel
                </a>

            </div>

        </form>

    </div>

</main>

<?php
include "../includes/footer.php";
?>