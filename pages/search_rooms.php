<?php

include "../includes/auth.php";
include "../includes/config.php";

$search = "";

if(isset($_POST['search'])){

    $search = mysqli_real_escape_string(
        $conn,
        trim($_POST['search'])
    );

}

$sql = "SELECT *
        FROM room
        WHERE room_no LIKE '%$search%'
        OR room_type LIKE '%$search%'
        OR capacity LIKE '%$search%'
        OR current_occupancy LIKE '%$search%'
        OR status LIKE '%$search%'
        ORDER BY room_no ASC";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0){

    while($row = mysqli_fetch_assoc($result)){

?>

<tr>

    <td><?php echo $row['room_no']; ?></td>

    <td><?php echo $row['room_type']; ?></td>

    <td><?php echo $row['capacity']; ?></td>

    <td><?php echo $row['current_occupancy']; ?></td>

    <td><?php echo $row['status']; ?></td>

    <td>

        <a href="edit_room.php?id=<?php echo $row['room_no']; ?>" class="edit-btn">

            Edit

        </a>

        <a href="delete_room.php?id=<?php echo $row['room_no']; ?>"
           class="delete-btn"
           onclick="return confirm('Delete this room?');">

            Delete

        </a>

    </td>

</tr>

<?php

    }

}else{

?>

<tr>

    <td colspan="6" style="text-align:center;padding:2rem;">

        No room found.

    </td>

</tr>

<?php

}

?>