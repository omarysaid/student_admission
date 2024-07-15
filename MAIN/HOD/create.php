<?php
session_start();
include '../../connection/connection.php';
include '../include/header.php';
include '../include/sidebar.php';

// Initialize variable to hold role addition status
$userAddStatus = "";

if (isset($_POST["add"])) {
    $fullname = trim($_POST['fullname']);
    $username = trim($_POST['username']);
    $gender = trim($_POST['gender']);
    $country = trim($_POST['country']);
    $region = trim($_POST['region']);
    $district = trim($_POST['district']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $department = trim($_POST['department']);
    $password = trim($_POST['password']);
    $usertype = $_POST['usertype'];

    // Validation
    $errors = [];

    if (empty($fullname) || empty($username) || empty($gender) || empty($country) || empty($region) || empty($district) || empty($phone) || empty($email) || empty($department) || empty($password)) {
        $errors[] = "All fields are required.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters long.";
    }

    if (empty($errors)) {
        // Sanitize inputs
        $fullname = mysqli_real_escape_string($connect, $fullname);
        $username = mysqli_real_escape_string($connect, $username);
        $gender = mysqli_real_escape_string($connect, $gender);
        $country = mysqli_real_escape_string($connect, $country);
        $region = mysqli_real_escape_string($connect, $region);
        $district = mysqli_real_escape_string($connect, $district);
        $phone = mysqli_real_escape_string($connect, $phone);
        $email = mysqli_real_escape_string($connect, $email);
        $department = mysqli_real_escape_string($connect, $department);
        $password = mysqli_real_escape_string($connect, md5($password));
        $usertype = mysqli_real_escape_string($connect, $usertype);

        // Prepare SQL query
        $insert_new_user = "INSERT INTO users (fullname, username, gender, country, region, district, phone, email, department, password, usertype) 
                            VALUES ('$fullname', '$username', '$gender', '$country', '$region', '$district', '$phone', '$email', '$department', '$password', '$usertype')";

        if (mysqli_query($connect, $insert_new_user)) {
            // Set role addition status
            $userAddStatus = "H.O.D Registered successfully";
        } else {
            // Set role addition status
            $userAddStatus = "Error occurred while adding user: " . mysqli_error($connect);
        }
    } else {
        $userAddStatus = implode("<br>", $errors);
    }
}
?> 
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0" style="background-color:  #094469;">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4 style="color:white">H.O.Ds Registration Form</h4>
                </div>
            </div>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-xl-12 col-xxl-12">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="alert <?php echo !empty($userAddStatus) && strpos($userAddStatus, 'successfully') !== false ? 'alert-success' : ''; ?>" id="successMessage" style="color: black;width:650px; margin-left:200px" >
                            <?php echo $userAddStatus; ?>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form name="userForm" method="POST" >

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <div>
                                            <label class="col-form-label" style="color:black">Fullname</label>
                                            <input type="text" name="fullname" class="form-control" placeholder="Enter Fullname" style="height:50px" required="true">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div>
                                            <label class="col-form-label" style="color:black">Username</label>
                                            <input type="text" name="username" class="form-control" placeholder="Enter Username" style="height:50px" required="true">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <div>
                                            <label class="col-form-label" style="color:black">Gender</label>
                                            <div>
                                                <label><input type="radio" name="gender" value="Male"> Male</label>
                                                <label><input type="radio" name="gender" value="Female"> Female</label>
                                                <label><input type="radio" name="gender" value="Other"> Other</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div>
                                            <label class="col-form-label" style="color:black">Country</label>
                                            <input type="text" name="country" class="form-control" placeholder="Enter Country" style="height:50px" required="true">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <div>
                                            <label class="col-form-label" style="color:black">Region</label>
                                            <input type="text" name="region" class="form-control" placeholder="Enter Region" style="height:50px" required="true">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div>
                                            <label class="col-form-label" style="color:black">District</label>
                                            <input type="text" name="district" class="form-control" placeholder="Enter District" style="height:50px" required="true">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <div>
                                            <label class="col-form-label" style="color:black">Phone</label>
                                            <input type="number" name="phone" class="form-control" placeholder="Enter Phone" style="height:50px" required="true">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div>
                                            <label class="col-form-label" style="color:black">Email</label>
                                            <input type="email" name="email" class="form-control" placeholder="Enter Email" style="height:50px" required="true">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <div>
                                            <label class="col-form-label" style="color:black">Department</label>
                                            <select name="department" class="form-control" style="height:50px">
                                                <option value="" disabled selected>Select Department</option>
                                                <option value="Building Economics">Building Economics</option>
                                                <option value="Architecture">Architecture</option>
                                                <option value="Interior Design">Interior Design</option>
                                                <option value="Geospatial Sciences and Technology">Geospatial Sciences and Technology</option>
                                                <option value="Computer Systems and Mathematics">Computer Systems and Mathematics</option>
                                                <option value="Business Studies">Business Studies</option>
                                                <option value="Land Management and Valuation">Land Management and Valuation</option>
                                                <option value="Civil and Environmental Engineering">Civil and Environmental Engineering</option>
                                                <option value="Environmental Science and Management">Environmental Science and Management</option>
                                                <option value="Urban and Regional Planning">Urban and Regional Planning</option>
                                                <option value="Economics and Social Studies">Economics and Social Studies</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div>
                                            <label class="col-form-label" style="color:black">Password</label>
                                            <input type="password" name="password" class="form-control" placeholder="Password" style="height:50px">
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="usertype" class="form-control" value="HOD" style="height:50px">

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <button type="submit" name="add" class="btn btn" style="background-color:#094469">SUBMIT</button>
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
<?php include '../include/footer.php'; ?>

<script>
function validateForm() {
    const fullname = document.forms["userForm"]["fullname"].value;
    const username = document.forms["userForm"]["username"].value;
    const gender = document.forms["userForm"]["gender"].value;
    const country = document.forms["userForm"]["country"].value;
    const region = document.forms["userForm"]["region"].value;
    const district = document.forms["userForm"]["district"].value;
    const phone = document.forms["userForm"]["phone"].value;
    const email = document.forms["userForm"]["email"].value;
    const department = document.forms["userForm"]["department"].value;
    const password = document.forms["userForm"]["password"].value;

    if (fullname === "" || username === "" || gender === "" || country === "" || region === "" || district === "" || phone === "" || email === "" || department === "" || password === "") {
        alert("All fields must be filled out");
        return false;
    }

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        alert("Invalid email format");
        return false;
    }

    if (password.length < 6) {
        alert("Password must be at least 6 characters long");
        return false;
    }

    return true;
}
</script>


