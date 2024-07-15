<?php
session_start();
include '../../connection/connection.php';
include '../include/header.php';
include '../include/hod_sidebar.php';

$department = isset($_SESSION['department']) ? $_SESSION['department'] : '';

?>

<!--**********************************
    Content body start
***********************************-->
<div class="content-body shadow">
    <div class="container-fluid shadow">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4 style="color:#094469">H.O.D! Department: (<?php echo $department; ?>)</h4>
                </div>
            </div>
        </div>

        <div class="row">
           
            <div class="col-lg-6 col-sm-6">
                <div class="card shadow" style="height:150px">
                    <div class="stat-widget-one card-body" style="background-color:aliceblue">
                        <div class="stat-icon d-inline-block">
                            <i class="ti-user" style="border-color:#094469; color:#094469"></i>
                        </div>
                        <div class="stat-content d-inline-block">
                            <?php
                            $sql = "SELECT COUNT(*) AS total_approved 
                                    FROM users 
                                    INNER JOIN students_info ON users.user_id = students_info.user_id 
                                    WHERE users.usertype = 'STUDENT' 
                                    AND students_info.status_1 = 1 
                                    AND students_info.department = ?";
                            $stmt = $connect->prepare($sql);
                            $stmt->bind_param("s", $department);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $total_approved = 0;
                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                $total_approved = $row["total_approved"];
                            }
                            $stmt->close();
                            ?>
                            <div class="stat-text">APPROVALS</div>
                            <div class="stat-digit"><?php echo $total_approved; ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-6">
                <div class="card shadow" style="height:150px; background-color:aliceblue">
                    <div class="stat-widget-one card-body" style="background-color:aliceblue">
                        <div class="stat-icon d-inline-block">
                            <i class="ti-user" style="border-color:#094469; color:#094469"></i>
                        </div>
                        <div class="stat-content d-inline-block">
                            <?php
                            $sql = "SELECT COUNT(*) AS total_not_approved 
                                    FROM users 
                                    INNER JOIN students_info ON users.user_id = students_info.user_id 
                                    WHERE users.usertype = 'STUDENT' 
                                    AND students_info.status_1 = 0 
                                    AND students_info.department = ?";
                            $stmt = $connect->prepare($sql);
                            $stmt->bind_param("s", $department);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $total_not_approved = 0;
                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                $total_not_approved = $row["total_not_approved"];
                            }
                            $stmt->close();
                            ?>
                            <div class="stat-text">NOT APPROVED</div>
                            <div class="stat-digit"><?php echo $total_not_approved; ?></div>
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
