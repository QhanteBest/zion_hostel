<?php
$base_url = "../";
include "../includes/header.php";
include "../includes/config.php";
include "../includes/sidebar.php";
?>
<main class="main-content">
    <div class="page-title">
        <div>
            <h2>Students</h2>
            <p>Manage all hostel students.</p>
        </div>
        <a href="add_student.php" class="add-btn">
            + Add Student
        </a>
    </div>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Full Name</th>
                    <th>Phone Number</th>
                    <th>Emergency Contact</th>
                    <th>Emergency Number</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $students = mysqli_query($conn, "SELECT * FROM student ORDER BY student_id ASC");
            while($row = mysqli_fetch_assoc($students))
            {
            ?>
                <tr>
                    <td><?php echo $row['student_id']; ?></td>
                    <td>
                        <?php
                        echo $row['student_fname'] . " " . $row['student_lname'];
                        ?>
                    </td>
                    <td><?php echo $row['student_phone_number']; ?></td>
                    <td><?php echo $row['emergency_contact_name']; ?></td>
                    <td><?php echo $row['emergency_contact_number']; ?></td>
                    <td>
                        <a href="edit_student.php?id=<?php echo $row['student_id']; ?>" class="edit-btn">
                            Edit
                        </a>
                        <a href="delete_student.php?id=<?php echo $row['student_id']; ?>"
                        class="delete-btn"
                        onclick="return confirm('Are you sure you want to delete this student?');">Delete</a>
                        
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