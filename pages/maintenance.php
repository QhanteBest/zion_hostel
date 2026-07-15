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

            <h2>Maintenance</h2>

            <p>Manage hostel maintenance records.</p>

        </div>

        <a href="add_maintenance.php" class="add-btn">

            + Add Maintenance

        </a>

    </div>

    <!-- SEARCH BAR -->

    <div class="search-container">

        <i class="fa-solid fa-magnifying-glass search-icon"></i>

        <input
            type="text"
            id="search"
            placeholder="Search by ID, Type, Room or Staff..."
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

                    <th>Maintenance ID</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Room</th>
                    <th>Assigned Staff</th>
                    <th>Action</th>

                </tr>

            </thead>

            <tbody id="maintenanceTable">

            </tbody>

        </table>

    </div>

</main>

<script src="<?php echo $base_url; ?>javaScript/maintenance.js"></script>

<?php

include "../includes/footer.php";

?>