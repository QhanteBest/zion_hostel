<?php

$base_url = "../";

include "../includes/config.php";
include "../includes/header.php";
include "../includes/sidebar.php";

?>

<main class="main-content">

    <div class="page-title">

        <div>
            <h2>Generate Receipt</h2>
            <p>Create a receipt for a payment.</p>
        </div>

        <a href="receipts.php" class="add-btn">
            ← Back to Receipts
        </a>

    </div>

    <div class="form-container">

        <form action="save_receipt.php" method="POST">

            <div class="form-grid">

                <div class="form-group">
                    <label>Receipt ID</label>
                    <input
                        type="number"
                        name="Receipt_ID"
                        required>
                </div>

                <div class="form-group">
                    <label>Payment ID</label>

                    <select name="Payment_ID" required>

                        <option value="">Select Payment</option>

                        <?php

                        $payments = mysqli_query($conn,
                        "SELECT payment_id
                        FROM payment
                        WHERE payment_id NOT IN
                        (SELECT Payment_ID FROM receipt)
                        ORDER BY payment_id ASC");

                        while($row = mysqli_fetch_assoc($payments))
                        {
                        ?>

                        <option value="<?php echo $row['payment_id']; ?>">
                            <?php echo $row['payment_id']; ?>
                        </option>

                        <?php } ?>

                    </select>

                </div>

                <div class="form-group">
                    <label>Receipt Issue Date</label>

                    <input
                        type="date"
                        name="Receipt_Issue_Date"
                        value="<?php echo date('Y-m-d'); ?>"
                        required>

                </div>

            </div>

            <div class="form-buttons">

                <button
                    type="submit"
                    class="save-btn">
                    Generate Receipt
                </button>

                <a href="receipts.php" class="cancel-btn">
                    Cancel
                </a>

            </div>

        </form>

    </div>

</main>

<?php
include "../includes/footer.php";
?>