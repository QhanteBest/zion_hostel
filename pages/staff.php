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

            <h2>Staff</h2>

            <p>Manage hostel staff members.</p>

        </div>

        <a href="add_staff.php" class="add-btn">

            + Add Staff

        </a>

    </div>


    <!-- SEARCH BAR -->

    <div class="search-container">

        <i class="fa-solid fa-magnifying-glass search-icon"></i>

        <input
            type="text"
            id="search"
            placeholder="Search by Staff ID, Name or Role..."
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

                    <th>Staff ID</th>
                    <th>Full Name</th>
                    <th>Phone Number</th>
                    <th>Role</th>
                    <th>Action</th>

                </tr>

            </thead>

            <tbody id="staffTable">

            </tbody>

        </table>

    </div>

</main>

<script src="<?php echo $base_url; ?>javaScript/staff.js"></script>

<?php

include "../includes/footer.php";

?>