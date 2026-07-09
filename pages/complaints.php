<?php

$base_url = "../";

include "../includes/header.php";
include "../includes/config.php";
include "../includes/sidebar.php";

?>

<main class="main-content">

    <div class="page-title">

        <div>
            <h2>Complaints</h2>
            <p>Manage hostel complaints.</p>
        </div>

        <a href="add_complaint.php" class="add-btn">
            + Add Complaint
        </a>

    </div>


    <div class="table-container">

        <table>

            <thead>

                <tr>
                    <th>Complaint ID</th>
                    <th>Student Name</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Assigned Staff</th>
                    <th>Action</th>
                </tr>

            </thead>


            <tbody>

            <?php

            $complaints = mysqli_query(
                $conn,
                "SELECT 
                    complaint.*,
                    student.student_fname,
                    student.student_lname,
                    staff.staff_fname,
                    staff.staff_lname

                FROM complaint

                JOIN student
                ON complaint.Student_ID = student.student_id

                JOIN staff
                ON complaint.Staff_ID = staff.staff_id

                ORDER BY complaint.Complaint_ID ASC"
            );


            while ($row = mysqli_fetch_assoc($complaints))
            {

            ?>

                <tr>

                    <td>
                        <?php echo $row['Complaint_ID']; ?>
                    </td>


                    <td>
                        <?php
                        echo $row['student_fname'] . " " . $row['student_lname'];
                        ?>
                    </td>


                    <td>
                        <?php echo $row['Description']; ?>
                    </td>


                    <td>
                        <?php echo $row['Status']; ?>
                    </td>


                    <td>
                        <?php
                        echo $row['staff_fname'] . " " . $row['staff_lname'];
                        ?>
                    </td>


                    <td>

                        <a href="edit_complaint.php?id=<?php echo $row['Complaint_ID']; ?>"
                           class="edit-btn">
                            Edit
                        </a>

                        <a href="delete_complaint.php?id=<?php echo $row['Complaint_ID']; ?>"
                           class="delete-btn"
                           onclick="return confirm('Are you sure you want to delete this complaint?');">
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