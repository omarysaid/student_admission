<?php
session_start();
include './connection/connection.php';

$message = ""; 

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];


    if (empty($username) || empty($password)) {
       
        $message = "Please enter both username and password.";
    } else {
     
        $username = mysqli_real_escape_string($connect, $username);

       
        $password = md5($password);

        $sql = "SELECT u.*, si.status_1, si.status_2 FROM users u 
                LEFT JOIN students_info si ON u.user_id = si.user_id 
                WHERE u.username='$username' AND u.password='$password'";
        $result = mysqli_query($connect, $sql);

        if (!$result) {
           
            $message = "Error: " . mysqli_error($connect);
        } else {
           
            if (mysqli_num_rows($result) > 0) {
             
                $row = mysqli_fetch_assoc($result);

               
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['fullname'] = $row['fullname'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['gender'] = $row['gender'];
                $_SESSION['country'] = $row['country'];
                $_SESSION['region'] = $row['region'];
                $_SESSION['district'] = $row['district'];
                $_SESSION['phone'] = $row['phone'];
                $_SESSION['department'] = $row['department'];
                $_SESSION['usertype'] = $row['usertype'];

              
                switch ($row['usertype']) {
                    case "DUP":
                        $redirectUrl = './MAIN/DUP/index.php';
                        break;
                    case "HOD":
                        // Store HOD's department as session variable
                        $_SESSION['department'] = $row['department'];
                        $redirectUrl = './MAIN/HOD/index.php';
                        break;
                    default:
                        $_SESSION['user_id'] = $row['user_id'];
                        $_SESSION['username'] = $row['username'];

                        // Calculate progress based on status_1 and status_2
                        if ($row['status_1'] == 1 && $row['status_2'] == 1) {
                            $progressValue = 100;
                        } elseif ($row['status_1'] == 1) {
                            $progressValue = 50;
                        } else {
                            $progressValue = 0;
                        }

                        // Redirect to student dashboard with progress value as URL parameter
                        $redirectUrl = "./MAIN/STUDENT/index.php?progress=$progressValue";
                }

                // Redirect immediately
                header("Location: $redirectUrl");
                exit;
            } else {
                // No user found
                $message = "Wrong username or password. Please try again.";
            }
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

    <style>
        .error-message {
            margin-top: 10px;
            color: red;
        }
    </style>

</head>

<body class="h-100" style="background-image: url(./assets/image/studnt.jpeg);">

    <div class="cantainer-fluid shadow " style="background-color:#094469">
        <div class="row">
            <div class="col-md-4">
                <img src="./assets/image/logoo.jpg" style="height:100px; margin-left:300px; border-radius:30px; ">
            </div>
            <div class="col-md-4">
                <h2 style="color:white ; margin-top:40px">STUDENTS ADMISSION SYSTEM</h2>
            </div>
            <img src="./assets/image/logo2.png" style="height:100px">
        </div>
    </div>

    <div class="authincation " style="margin-top:60px">
        <div class="container-fluid ">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-4">
                    <div class="authincation-content shadow" style="border-radius:30px">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <h4 class="text-center mb-4">Sign up to your account</h4>
                                    <form method="POST">
                                        <!-- Message div -->
                                        <?php if (!empty($message)) : ?>
                                            <div class="error-message" style="text-align:center">
                                                <?php echo $message; ?>
                                            </div>
                                        <?php endif; ?>
                                        <div class="form-group">
                                            <label style="color:black"><strong>Username</strong></label>
                                            <input type="text" name="username" class="form-control" placeholder="Enter Reg number" required="true" style="height:50px">
                                        </div>

                                        <div class="form-group">
                                            <label style="color:black"><strong>Password</strong></label>
                                            <input type="password" name="password" class="form-control" placeholder="Enter password" required="true" style="height:50px">
                                        </div>

                                        <div class="text-center mt-4">
                                            <button type="submit" name="login" class="btn btn btn-block" style="background-color:#094469">Login</button>
                                        </div>
                                    </form>
                                    <div class="new-account mt-3">
                                        <p>Don't you have an account? <a class="text-primary" href="./register.php">Sign in</a></p>
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
    <script src="./assets/vendor/global/global.min.js"></script>
    <script src="./assets/js/quixnav-init.js"></script>
    <!--endRemoveIf(production)-->
</body>

</html>
