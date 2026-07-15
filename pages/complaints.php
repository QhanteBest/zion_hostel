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

            <h2>Complaints</h2>

            <p>Manage hostel complaints.</p>

        </div>

        <a href="add_complaint.php" class="add-btn">

            + Add Complaint

        </a>

    </div>


    <!-- SEARCH BAR -->

    <div class="search-container">

        <i class="fa-solid fa-magnifying-glass search-icon"></i>

        <input
            type="text"
            id="search"
            placeholder="Search by Complaint ID, Student, Status..."
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

                    <th>Complaint ID</th>
                    <th>Student Name</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Assigned Staff</th>
                    <th>Action</th>

                </tr>

            </thead>

            <tbody id="complaintTable">

            </tbody>

        </table>

    </div>

</main>

<script src="<?php echo $base_url; ?>javaScript/complaints.js"></script>

<?php

include "../includes/footer.php";

?>