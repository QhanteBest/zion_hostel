<?php
$base_url = "";
include "includes/header.php";
include "includes/config.php";
/* Dashboard Statistics */

// Total Students
$total_students = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM student"));

// Total Rooms
$total_rooms = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM room"));

// Vacant Rooms
$vacant_rooms = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM room WHERE status='Vacant'"));

// Occupied Rooms
$occupied_rooms = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM room WHERE status IN('Occupied','Full')"));

// Pending Payments
$pending_payments = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM payment WHERE payment_status='Pending'"));

// Staff Members
$total_staff = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM staff"));

// Open Complaints
$open_complaints = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM complaint WHERE Status='Open'"));

// Total Visitors
$total_visitors = mysqli_num_rows(
    mysqli_query($conn, "SELECT * FROM visitor")
);
?>
<?php
include "includes/sidebar.php";
?>
<main class="main-content">

    <div class="page-title">
        <h2>Dashboard</h2>
        <p>Welcome to Zion Hostel Management System</p>
    </div>

    <section class="dashboard-cards">

        <div class="card">
            <img src="<?php echo $base_url; ?>images/total students.jpg" alt="Students">
            <div>
                <h3>Total Students</h3>
                <h2><?php echo $total_students; ?></h2>
            </div>
        </div>

        <div class="card">
            <img src="<?php echo $base_url; ?>images/total rooms.png" alt="Rooms">
            <div>
                <h3>Total Rooms</h3>
                <h2><?php echo $total_rooms; ?></h2>
            </div>
        </div>

        <div class="card">
            <img src="<?php echo $base_url; ?>images/vacant.jpeg" alt="Vacant Rooms">
            <div>
                <h3>Vacant Rooms</h3>
                <h2><?php echo $vacant_rooms; ?></h2>
            </div>
        </div>

        <div class="card">
            <img src="<?php echo $base_url; ?>images/occupied.jpg" alt="Occupied Rooms">
            <div>
                <h3>Occupied Rooms</h3>
                <h2><?php echo $occupied_rooms; ?></h2>
            </div>
        </div>

        <div class="card">
            <img src="<?php echo $base_url; ?>images/payment pending.png" alt="Payments">
            <div>
                <h3>Pending Payments</h3>
                <h2><?php echo $pending_payments; ?></h2>
            </div>
        </div>

        <div class="card">
            <img src="<?php echo $base_url; ?>images/total staff.jpg" alt="Staff">
            <div>
                <h3>Staff Members</h3>
                <h2><?php echo $total_staff; ?></h2>
            </div>
        </div>

        <div class="card">
            <img src="<?php echo $base_url; ?>images/total complaint.jpeg" alt="Complaints">
            <div>
                <h3>Open Complaints</h3>
                <h2><?php echo $open_complaints; ?></h2>
            </div>
        </div>

        <div class="card">
    <img src="<?php echo $base_url; ?>images/total visitors.webp" alt="Visitors">
    <div>
        <h3>Total Visitors</h3>
        <h2><?php echo $total_visitors; ?></h2>
    </div>
</div>
    </section>
    <div class="dashboard-grid">
    <!-- Recent Payments -->
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
    "SELECT p.payment_id, p.payment_amount, p.payment_status,
            s.student_fname, s.student_lname
     FROM payment p
     JOIN student s ON p.student_id = s.student_id
     ORDER BY p.payment_id DESC
     LIMIT 5"
);

while ($row = mysqli_fetch_assoc($payments)) {
?>
<tr>
    <td><?php echo $row['payment_id']; ?></td>
    <td><?php echo $row['student_fname'] . " " . $row['student_lname']; ?></td>
    <td>GH₵ <?php echo $row['payment_amount']; ?></td>
    <td><?php echo $row['payment_status']; ?></td>
</tr>
<?php } ?>
            </tbody>
        </table>
    </div>
    <!-- Recent Complaints -->
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
    "SELECT c.Description, c.Status,
            s.student_fname, s.student_lname
     FROM complaint c
     JOIN student s ON c.Student_ID = s.student_id
     ORDER BY c.Complaint_ID DESC
     LIMIT 5"
);

while ($row = mysqli_fetch_assoc($complaints)) {
?>
<tr>
    <td><?php echo $row['Description']; ?></td>
    <td><?php echo $row['student_fname'] . " " . $row['student_lname']; ?></td>
    <td><?php echo $row['Status']; ?></td>
</tr>
<?php } ?>
            </tbody>
        </table>
    </div>
</div>
<!-- Recent Visitors -->
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
$visitors = mysqli_query(
    $conn,
    "SELECT v.Visitor_Name, v.Purpose, v.Check_In_Time,
            s.student_fname, s.student_lname
     FROM visitor v
     JOIN student s ON v.Student_ID = s.student_id
     ORDER BY v.Visitor_ID DESC
     LIMIT 5"
);

while ($row = mysqli_fetch_assoc($visitors)) {
?>
<tr>
    <td><?php echo $row['Visitor_Name']; ?></td>
    <td><?php echo $row['student_fname'] . " " . $row['student_lname']; ?></td>
    <td><?php echo $row['Purpose']; ?></td>
    <td><?php echo $row['Check_In_Time']; ?></td>
</tr>
<?php } ?>
        </tbody>
    </table>
</div>
</main>

<?php
include "includes/footer.php";
?>