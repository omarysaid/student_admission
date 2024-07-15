<?php
session_start();
include '../../connection/connection.php';
include '../include/header.php';
include '../include/sidebar.php';
?>

<!--**********************************
    Content body start
***********************************-->
<div class="content-body shadow">
    <div class="container-fluid shadow">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                  <h4 style="color:#094469"> <?php echo isset($_SESSION['department']) ? $_SESSION['department'] : ''; ?>(DUP)</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="card shadow" style="height:150px">
                    <div class="stat-widget-one card-body" style="background-color:aliceblue">
                        <div class="stat-icon d-inline-block">
                            <i class="ti-user " style="border-color:#094469; color:#094469"></i>
                        </div>
                        <div class="stat-content d-inline-block">
 <?php
                                    $sql = "SELECT COUNT(*) AS total_users FROM users WHERE usertype = 'HOD'";
                                    $result = $connect->query($sql);
                                    $total_users = 0;
                                    if ($result->num_rows > 0) {
                                        $row = $result->fetch_assoc();
                                        $total_users = $row["total_users"];
                                    }
                                    // Do not close the connection here
                                    ?>
                            <div class="stat-text">HODS</div>
                            <div class="stat-digit">   0<?php echo $total_users; ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card shadow" style="height:150px">
                    <div class="stat-widget-one card-body" style="background-color:aliceblue">
                        <div class="stat-icon d-inline-block">
                            <i class="ti-user " style="border-color:#094469; color:#094469"></i>
                        </div>
                        <div class="stat-content d-inline-block">
                                  <?php
                                    $sql = "SELECT COUNT(*) AS total_users FROM users WHERE usertype ='STUDENT'";
                                    $result = $connect->query($sql);
                                    $total_users = 0;
                                    if ($result->num_rows > 0) {
                                        $row = $result->fetch_assoc();
                                        $total_users = $row["total_users"];
                                    }
                                    // Do not close the connection here
                                    ?>


                            <div class="stat-text">STUDENTS</div>
                            <div class="stat-digit">0<?php echo $total_users; ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card shadow" style="height:150px">
                      <div class="stat-widget-one card-body" style="background-color:aliceblue">
                        <div class="stat-icon d-inline-block">
                          <i class="ti-user " style="border-color:#094469; color:#094469"></i>
                        </div>
                       <div class="stat-content d-inline-block">
    <?php
    $sql = "SELECT COUNT(*) AS total_approved FROM users 
            INNER JOIN students_info ON users.user_id = students_info.user_id 
            WHERE users.usertype ='STUDENT' AND students_info.status_2 = 1";
    $result = $connect->query($sql);
    $total_approved = 0;
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $total_approved = $row["total_approved"];
    }
    ?>
    <div class="stat-text">APPROVALS</div>
    <div class="stat-digit">0<?php echo $total_approved; ?></div>
</div>

                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card shadow" style="height:150px; background-color:aliceblue">
                      <div class="stat-widget-one card-body" style="background-color:aliceblue">
                        <div class="stat-icon d-inline-block">
                            <i class="ti-user " style="border-color:#094469; color:#094469"></i>
                        </div>
 <?php
    $sql = "SELECT COUNT(*) AS total_approved FROM users 
            INNER JOIN students_info ON users.user_id = students_info.user_id 
            WHERE users.usertype ='STUDENT' AND students_info.status_2 = 0 AND students_info.status_1 = 1 ";
    $result = $connect->query($sql);
    $total_approved = 0;
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $total_approved = $row["total_approved"];
    }
    ?>

                        <div class="stat-content d-inline-block">
                            <div class="stat-text">NOT APPROVED</div>
                             <div class="stat-digit">0<?php echo $total_approved; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--**********************************
    Content body end
***********************************-->

<?php include '../include/footer.php'; ?>
