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

            <h2>Rooms</h2>

            <p>Manage all hostel rooms.</p>

        </div>

        <a href="add_room.php" class="add-btn">

            + Add Room

        </a>

    </div>


    <!-- SEARCH BAR -->

    <div class="search-container">

        <i class="fa-solid fa-magnifying-glass search-icon"></i>

        <input
            type="text"
            id="search"
            placeholder="Search by Room No, Type or Status..."
        >

        <button
            type="button"
            class="clear-search"
            id="clearSearch">

            <i class="fa-solid fa-xmark"></i>

        </button>

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

            <tbody id="roomTable">

                <!-- Rooms will load here -->

            </tbody>

        </table>

    </div>

</main>

<script src="<?php echo $base_url; ?>javaScript/rooms.js"></script>

<?php

include "../includes/footer.php";

?>