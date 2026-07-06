<?php

$base_url = "../";

include "../includes/config.php";
include "../includes/header.php";
include "../includes/sidebar.php";

?>

<main class="main-content">

    <div class="page-title">

        <div>
            <h2>Add Payment</h2>
            <p>Record a student's payment.</p>
        </div>

        <a href="payments.php" class="add-btn">
            ← Back to Payments
        </a>

    </div>

    <div class="form-container">

        <form action="save_payment.php" method="POST">

            <div class="form-grid">

                <div class="form-group">

                    <label>Student</label>

                    <select name="student_id" required>

                        <option value="">Select Student</option>

                        <?php

                        $students = mysqli_query($conn,
                        "SELECT * FROM student ORDER BY student_fname ASC");

                        while($student = mysqli_fetch_assoc($students))
                        {
                        ?>

                        <option value="<?php echo $student['student_id']; ?>">

                            <?php
                            echo $student['student_id']." - ".
                            $student['student_fname']." ".
                            $student['student_lname'];
                            ?>

                        </option>

                        <?php } ?>

                    </select>

                </div>

                <div class="form-group">

                    <label>Payment Amount (GH₵)</label>

                    <input
                    type="number"
                    name="payment_amount"
                    step="0.01"
                    min="0"
                    required>

                </div>
                <div class="form-group">
                    <label>Payment Date</label>
                    <input
                    type="date"
                    name="payment_date"
                    value="<?php echo date('Y-m-d'); ?>"
                    required></div>

                <div class="form-group">

                    <label>Payment Method</label>

                    <select name="payment_method" required>

                        <option value="">Select Method</option>
                        <option value="Cash">Cash</option>
                        <option value="Mobile Money">Mobile Money</option>
                        <option value="Bank Transfer">Bank Transfer</option>

                    </select>

                </div>

                <div class="form-group">

                    <label>Payment Status</label>

                    <select name="payment_status" required>

                        <option value="">Select Status</option>
                        <option value="Paid">Paid</option>
                        <option value="Pending">Pending</option>

                    </select>

                </div>

            </div>

            <div class="form-buttons">

                <button
                type="submit"
                class="save-btn">

                Save Payment

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