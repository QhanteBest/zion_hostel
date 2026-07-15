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

            <h2>Receipts</h2>

            <p>Manage all hostel receipts.</p>

        </div>

        <a href="add_receipt.php" class="add-btn">

            + Generate Receipt

        </a>

    </div>


    <!-- SEARCH BAR -->

    <div class="search-container">

        <i class="fa-solid fa-magnifying-glass search-icon"></i>

        <input
            type="text"
            id="search"
            placeholder="Search by Receipt ID, Student or Payment ID..."
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

                    <th>Receipt ID</th>
                    <th>Student Name</th>
                    <th>Payment ID</th>
                    <th>Issue Date</th>
                    <th>Payment Date</th>
                    <th>Status</th>
                    <th>Action</th>

                </tr>

            </thead>

            <tbody id="receiptTable">

            </tbody>

        </table>

    </div>

</main>

<script src="<?php echo $base_url; ?>javaScript/receipts.js"></script>

<?php

include "../includes/footer.php";

?>