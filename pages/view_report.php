<?php

$base_url = "../";
include "../includes/auth.php";
include "../includes/config.php";
include "../includes/header.php";
include "../includes/sidebar.php";


// Check if the report ID was sent
if (!isset($_GET['id'])) {

    header("Location: reports.php");
    exit();

}


// Get the report ID
$report_id = $_GET['id'];


// Get the selected report
$report_result = mysqli_query(
    $conn,
    "SELECT
        report.*,
        staff.staff_fname,
        staff.staff_lname

    FROM report

    JOIN staff
    ON report.Staff_ID = staff.staff_id

    WHERE report.Report_ID = '$report_id'"
);


// Get the report information
$report = mysqli_fetch_assoc($report_result);


// Check if the report exists
if (!$report) {

    echo "Report not found.";
    exit();

}


// Store the report information
$report_type = $report['Report_Type'];

$start_date = $report['Start_Date'];

$end_date = $report['End_Date'];


// This will hold the selected report data
$data = false;

// ==========================================
// 1. STUDENT REPORT
// ==========================================

if ($report_type == "Student Report") {

    $data = mysqli_query(
        $conn,
        "SELECT
            student.student_id AS 'Student ID',

            CONCAT(
                student.student_fname,
                ' ',
                student.student_lname
            ) AS 'Full Name',

            student.student_phone_number AS 'Phone Number',

            room.room_type AS 'Room Type',

            room.room_no AS 'Room Number'

        FROM student

        JOIN allocation
        ON student.student_id = allocation.student_id

        JOIN room
        ON allocation.room_no = room.room_no

        ORDER BY student.student_id ASC"
    );

}

// ==========================================
// OCCUPANCY REPORT
// ==========================================

elseif ($report_type == "Occupancy Report") {

    $data = mysqli_query(
        $conn,
        "SELECT
            room_no AS 'Room Number',
            room_type AS 'Room Type',
            capacity AS 'Capacity',
            current_occupancy AS 'Current Occupancy',
            (capacity - current_occupancy) AS 'Available Beds',
            status AS 'Status'

        FROM room

        ORDER BY room_no ASC"
    );

}

// ==========================================
// PAYMENT REPORT
// ==========================================

elseif ($report_type == "Payment Report") {

    $data = mysqli_query(
        $conn,
        "SELECT
            payment.payment_id AS 'Payment ID',

            CONCAT(
                student.student_fname,
                ' ',
                student.student_lname
            ) AS 'Student Name',

            payment.payment_amount AS 'Amount',

            payment.payment_method AS 'Payment Method',

            payment.payment_date AS 'Payment Date',

            payment.payment_status AS 'Status'

        FROM payment

        JOIN student
        ON payment.student_id = student.student_id

        ORDER BY payment.payment_date DESC"
    );

}

// ==========================================
// FINANCIAL REPORT
// ==========================================

elseif ($report_type == "Financial Report") {

    $data = mysqli_query(
        $conn,
        "SELECT
            payment_method AS 'Payment Method',

            COUNT(*) AS 'Total Transactions',

            SUM(payment_amount) AS 'Total Amount'

        FROM payment

        WHERE payment_status = 'Paid'

        GROUP BY payment_method"
    );

}

// ==========================================
// COMPLAINT REPORT
// ==========================================

elseif ($report_type == "Complaint Report") {

    $data = mysqli_query(
        $conn,
        "SELECT
            complaint.Complaint_ID AS 'Complaint ID',

            CONCAT(
                student.student_fname,
                ' ',
                student.student_lname
            ) AS 'Student Name',

            complaint.Description AS 'Description',

            complaint.Status AS 'Status',

            CONCAT(
                staff.staff_fname,
                ' ',
                staff.staff_lname
            ) AS 'Handled By'

        FROM complaint

        JOIN student
        ON complaint.Student_ID = student.student_id

        JOIN staff
        ON complaint.Staff_ID = staff.staff_id

        ORDER BY complaint.Complaint_ID ASC"
    );

}

// ==========================================
// RECEIPT REPORT
// ==========================================

elseif ($report_type == "Receipt Report") {

    $data = mysqli_query(
        $conn,
        "SELECT
            receipt.Receipt_ID AS 'Receipt ID',

            receipt.Receipt_Issue_Date AS 'Issue Date',

            CONCAT(
                student.student_fname,
                ' ',
                student.student_lname
            ) AS 'Student Name',

            payment.payment_amount AS 'Amount',

            receipt.Payment_Date AS 'Payment Date',

            receipt.Payment_Status AS 'Status'

        FROM receipt

        JOIN student
        ON receipt.Student_ID = student.student_id

        JOIN payment
        ON receipt.Payment_ID = payment.payment_id

        ORDER BY receipt.Receipt_Issue_Date DESC"
    );

}

// ==========================================
// CHECK-OUT SCHEDULE
// ==========================================

elseif ($report_type == "Check-out Schedule") {

    $data = mysqli_query(
        $conn,
        "SELECT
            CONCAT(
                student.student_fname,
                ' ',
                student.student_lname
            ) AS 'Student Name',

            student.student_phone AS 'Phone Number',

            allocation.end_date AS 'Check-out Date',

            room.room_no AS 'Room Number',

            room.room_type AS 'Room Type'

        FROM allocation

        JOIN student
        ON allocation.student_id = student.student_id

        JOIN room
        ON allocation.room_no = room.room_no

        ORDER BY allocation.end_date ASC"
    );

}

// ==========================================
// MAINTENANCE REPORT
// ==========================================

elseif ($report_type == "Maintenance Report") {

    $data = mysqli_query(
        $conn,
        "SELECT
            maintenance.Maintenance_ID AS 'Maintenance ID',

            maintenance.Maintenance_Type AS 'Maintenance Type',

            maintenance.Maintenance_Status AS 'Status',

            room.room_no AS 'Room Number',

            room.room_type AS 'Room Type',

            CONCAT(
                staff.staff_fname,
                ' ',
                staff.staff_lname
            ) AS 'Assigned Staff'

        FROM maintenance

        JOIN room
        ON maintenance.Room_no = room.room_no

        JOIN staff
        ON maintenance.Staff_ID = staff.staff_id

        ORDER BY maintenance.Maintenance_ID ASC"
    );

}

// ==========================================
// EMERGENCY ROSTER
// ==========================================

elseif ($report_type == "Emergency Roster") {

    $data = mysqli_query(
        $conn,
        "SELECT
            CONCAT(
                student.student_fname,
                ' ',
                student.student_lname
            ) AS 'Student Name',

            student.student_phone_number AS 'Phone Number',

            student.emergency_contact_name AS 'Emergency Contact',

            student.emergency_contact_number AS 'Emergency Number',

            room.room_no AS 'Room Number'

        FROM student

        JOIN allocation
        ON student.student_id = allocation.student_id

        JOIN room
        ON allocation.room_no = room.room_no

        ORDER BY room.room_no ASC"
    );

}

// ==========================================
// VISITOR REPORT
// ==========================================

elseif ($report_type == "Visitor Report") {

    $data = mysqli_query(
        $conn,
        "SELECT
            visitor.Visitor_ID AS 'Visitor ID',

            visitor.Visitor_Name AS 'Visitor Name',

            visitor.Visitor_Phone_number AS 'Phone Number',

            CONCAT(
                student.student_fname,
                ' ',
                student.student_lname
            ) AS 'Student Visited',

            visitor.Check_In_Time AS 'Check-In Time',

            visitor.Check_Out_Time AS 'Check-Out Time',

            visitor.Purpose AS 'Purpose',

            CONCAT(
                staff.staff_fname,
                ' ',
                staff.staff_lname
            ) AS 'Approved By'

        FROM visitor

        JOIN student
        ON visitor.Student_ID = student.student_id

        JOIN staff
        ON visitor.Approved_By = staff.staff_id

        ORDER BY visitor.Check_In_Time DESC"
    );

}
?>

<main class="main-content">

    <div class="page-title">

        <div>
            <h2><?php echo $report['Report_Name']; ?></h2>

            <p>
                <?php echo $report['Report_Type']; ?>
                |
                <?php echo $report['Start_Date']; ?>
                to
                <?php echo $report['End_Date']; ?>
            </p>
        </div>

        <a href="reports.php" class="add-btn">
            ← Back to Reports
        </a>

    </div>


    <div class="table-container">

        <?php if ($data && mysqli_num_rows($data) > 0) { ?>

            <table>

                <thead>
                    <tr>

                        <?php

                        $fields = mysqli_fetch_fields($data);

                        foreach ($fields as $field) {
                        ?>

                            <th>
                                <?php echo $field->name; ?>
                            </th>

                        <?php
                        }
                        ?>

                    </tr>
                </thead>


                <tbody>

                    <?php

                    while ($row = mysqli_fetch_assoc($data)) {
                    ?>

                        <tr>

                            <?php

                            foreach ($row as $value) {
                            ?>

                                <td>
                                    <?php echo $value; ?>
                                </td>

                            <?php
                            }
                            ?>

                        </tr>

                    <?php
                    }
                    ?>

                </tbody>

            </table>

        <?php } else { ?>

            <p>No report data found.</p>

        <?php } ?>

    </div>

</main>

<?php

include "../includes/footer.php";

?>