<?php

$base_url = "../";
include "../includes/config.php";
include "../includes/auth.php";
include "../includes/header.php";
include "../includes/sidebar.php";


// Get the current settings
$settings_result = mysqli_query(
    $conn,
    "SELECT * FROM settings WHERE setting_id = 1"
);


// Check for database error
if (!$settings_result) {

    die("Error loading settings: " . mysqli_error($conn));

}


$settings = mysqli_fetch_assoc($settings_result);


// Check if settings exist
if (!$settings) {

    die("Settings record not found.");

}

?>

<main class="main-content">

    <div class="page-title">

        <div>

            <h2>Settings</h2>

            <p>
                Manage hostel information and system preferences.
            </p>

        </div>

    </div>


    <div class="form-container">


        <?php if (isset($_GET['updated'])) { ?>

            <div class="success-message">

                Settings updated successfully.

            </div>

        <?php } ?>


        <form action="update_settings.php" method="POST">


            <input
                type="hidden"
                name="setting_id"
                value="<?php echo $settings['setting_id']; ?>"
            >


            <h3>Hostel Information</h3>


            <div class="form-grid">


                <div class="form-group">

                    <label>Hostel Name</label>

                    <input
                        type="text"
                        name="hostel_name"
                        value="<?php echo htmlspecialchars($settings['hostel_name']); ?>"
                        required
                    >

                </div>


                <div class="form-group">

                    <label>System Name</label>

                    <input
                        type="text"
                        name="system_name"
                        value="<?php echo htmlspecialchars($settings['system_name']); ?>"
                        required
                    >

                </div>


                <div class="form-group">

                    <label>Motto</label>

                    <input
                        type="text"
                        name="motto"
                        value="<?php echo htmlspecialchars($settings['motto']); ?>"
                        required
                    >

                </div>


                <div class="form-group">

                    <label>Hostel Phone Number</label>

                    <input
                        type="text"
                        name="hostel_phone"
                        value="<?php echo htmlspecialchars($settings['hostel_phone']); ?>"
                        required
                    >

                </div>


                <div class="form-group">

                    <label>Hostel Email</label>

                    <input
                        type="email"
                        name="hostel_email"
                        value="<?php echo htmlspecialchars($settings['hostel_email']); ?>"
                        required
                    >

                </div>


                <div class="form-group">

                    <label>Hostel Address</label>

                    <input
                        type="text"
                        name="hostel_address"
                        value="<?php echo htmlspecialchars($settings['hostel_address']); ?>"
                        required
                    >

                </div>


                <div class="form-group">

                    <label>Currency</label>

                    <select name="currency" required>

                        <option
                            value="GHC"
                            <?php
                            if ($settings['currency'] == 'GHC') {
                                echo 'selected';
                            }
                            ?>
                        >
                            Ghana Cedi (GHC)
                        </option>


                        <option
                            value="USD"
                            <?php
                            if ($settings['currency'] == 'USD') {
                                echo 'selected';
                            }
                            ?>
                        >
                            US Dollar (USD)
                        </option>

                    </select>

                </div>


            </div>


            <div class="form-buttons">

                <button
                    type="submit"
                    class="save-btn"
                >
                    Save Changes
                </button>

            </div>


        </form>

    </div>

</main>


<?php

include "../includes/footer.php";

?>