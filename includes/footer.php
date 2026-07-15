<footer class="footer">

    <p>
        &copy; <?php echo date("Y"); ?>
        Zion Hostel Management System |
        Developed by Mustapha Gyasi |
        All Rights Reserved.
    </p>

</footer>

<!-- Chart.js Library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Clock -->
<script src="<?php echo $base_url; ?>javascript/clock.js"></script>

<?php if (basename($_SERVER['PHP_SELF']) == "index.php") { ?>

<script src="<?php echo $base_url; ?>javascript/dashboard.js"></script>

<?php } ?>