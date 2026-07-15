<?php

$base_url = "../";

include "../includes/auth.php";
include "../includes/config.php";
include "../includes/header.php";
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


    <!-- SEARCH BAR -->

<div class="search-container">

    <i class="fa-solid fa-magnifying-glass search-icon"></i>

    <input
        type="text"
        id="search"
        placeholder="Search by Student ID, Name or Phone..."
    >

    <button
        type="button"
        class="clear-search"
        id="clearSearch">

        <i class="fa-solid fa-xmark"></i>

    </button>

</div>

    <!-- ===============================
         STUDENTS TABLE
    ================================ -->

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

            <tbody id="studentTable">

                <!-- Records will load here -->

            </tbody>

        </table>

    </div>

</main>


<script src="<?php echo $base_url; ?>javascript/students.js"></script>

<?php

include "../includes/footer.php";

?>