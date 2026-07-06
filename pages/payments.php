<?php

$base_url = "../";

include "../includes/header.php";
include "../includes/config.php";
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

    <div class="table-container">

        <table>

            <thead>

                <tr>
                    <th>Payment ID</th>
                    <th>Student</th>
                    <th>Amount</th>
                    <th>Method</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>

            </thead>

            <tbody>

            <?php

            $payments = mysqli_query($conn,

            "SELECT
                p.payment_id,
                p.payment_amount,
                p.payment_method,
                p.payment_status,
                s.student_fname,
                s.student_lname

            FROM payment p

            JOIN student s
            ON p.student_id = s.student_id

            ORDER BY p.payment_id ASC");

            while($row = mysqli_fetch_assoc($payments))
            {

            ?>

                <tr>

                    <td><?php echo $row['payment_id']; ?></td>

                    <td>

                        <?php
                        echo $row['student_fname']." ".$row['student_lname'];
                        ?>

                    </td>

                    <td>

                        GH₵ <?php echo number_format($row['payment_amount'],2); ?>

                    </td>

                    <td>

                        <?php echo $row['payment_method']; ?>

                    </td>

                    <td>

                        <?php echo $row['payment_status']; ?>

                    </td>

                    <td>

                        <a href="edit_payment.php?id=<?php echo $row['payment_id']; ?>" class="edit-btn">
                            Edit
                        </a>

                        <a href="delete_payment.php?id=<?php echo $row['payment_id']; ?>"
                        class="delete-btn"
                        onclick="return confirm('Delete this payment?');">

                        Delete

                        </a>

                    </td>

                </tr>

            <?php

            }

            ?>

            </tbody>

        </table>

    </div>

</main>

<?php
include "../includes/footer.php";
?>