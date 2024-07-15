<?php
include("../../connection/connection.php");
$info_id = $_REQUEST['info_id'];
$query = "DELETE FROM students_info  WHERE info_id=$info_id";
$result = mysqli_query($connect, $query) or die(mysqli_error($connect));

// Check if deletion was successful
if ($result) {
    // Redirect to view.php with success message
    header("Location: ./dup_view.php?success=1");
} else {
    // Redirect to view.php with failure message
    header("Location: ./dup_view.php?success=0");
}
exit();