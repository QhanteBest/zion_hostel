<?php

$base_url = "../";
include "../includes/auth.php";
include "../includes/config.php";

if (!isset($_GET['id'])) {
    header("Location: payments.php");
    exit();
}

$payment_id = $_GET['id'];

$result = mysqli_query($conn,
"SELECT * FROM payment WHERE payment_id='$payment_id'");

$payment = mysqli_fetch_assoc($result);

if (!$payment) {
    echo "Payment not found.";
    exit();
}

include "../includes/header.php";
include "../includes/sidebar.php";

?>

<main class="main-content">

    <div class="page-title">

        <div>
            <h2>Edit Payment</h2>
            <p>Update payment information.</p>
        </div>

        <a href="payments.php" class="add-btn">
            ← Back to Payments
        </a>

    </div>

    <div class="form-container">

        <form action="update_payment.php" method="POST">

            <input type="hidden"
            name="payment_id"
            value="<?php echo $payment['payment_id']; ?>">

            <div class="form-grid">

                <div class="form-group">
                    <label>Payment Amount</label>

                    <input
                    type="number"
                    name="payment_amount"
                    value="<?php echo $payment['payment_amount']; ?>"
                    step="0.01"
                    required>

                </div>

                <div class="form-group">

                    <label>Payment Date</label>

                    <input
                    type="date"
                    name="payment_date"
                    value="<?php echo $payment['payment_date']; ?>"
                    required>

                </div>

                <div class="form-group">

                    <label>Payment Method</label>

                    <select name="payment_method">

                        <option value="Cash"
                        <?php if($payment['payment_method']=="Cash") echo "selected"; ?>>
                        Cash
                        </option>

                        <option value="Mobile Money"
                        <?php if($payment['payment_method']=="Mobile Money") echo "selected"; ?>>
                        Mobile Money
                        </option>

                        <option value="Bank"
                        <?php if($payment['payment_method']=="Bank") echo "selected"; ?>>
                        Bank
                        </option>

                    </select>

                </div>

                <div class="form-group">

                    <label>Payment Status</label>

                    <select name="payment_status">

                        <option value="Paid"
                        <?php if($payment['payment_status']=="Paid") echo "selected"; ?>>
                        Paid
                        </option>

                        <option value="Pending"
                        <?php if($payment['payment_status']=="Pending") echo "selected"; ?>>
                        Pending
                        </option>

                    </select>

                </div>

            </div>

            <div class="form-buttons">

                <button
                type="submit"
                name="update"
                class="save-btn">

                Update Payment

                </button>

                <a href="payments.php"
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