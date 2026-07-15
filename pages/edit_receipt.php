<?php

$base_url = "../";
include "../includes/auth.php";
include "../includes/config.php";

if (!isset($_GET['id'])) {
    header("Location: receipts.php");
    exit();
}

$Receipt_ID = $_GET['id'];

$result = mysqli_query($conn,
"SELECT * FROM receipt
WHERE Receipt_ID='$Receipt_ID'");

$receipt = mysqli_fetch_assoc($result);

if (!$receipt) {
    echo "Receipt not found.";
    exit();
}

include "../includes/header.php";
include "../includes/sidebar.php";

?>

<main class="main-content">

<div class="page-title">

    <div>
        <h2>Edit Receipt</h2>
        <p>Update receipt information.</p>
    </div>

    <a href="receipts.php" class="add-btn">
        ← Back to Receipts
    </a>

</div>

<form action="update_receipt.php" method="POST">

    <input
    type="hidden"
    name="Receipt_ID"
    value="<?php echo $receipt['Receipt_ID']; ?>">

    <div class="form-grid">

        <div class="form-group">
            <label>Receipt ID</label>

            <input
            type="text"
            value="<?php echo $receipt['Receipt_ID']; ?>"
            readonly>
        </div>

        <div class="form-group">
            <label>Receipt Issue Date</label>

            <input
            type="date"
            name="Receipt_Issue_Date"
            value="<?php echo $receipt['Receipt_Issue_Date']; ?>"
            required>
        </div>

        <div class="form-group">
            <label>Payment ID</label>

            <input
            type="text"
            value="<?php echo $receipt['Payment_ID']; ?>"
            readonly>
        </div>

        <div class="form-group">
            <label>Payment Date</label>

            <input
            type="date"
            value="<?php echo $receipt['Payment_Date']; ?>"
            readonly>
        </div>

        <div class="form-group">
            <label>Payment Status</label>

            <input
            type="text"
            value="<?php echo $receipt['Payment_Status']; ?>"
            readonly>
        </div>

    </div>

    <div class="form-buttons">

        <button
        type="submit"
        name="update"
        class="save-btn">

        Update Receipt

        </button>

        <a href="receipts.php"
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