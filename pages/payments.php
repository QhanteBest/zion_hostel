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

            <h2>Payments</h2>

            <p>Manage hostel payment records.</p>

        </div>

        <a href="add_payment.php" class="add-btn">

            + Add Payment

        </a>

    </div>


    <!-- SEARCH BAR -->

    <div class="search-container">

        <i class="fa-solid fa-magnifying-glass search-icon"></i>

        <input
            type="text"
            id="search"
            placeholder="Search by Payment ID, Student or Status..."
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

                    <th>Payment ID</th>
                    <th>Student Name</th>
                    <th>Amount</th>
                    <th>Method</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Action</th>

                </tr>

            </thead>

            <tbody id="paymentTable">

            </tbody>

        </table>

    </div>

</main>

<script src="<?php echo $base_url; ?>javaScript/payments.js"></script>

<?php

include "../includes/footer.php";

?>