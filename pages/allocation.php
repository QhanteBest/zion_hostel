<?php

$base_url = "../";

include "../includes/auth.php";
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


    <!-- SEARCH BAR -->

    <div class="search-container">

        <i class="fa-solid fa-magnifying-glass search-icon"></i>

        <input
            type="text"
            id="search"
            placeholder="Search by Student, Room or Allocation ID..."
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

                    <th>Allocation ID</th>
                    <th>Student</th>
                    <th>Room</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Action</th>

                </tr>

            </thead>

            <tbody id="allocationTable">

            </tbody>

        </table>

    </div>

</main>

<script src="<?php echo $base_url; ?>javaScript/allocation.js"></script>

<?php

include "../includes/footer.php";

?>