<?php
session_start();
include './connection/connection.php';



// Initialize variable to hold role addition status
$userAddStatus = "";

if (isset($_POST["add_user"])) {
    $fullname = $_POST['fullname'];
       $username = $_POST['username'];
        $gender = $_POST['gender'];
        $country = $_POST['country'];
    $region = $_POST['region'];
       $district = $_POST['district'];
    $phone = $_POST['phone'];
    $password = md5($_POST['password']); // Using MD5 for password hashing
 $usertype = $_POST['usertype'];

    // If there are no errors in file upload, proceed with insertion
    if (empty($errors)) {
        $insert_new_user = "INSERT INTO users (fullname,username,gender,country,region, district,phone, password, usertype) 
                            VALUES ('$fullname','$username', '$gender', '$country','$region',   '$district', '$phone','$password' ,'$usertype')";

        if (mysqli_query($connect, $insert_new_user)) {
            // Set role addition status
            $userAddStatus = "User Registered successfully";
        } else {
            // Set role addition status
            $userAddStatus = "Error occurred while adding user";
        }
    }
}
?>





<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Focus - Bootstrap Admin Dashboard </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <link href="./assets/css/style.css" rel="stylesheet">

</head>


<body class="h-100" style="background-image: url(./assets/image/studnt.jpeg)">

<div class="cantainer-fluid shadow " style="background-color:#094469">
    <div class="row">
        <div class="col-md-4">
            <img src="./assets/image/logoo.jpg" style="height:100px; margin-left:300px; border-radius:30px">
        </div>
        <div class="col-md-4"><h2 style="color:white ; margin-top:40px">STUDENTS ADMISSION SYSTEM</h2></div>
        <img src="./assets/image/logo2.png" style="height:100px">
    </div>
</div>

    <div class="authincation " style="margin-top:10px">
        <div class="container-fluid ">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-5">
                    <div class="authincation-content shadow" style="border-radius:30px">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <h4 class="text-center mb-4">Sign up your account</h4>
                                    <form method="POST" >
 <div class="alert <?php echo !empty($userAddStatus) && strpos($userAddStatus, 'successfully') !== false ? 'alert-primary' : ''; ?>" id="successMessage" style="color:white" >
            <?php echo $userAddStatus; ?>
        </div>
                                    <div class="row">
                                        <div class="col-md-6"> <div class="form-group">
                                            <label style="color:black"><strong>Fullname</strong></label>
                                            <input type="text" name="fullname"  class="form-control" placeholder="Enter username" required="true" >
                                        </div></div>
                                         <div class="col-md-6">    <div class="form-group">
                                            <label style="color:black"><strong>Username</strong></label>
                                            <input type="text" name="username"   class="form-control" placeholder="Enter reg number"  required="true">
                                        </div></div>
                                    </div>
                                       
                                      
                                         <div class="form-group">
    <label style="color:black"><strong>Gender</strong></label>
    <div style="display: flex; gap: 15px;">
        <div>
            <input type="radio" id="male" name="gender" value="Male" required>
            <label for="male">Male</label>
        </div>
        <div>
            <input type="radio" id="female" name="gender" value="Female" required>
            <label for="female">Female</label>
        </div>
        <div>
            <input type="radio" id="others" name="gender" value="Others" required>
            <label for="others">Others</label>
        </div>
    </div>
</div>


                                          <div class="row">
                                        <div class="col-md-6"> <div class="form-group">
                                            <label style="color:black"><strong>Country</strong></label>
                                            <input type="text" name="country"  class="form-control" placeholder="Enter your Country"  required="true">
                                        </div></div>
                                         <div class="col-md-6">    <div class="form-group">
                                            <label style="color:black"><strong>Region</strong></label>
                                            <input type="text" name="region"  class="form-control" placeholder="Enter Region"  required="true">
                                        </div></div>
                                    </div>

  <div class="row">
                                        <div class="col-md-6"> <div class="form-group">
                                            <label style="color:black"><strong>District</strong></label>
                                            <input type="text" name="district"  class="form-control" placeholder="Enter Region"  required="true">
                                        </div></div>
                                         <div class="col-md-6">    <div class="form-group">
                                            <label style="color:black"><strong>Phone</strong></label>
                                            <input type="number" name="phone"  class="form-control" placeholder="Enter Phone"  required="true">
                                        </div></div>
                                    </div>


                                        <div class="form-group">
                                            <label style="color:black"><strong>Password</strong></label>
                                            <input type="password"  name="password"  class="form-control" placeholder="Enter password" required="true">
                                        </div>
                                          <div class="form-group">
                                            <input type="hidden"  name="usertype"  class="form-control" value="STUDENT" required="true">
                                        </div>

                                        <div class="text-center mt-4">
                                            <button type="submit" name="add_user"  class="btn btn btn-block" style="background-color:#094469">Register</button>
                                        </div>
                                    </form>
                                    <div class="new-account mt-3">
                                        <p>Already have an account? <a class="text-primary" href="./index.php">Sign Up</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src=".assets/vendor/global/global.min.js"></script>
    <script src=".assets/js/quixnav-init.js"></script>
    <!--endRemoveIf(production)-->
</body>

</html>