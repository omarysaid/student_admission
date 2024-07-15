<?php
session_start();
include '../../connection/connection.php';
include '../include/header.php';
include '../include/sidebar.php';

// Initialize variable to hold update status
$updateStatus = "";

// Fetch fullname from users table based on user_id
$fullname = "";
if (isset($_GET['user_id'])) {
    $user_id = intval($_GET['user_id']);
    $query = "SELECT fullname FROM users WHERE user_id = $user_id";
    $result = mysqli_query($connect, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $fullname = $user['fullname'];
    } else {
        $fullname = "User not found";
    }
}

// Handle form submission to update status_1
if (isset($_POST["update"])) {
    $status_2 = $_POST['status_2'];
  
    // Sanitize inputs
    $status_2 = mysqli_real_escape_string($connect, $status_2);

    // Prepare SQL query to update status_1 in students_info table
    $update_query = "UPDATE students_info SET status_2 = '$status_2' WHERE user_id = $user_id";

    if (mysqli_query($connect, $update_query)) {
        // Set update status
        $updateStatus = "Student successfully approved";
    } else {
        // Set update status
        $updateStatus = "Error occurred while updating status: " . mysqli_error($connect);
    }
}
?> 
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0" style="background-color: #094469">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4 style="color:white">Students Approvals Form</h4>
                </div>
            </div>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-xl-12 col-xxl-12">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="alert <?php echo !empty($updateStatus) && strpos($updateStatus, 'successfully') !== false ? 'alert-success' : ''; ?> " id="successMessage" style="color: black; width:650px; margin-left:200px">
                            <?php echo $updateStatus; ?>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                        <form name="userForm" method="POST" onsubmit="return validateForm()">
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <div>
                                            <label class="col-form-label" style="color:black">Fullname</label>
                                            <input type="text" value="<?php echo htmlspecialchars($fullname); ?>" readonly class="form-control" placeholder="Fullname" style="height:50px">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div>
                                            <label class="col-form-label" style="color:black">Status</label>
                                            <select name="status_2" class="form-control" style="height:50px">
                                               <option value="" disabled selected>Select approvals</option>
                                                <option value="1">Approved</option>
                                                <option value="0">Not Approved</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <button type="submit" name="update" class="btn btn" style="background-color:#094469">SUBMIT</button>
                                    </div>
                                </div>
                            </form>
                            <script src="path/to/your/validation.js"></script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function validateForm() {
    const status = document.forms["userForm"]["status_2"].value;

    if (status === "") {
        alert("Please select approval status");
        return false;
    }

    return true;
}
</script>


<?php include '../include/footer.php'; ?>
