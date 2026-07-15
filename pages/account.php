<?php

$base_url = "../";

include "../includes/auth.php";
include "../includes/config.php";
include "../includes/header.php";
include "../includes/sidebar.php";


// ==========================================
// GET THE LOGGED-IN USER'S ACCOUNT
// ==========================================

$user_id = $_SESSION['user_id'];


$sql = "SELECT

            users.user_id,
            users.username,
            users.profile_image,
            users.staff_id,

            staff.staff_fname,
            staff.staff_lname,
            staff.staff_role

        FROM users

        JOIN staff
        ON users.staff_id = staff.staff_id

        WHERE users.user_id = ?";


$stmt = mysqli_prepare($conn, $sql);


mysqli_stmt_bind_param(
    $stmt,
    "i",
    $user_id
);


mysqli_stmt_execute($stmt);


$result = mysqli_stmt_get_result($stmt);


$user = mysqli_fetch_assoc($result);


// ==========================================
// IF ACCOUNT CANNOT BE FOUND
// ==========================================

if (!$user) {

    header("Location: ../logout.php");

    exit();

}

?>


<main class="main-content">


    <!-- =====================================
         PAGE TITLE
    ====================================== -->

    <div class="page-title">

        <div>

            <h2>My Account</h2>

            <p>
                Manage your account and login details.
            </p>

        </div>

    </div>



    <!-- =====================================
         SUCCESS MESSAGE
    ====================================== -->

    <?php if (isset($_GET['updated'])) { ?>

        <div class="success-message">

            Account updated successfully.

        </div>

    <?php } ?>



    <!-- =====================================
         ERROR MESSAGES
    ====================================== -->

    <?php if (isset($_GET['error'])) { ?>

        <div class="error-message">

            <?php

            if ($_GET['error'] == "password") {

                echo "Your current password is incorrect.";

            }

            elseif ($_GET['error'] == "staff") {

                echo "The Staff ID does not exist.";

            }

            elseif ($_GET['error'] == "staff_used") {

                echo "This Staff ID already belongs to another account.";

            }

            elseif ($_GET['error'] == "username") {

                echo "This username is already being used.";

            }

            elseif ($_GET['error'] == "match") {

                echo "The new passwords do not match.";

            }

            else {

                echo "Account update failed. Please try again.";

            }

            ?>

        </div>

    <?php } ?>



    <!-- =====================================
         ACCOUNT FORM
    ====================================== -->

    <div class="form-container">


        <form
    action="update_account.php"
    method="POST"
    enctype="multipart/form-data"
    autocomplete="off"
    id="accountForm"
>


            <h3>Account Information</h3>
            <?php

$image = !empty($user['profile_image'])
    ? $base_url . "uploads/" . $user['profile_image']
    : $base_url . "images/admins.png";

?>

<div class="profile-upload">

    <img
        src="<?php echo $image; ?>"
        id="profilePreview"
        class="profile-preview"
        alt="Profile Picture"
    >

    <label for="profile_image" class="upload-btn">

        <i class="fa-solid fa-plus"></i>

    </label>

    <input
        type="file"
        name="profile_image"
        id="profile_image"
        accept="image/*"
        hidden
    >

</div>


            <div class="form-grid">



                <!-- =================================
                     CURRENT STAFF NAME
                ================================== -->

                <div class="form-group">

                    <label>Current Staff Name</label>

                    <input
                        type="text"
                        value="<?php
                            echo htmlspecialchars(
                                $user['staff_fname']
                                . " "
                                . $user['staff_lname']
                            );
                        ?>"
                        readonly
                    >

                </div>



                <!-- =================================
                     CURRENT STAFF ROLE
                ================================== -->

                <div class="form-group">

                    <label>Current Staff Role</label>

                    <input
                        type="text"
                        value="<?php
                            echo htmlspecialchars(
                                $user['staff_role']
                            );
                        ?>"
                        readonly
                    >

                </div>



                <!-- =================================
                     STAFF ID
                ================================== -->

                <div class="form-group">

                    <label>Staff ID</label>

                    <input
                        type="number"
                        name="staff_id"
                        value="<?php
                            echo htmlspecialchars(
                                $user['staff_id']
                            );
                        ?>"
                        required
                    >

                </div>



                <!-- =================================
                     USERNAME
                ================================== -->

                <div class="form-group">

                    <label>Username</label>

                    <input
                        type="text"
                        name="username"
                        value="<?php
                            echo htmlspecialchars(
                                $user['username']
                            );
                        ?>"
                        autocomplete="off"
                        required
                    >

                </div>



                <!-- =================================
                     CURRENT PASSWORD
                ================================== -->

                <div class="form-group">

                    <label>Current Password</label>

                    <div class="password-box">

                        <input
                            type="password"
                            name="current_password"
                            id="current_password"
                            placeholder="Type your current password"
                            value=""
                            autocomplete="new-password"
                            required
                        >

                        <button
                            type="button"
                            class="password-toggle"
                            onclick="togglePassword(
                                'current_password',
                                this
                            )"
                        >
                            Show
                        </button>

                    </div>

                </div>



                <!-- =================================
                     NEW PASSWORD
                ================================== -->

                <div class="form-group">

                    <label>New Password</label>

                    <div class="password-box">

                        <input
                            type="password"
                            name="new_password"
                            id="new_password"
                            placeholder="Enter your new password"
                            value=""
                            autocomplete="new-password"
                        >

                        <button
                            type="button"
                            class="password-toggle"
                            onclick="togglePassword(
                                'new_password',
                                this
                            )"
                        >
                            Show
                        </button>

                    </div>

                </div>



                <!-- =================================
                     CONFIRM NEW PASSWORD
                ================================== -->

                <div class="form-group">

                    <label>Confirm New Password</label>

                    <div class="password-box">

                        <input
                            type="password"
                            name="confirm_password"
                            id="confirm_password"
                            placeholder="Confirm your new password"
                            value=""
                            autocomplete="new-password"
                        >

                        <button
                            type="button"
                            class="password-toggle"
                            onclick="togglePassword(
                                'confirm_password',
                                this
                            )"
                        >
                            Show
                        </button>

                    </div>

                </div>


            </div>



            <!-- =====================================
                 UPDATE BUTTON
            ====================================== -->

            <div class="form-buttons">

                <button
                    type="submit"
                    class="save-btn"
                >
                    Update Account
                </button>

            </div>


        </form>

    </div>


</main>



<script>


// ==========================================
// SHOW OR HIDE PASSWORD
// ==========================================

function togglePassword(inputId, button) {

    const passwordInput =
        document.getElementById(inputId);


    if (passwordInput.type === "password") {

        passwordInput.type = "text";

        button.textContent = "Hide";

    } else {

        passwordInput.type = "password";

        button.textContent = "Show";

    }

}



// ==========================================
// CLEAR ALL PASSWORD FIELDS
// WHEN THE PAGE OPENS
// ==========================================

function clearPasswordFields() {

    const currentPassword =
        document.getElementById("current_password");

    const newPassword =
        document.getElementById("new_password");

    const confirmPassword =
        document.getElementById("confirm_password");


    currentPassword.value = "";

    newPassword.value = "";

    confirmPassword.value = "";

}



// Clear when the page first loads
window.addEventListener(
    "DOMContentLoaded",
    clearPasswordFields
);


// Clear again if browser restores the page
window.addEventListener(
    "pageshow",
    clearPasswordFields
);


</script>

<script>

// ==========================================
// PROFILE IMAGE PREVIEW
// ==========================================

const profileImage =
document.getElementById("profile_image");

if(profileImage){

profileImage.addEventListener("change", function(){

    const file = this.files[0];

    if(file){

        const reader = new FileReader();

        reader.onload = function(e){

            document.getElementById("profilePreview").src = e.target.result;

        };

        reader.readAsDataURL(file);

    }

});

}

</script>

<?php

include "../includes/footer.php";

?>