<?php
session_start();
include '../../connection/connection.php';
include '../include/header.php';
include '../include/sidebar.php';


$userAddStatus = "";

if (isset($_POST["add"])) {
      $user_id = $_GET['user_id'];
       $fullname = $_POST['fullname'];
    $username = ($_POST['username']);
    $gender = ($_POST['gender']);
    $country = ($_POST['country']);
    $region = ($_POST['region']);
    $district = ($_POST['district']);
    $phone = ($_POST['phone']);
    $email = ($_POST['email']);
    $department = ($_POST['department']);
    $password = ($_POST['password']);

    $errors = array(); 

    if (empty($errors)) {
        $update = "UPDATE users SET fullname='$fullname', username='$username', gender='$gender', country='$country',
         region='$region', district='$district', phone='$phone', email='$email' , department='$department', password='$password'
        WHERE user_id = '$user_id'";

        if (mysqli_query($connect, $update)) {
           
            $userAddStatus = "H.O.D  updated successfully";
        } else {
           
            $userAddStatus = "Error occurred while updating ";
        }
    } else {
     
        foreach ($errors as $error) {
            echo "<div class='alert alert-danger'>$error</div>";
        }
    }
}

?> 
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0" style="background-color:  #094469;">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4 style="color:white">H.O.Ds Updation Form</h4>
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
   <?php
                                        $select_user = "SELECT * FROM users WHERE user_id = '" . $_GET['user_id'] . "'";
                                        $result = mysqli_query($connect, $select_user);
                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                        ?>


                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <div>
                                            <label class="col-form-label" style="color:black">Fullname</label>
                                            <input type="text" name="fullname" class="form-control"  value="<?php echo $row['fullname'] ?>" style="height:50px" required="true">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div>
                                            <label class="col-form-label" style="color:black">Username</label>
                                            <input type="text" name="username" class="form-control"  value="<?php echo $row['username'] ?>"style="height:50px" required="true">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                 <div class="col-md-6">
    <div>
        <label class="col-form-label" style="color:black">Gender</label>
        <div>
            <label>
                <input type="radio" name="gender" value="Male" <?php if ($row['gender'] == 'Male') echo 'checked'; ?>> Male
            </label>
            <label>
                <input type="radio" name="gender" value="Female" <?php if ($row['gender'] == 'Female') echo 'checked'; ?>> Female
            </label>
            <label>
                <input type="radio" name="gender" value="Other" <?php if ($row['gender'] == 'Other') echo 'checked'; ?>> Other
            </label>
        </div>
    </div>
</div>

                                    <div class="col-md-6">
                                        <div>
                                            <label class="col-form-label" style="color:black">Country</label>
                                            <input type="text" name="country" class="form-control" value="<?php echo $row['country'] ?>" style="height:50px" required="true">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <div>
                                            <label class="col-form-label" style="color:black">Region</label>
                                            <input type="text" name="region" class="form-control"  value="<?php echo $row['region'] ?>" style="height:50px" required="true">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div>
                                            <label class="col-form-label" style="color:black">District</label>
                                            <input type="text" name="district" class="form-control"  value="<?php echo $row['district'] ?>" style="height:50px" required="true">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <div>
                                            <label class="col-form-label" style="color:black">Phone</label>
                                            <input type="number" name="phone" class="form-control"  value="<?php echo $row['phone'] ?>" style="height:50px" required="true">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div>
                                            <label class="col-form-label" style="color:black">Email</label>
                                            <input type="email" name="email" class="form-control"  value="<?php echo $row['email'] ?>" style="height:50px" required="true">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                 <div class="col-md-6">
    <div>
        <label class="col-form-label" style="color:black">Department</label>
        <select name="department" class="form-control" style="height:50px">
            <option value="" disabled>Select Department</option>
            <option value="Building Economics" <?php if ($row['region'] == 'Building Economics') echo 'selected'; ?>>Building Economics</option>
            <option value="Architecture" <?php if ($row['region'] == 'Architecture') echo 'selected'; ?>>Architecture</option>
            <option value="Interior Design" <?php if ($row['region'] == 'Interior Design') echo 'selected'; ?>>Interior Design</option>
            <option value="Geospatial Sciences and Technology" <?php if ($row['region'] == 'Geospatial Sciences and Technology') echo 'selected'; ?>>Geospatial Sciences and Technology</option>
            <option value="Computer Systems and Mathematics" <?php if ($row['region'] == 'Computer Systems and Mathematics') echo 'selected'; ?>>Computer Systems and Mathematics</option>
            <option value="Business Studies" <?php if ($row['region'] == 'Business Studies') echo 'selected'; ?>>Business Studies</option>
            <option value="Land Management and Valuation" <?php if ($row['region'] == 'Land Management and Valuation') echo 'selected'; ?>>Land Management and Valuation</option>
            <option value="Civil and Environmental Engineering" <?php if ($row['region'] == 'Civil and Environmental Engineering') echo 'selected'; ?>>Civil and Environmental Engineering</option>
            <option value="Environmental Science and Management" <?php if ($row['region'] == 'Environmental Science and Management') echo 'selected'; ?>>Environmental Science and Management</option>
            <option value="Urban and Regional Planning" <?php if ($row['region'] == 'Urban and Regional Planning') echo 'selected'; ?>>Urban and Regional Planning</option>
            <option value="Economics and Social Studies" <?php if ($row['region'] == 'Economics and Social Studies') echo 'selected'; ?>>Economics and Social Studies</option>
        </select>
    </div>
</div>

                                    <div class="col-md-6">
                                        <div>
                                            <label class="col-form-label" style="color:black">Password</label>
                                            <input type="password" name="password" class="form-control" value="<?php echo $row['password'] ?>" style="height:50px">
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="usertype" class="form-control" value="HOD" style="height:50px">

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <button type="submit" name="add" class="btn btn" style="background-color:#094469">SUBMIT</button>
                                    </div>
                                </div>
                                    <?php
                                            }
                                        }
                                        ?>
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


