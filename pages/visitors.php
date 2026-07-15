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

        <h2>Visitors</h2>

        <p>Manage hostel visitors.</p>

    </div>

    <a href="add_visitor.php" class="add-btn">

        + Add Visitor

    </a>

</div>


<!-- SEARCH BAR -->

<div class="search-container">

    <i class="fa-solid fa-magnifying-glass search-icon"></i>

    <input
        type="text"
        id="search"
        placeholder="Search by Visitor, Student, Purpose..."
    >

    <button
        type="button"
        class="clear-search"
        id="clearSearch">

        <i class="fa-solid fa-xmark"></i>

    </button>

</div>


<div class="table-container">

<table>

<thead>

<tr>

    <th>Visitor ID</th>
    <th>Visitor's Name</th>
    <th>Phone Number</th>
    <th>Student Name</th>
    <th>Purpose</th>
    <th>Approved By</th>
    <th>Check-In</th>
    <th>Check-Out</th>
    <th>Action</th>

</tr>

</thead>

<tbody id="visitorTable">

</tbody>

</table>

</div>

</main>

<script src="<?php echo $base_url; ?>javaScript/visitors.js"></script>

<?php

include "../includes/footer.php";

?>