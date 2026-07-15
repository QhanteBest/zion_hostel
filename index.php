<?php

$base_url = "";
// Session should expire when the browser session ends
ini_set('session.cookie_lifetime', '0');

// ==========================================
// START SESSION
// ==========================================

session_start();


// ==========================================
// PROTECT THE DASHBOARD
// ==========================================

if (!isset($_SESSION['user_id'])) {

    header("Location: login.php");

    exit();

}


// ==========================================
// LOAD DATABASE AND PAGE FILES
// ==========================================

include "includes/config.php";
include "includes/header.php";


// ==========================================
// DASHBOARD STATISTICS
// ==========================================


// Total Students
$total_students = mysqli_num_rows(
    mysqli_query(
        $conn,
        "SELECT * FROM student"
    )
);


// Total Rooms
$total_rooms = mysqli_num_rows(
    mysqli_query(
        $conn,
        "SELECT * FROM room"
    )
);


// Vacant Rooms
$vacant_rooms = mysqli_num_rows(
    mysqli_query(
        $conn,
        "SELECT * FROM room
         WHERE status = 'Vacant'"
    )
);


// Occupied Rooms
$occupied_rooms = mysqli_num_rows(
    mysqli_query(
        $conn,
        "SELECT * FROM room
         WHERE status IN ('Occupied', 'Full')"
    )
);


// Pending Payments
$pending_payments = mysqli_num_rows(
    mysqli_query(
        $conn,
        "SELECT * FROM payment
         WHERE payment_status = 'Pending'"
    )
);


// Staff Members
$total_staff = mysqli_num_rows(
    mysqli_query(
        $conn,
        "SELECT * FROM staff"
    )
);


// Open Complaints
$open_complaints = mysqli_num_rows(
    mysqli_query(
        $conn,
        "SELECT * FROM complaint
         WHERE Status = 'Open'"
    )
);


// Total Visitors
$total_visitors = mysqli_num_rows(
    mysqli_query(
        $conn,
        "SELECT * FROM visitor"
    )
);

// ==========================================
// COMPLAINT CHART
// ==========================================

// Open Complaints
$chart_open = mysqli_num_rows(
    mysqli_query(
        $conn,
        "SELECT * FROM complaint
         WHERE Status='Open'"
    )
);

// In Progress Complaints
$chart_progress = mysqli_num_rows(
    mysqli_query(
        $conn,
        "SELECT * FROM complaint
         WHERE Status='In Progress'"
    )
);

// Resolved Complaints
$chart_resolved = mysqli_num_rows(
    mysqli_query(
        $conn,
        "SELECT * FROM complaint
         WHERE Status='Resolved'"
    )
);

// ==========================================
// MONTHLY PAYMENT BAR CHART
// ==========================================

$paymentChart = mysqli_query($conn, "

SELECT

YEAR(payment_date) AS yr,

MONTH(payment_date) AS mn,

CONCAT(
ELT(MONTH(payment_date),
'Jan','Feb','Mar','Apr','May','Jun',
'Jul','Aug','Sep','Oct','Nov','Dec'),
' ',
YEAR(payment_date)
) AS month,

SUM(payment_amount) AS total

FROM payment

GROUP BY
YEAR(payment_date),
MONTH(payment_date)

ORDER BY
YEAR(payment_date),
MONTH(payment_date)

");

$paymentMonths = [];
$paymentTotals = [];

while($row = mysqli_fetch_assoc($paymentChart)){

    $paymentMonths[] = $row['month'];

    $paymentTotals[] = $row['total'];

}

// ==========================================
// VISITORS PER MONTH CHART
// ==========================================

$visitorChart = mysqli_query($conn, "

SELECT

YEAR(Check_In_Time) AS yr,

MONTH(Check_In_Time) AS mn,

CONCAT(
ELT(MONTH(Check_In_Time),
'Jan','Feb','Mar','Apr','May','Jun',
'Jul','Aug','Sep','Oct','Nov','Dec'),
' ',
YEAR(Check_In_Time)
) AS month,

COUNT(*) AS total

FROM visitor

GROUP BY
YEAR(Check_In_Time),
MONTH(Check_In_Time)

ORDER BY
YEAR(Check_In_Time),
MONTH(Check_In_Time)

");

$visitorMonths = [];
$visitorTotals = [];

while($row = mysqli_fetch_assoc($visitorChart)){

    $visitorMonths[] = $row['month'];

    $visitorTotals[] = $row['total'];

}
// ==========================================
// LOAD SIDEBAR
// ==========================================

include "includes/sidebar.php";

?>


<main class="main-content">


    <!-- =====================================
         PAGE TITLE
    ====================================== -->

    <div class="page-title">

        <div>

            <h2>Dashboard</h2>

            <p>
                Welcome to Zion Hostel Management System
            </p>

        </div>

    </div>


    <section class="dashboard-cards">

    <!-- STUDENTS -->
    <div class="card">

        <div class="card-icon">
    <i class="fa-solid fa-user-graduate"></i></div>

        <div class="card-content">

            <h4>Total Students</h4>

            <h2><?php echo $total_students; ?></h2>

            <p>Registered Students</p>

            <a href="<?php echo $base_url; ?>pages/students.php" class="card-btn">
                View Details →
            </a>

        </div>

    </div>



    <!-- ROOMS -->

    <div class="card">

        <div class="card-icon">
    <i class="fa-solid fa-bed"></i></div>

        <div class="card-content">

            <h4>Total Rooms</h4>

            <h2><?php echo $total_rooms; ?></h2>

            <p>Hostel Rooms</p>

            <a href="<?php echo $base_url; ?>pages/rooms.php" class="card-btn">
                View Details →
            </a>

        </div>

    </div>



    <!-- VACANT -->

    <div class="card">

        <div class="card-icon">
    <i class="fa-solid fa-door-open"></i></div>

        <div class="card-content">

            <h4>Vacant Rooms</h4>

            <h2><?php echo $vacant_rooms; ?></h2>

            <p>Available Rooms</p>

            <a href="<?php echo $base_url; ?>pages/rooms.php" class="card-btn">
                View Details →
            </a>

        </div>

    </div>



    <!-- OCCUPIED -->

    <div class="card">

        <div class="card-icon">
    <i class="fa-solid fa-house-user"></i></div>

        <div class="card-content">

            <h4>Occupied Rooms</h4>

            <h2><?php echo $occupied_rooms; ?></h2>

            <p>Rooms in Use</p>

            <a href="<?php echo $base_url; ?>pages/allocation.php" class="card-btn">
                View Details →
            </a>

        </div>

    </div>



    <!-- PAYMENTS -->

    <div class="card">

        <div class="card-icon">
    <i class="fa-solid fa-wallet"></i></div>

        <div class="card-content">

            <h4>Pending Payments</h4>

            <h2><?php echo $pending_payments; ?></h2>

            <p>Awaiting Payment</p>

            <a href="<?php echo $base_url; ?>pages/payments.php" class="card-btn">
                View Details →
            </a>

        </div>

    </div>



    <!-- STAFF -->

    <div class="card">

        <div class="card-icon">
    <i class="fa-solid fa-users"></i></div>

        <div class="card-content">

            <h4>Staff Members</h4>

            <h2><?php echo $total_staff; ?></h2>

            <p>Hostel Staff</p>

            <a href="<?php echo $base_url; ?>pages/staff.php" class="card-btn">
                View Details →
            </a>

        </div>

    </div>



    <!-- COMPLAINTS -->

    <div class="card">

        <div class="card-icon">
    <i class="fa-solid fa-triangle-exclamation"></i></div>

        <div class="card-content">

            <h4>Open Complaints</h4>

            <h2><?php echo $open_complaints; ?></h2>

            <p>Pending Complaints</p>

            <a href="<?php echo $base_url; ?>pages/complaints.php" class="card-btn">
                View Details →
            </a>

        </div>

    </div>



    <!-- VISITORS -->

    <div class="card">

        <div class="card-icon">
    <i class="fa-solid fa-user-group"></i></div>

        <div class="card-content">

            <h4>Total Visitors</h4>

            <h2><?php echo $total_visitors; ?></h2>

            <p>Visitor Records</p>

            <a href="<?php echo $base_url; ?>pages/visitors.php" class="card-btn">
                View Details →
            </a>

        </div>

    </div>

</section>

 <!-- =====================================
         DASHBOARD TABLE GRID
    ====================================== -->

    <div class="dashboard-grid">


        <!-- =================================
             RECENT PAYMENTS
        ================================== -->

        <div class="dashboard-box">

            <div class="box-header">

                <h2>Recent Payments</h2>

            </div>


            <table>

                <thead>

                    <tr>

                        <th>Payment ID</th>

                        <th>Student</th>

                        <th>Amount</th>

                        <th>Status</th>

                    </tr>

                </thead>
            <tbody>

<?php

$payments = mysqli_query(
    $conn,
    "SELECT
        p.payment_id,
        p.payment_amount,
        p.payment_status,
        s.student_fname,
        s.student_lname

    FROM payment p

    JOIN student s
    ON p.student_id = s.student_id

    ORDER BY p.payment_id DESC

    LIMIT 5"
);

while($row = mysqli_fetch_assoc($payments)){

$status = strtolower(trim($row['payment_status']));

$class = "";

if($status == "paid"){

    $class = "status-paid";

}
elseif($status == "pending"){

    $class = "status-pending";

}

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

        <span class="status <?php echo $class; ?>">

            <?php echo $row['payment_status']; ?>

        </span>

    </td>

</tr>

<?php } ?>

</tbody>
            </table>

        </div>



        <!-- =================================
             RECENT COMPLAINTS
        ================================== -->

        <div class="dashboard-box">

            <div class="box-header">

                <h2>Recent Complaints</h2>

            </div>


            <table>

                <thead>

                    <tr>

                        <th>Complaint</th>

                        <th>Student</th>

                        <th>Status</th>

                    </tr>

                </thead>


                <tbody>

<?php

$complaints = mysqli_query(
    $conn,
    "SELECT

        c.Description,
        c.Status,
        s.student_fname,
        s.student_lname

    FROM complaint c

    JOIN student s
    ON c.Student_ID=s.student_id

    ORDER BY c.Complaint_ID DESC

    LIMIT 5"
);

while($row=mysqli_fetch_assoc($complaints)){

$status=strtolower(trim($row['Status']));

$class="";

if($status=="open"){

    $class="status-open";

}
elseif($status=="resolved"){

    $class="status-resolved";

}
elseif($status=="in progress"){

    $class="status-progress";

}

?>

<tr>

<td>

<?php echo $row['Description']; ?>

</td>

<td>

<?php

echo $row['student_fname']." ".$row['student_lname'];

?>

</td>

<td>

<span class="status <?php echo $class; ?>">

<?php echo $row['Status']; ?>

</span>

</td>

</tr>

<?php } ?>

</tbody>
            </table>

        </div>


    </div>



    <!-- =====================================
         RECENT VISITORS
    ====================================== -->

    <div class="dashboard-box visitor-box">

        <div class="box-header">

            <h2>Recent Visitors</h2>

        </div>


        <table>

            <thead>

                <tr>

                    <th>Visitor</th>

                    <th>Student</th>

                    <th>Purpose</th>

                    <th>Check In</th>

                </tr>

            </thead>


           <tbody>

<?php

$visitors=mysqli_query(

$conn,

"SELECT

v.Visitor_Name,

v.Purpose,

v.Check_In_Time,

s.student_fname,

s.student_lname

FROM visitor v

JOIN student s

ON v.Student_ID=s.student_id

ORDER BY v.Visitor_ID DESC

LIMIT 5"

);

while($row=mysqli_fetch_assoc($visitors)){

?>

<tr>

<td>

<?php echo $row['Visitor_Name']; ?>

</td>

<td>

<?php

echo $row['student_fname']." ".$row['student_lname'];

?>

</td>

<td>

<?php echo $row['Purpose']; ?>

</td>

<td>

<?php echo date("d M Y, h:i A",strtotime($row['Check_In_Time'])); ?>

</td>

</tr>

<?php } ?>

</tbody>

        </table>

    </div>

<!-- =====================================
     DASHBOARD CHARTS
===================================== -->

<div class="chart-grid">

    <!-- Room Occupancy -->

    <div class="chart-box">

        <div class="box-header">

            <h2>Room Occupancy</h2>

        </div>

        <canvas id="roomChart"></canvas>

    </div>


    <!-- Complaint Status -->

    <div class="chart-box">

        <div class="box-header">

            <h2>Complaint Status</h2>

        </div>

        <canvas id="complaintChart"></canvas>

    </div>

</div>
<div class="chart-box">

    <div class="box-header">

        <h2>Monthly Payments</h2>

    </div>

    <canvas id="paymentChart"></canvas>

</div>
<div class="chart-box">

    <div class="box-header">

        <h2>Visitors Per Month</h2>

    </div>

    <canvas id="visitorChart"></canvas>

</div>

<script>

const occupiedRooms = <?php echo $occupied_rooms; ?>;
const vacantRooms = <?php echo $vacant_rooms; ?>;

const openComplaints = <?php echo $chart_open; ?>;
const progressComplaints = <?php echo $chart_progress; ?>;
const resolvedComplaints = <?php echo $chart_resolved; ?>;
const paymentMonths = <?php echo json_encode(isset($paymentMonths) ? $paymentMonths : []); ?>;
const paymentTotals = <?php echo json_encode(isset($paymentTotals) ? $paymentTotals : []); ?>;
const visitorMonths = <?php echo json_encode($visitorMonths); ?>;
const visitorTotals = <?php echo json_encode($visitorTotals); ?>;

</script>


   

</main>
<?php

include "includes/footer.php";

?>