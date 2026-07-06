<?php
if (!isset($base_url)) {
    $base_url = "";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zion Hostel Management System</title>
    <link rel="stylesheet" href="<?php echo $base_url; ?>css/style.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>css/header.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>css/sidebar.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>css/dashboard.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>css/cards.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>css/form.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>css/tables.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>css/buttons.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>css/footer.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>css/settings.css">
</head>
<body>
    <header class="header">
        <div class="logo">
            <img src="<?php echo $base_url; ?>images/logo.png" alt="Hostel Logo">
        </div>
        <div class="system-name">
            <h1>Zion Hostel Management System</h1>
            <p>Comfort • Security • Excellence</p>
        </div>
        <div class="header-right">
            <h3>Administrator</h3>
            <p id="current-date">
                <?php date_default_timezone_set("Africa/Accra"); ?>
                <?php echo date("l, d F Y"); ?>
        </p>
        <h2 id="clock"></h2></div>
    </header>
    <script src="<?php echo $base_url; ?>javascript/clock.js"></script>
</body>