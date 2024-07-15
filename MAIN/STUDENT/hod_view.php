<?php
session_start();
include '../../connection/connection.php';
include '../include/header.php';
include '../include/hod_sidebar.php';

// Retrieve logged-in HOD's department from session
$loggedInUserDepartment = $_SESSION['department']; // Adjust this according to how you store department information in the session
?>

<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0" style="background-color: #094469;">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4 style="color:white">Students Details Table</h4>
                </div>
            </div>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Details Datatable</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive  table-bordered">
                            <table id="example" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Fullname</th>
                                        <th>Username</th>
                                        <th>Gender</th>
                                        <th>Phone</th>
                                        <th>School</th>
                                        <th>Department</th>
                                        <th>Course</th>
                                        <th>Sec school</th>
                                        <th>Start Date</th>
                                        <th> End Date</th>
                                        <th>CSEE Document</th>
                                        <th>High school</th>
                                        <th>Start Date</th>
                                        <th> End Date</th>
                                        <th>ACSEE Document</th>
                                        <th>Birth Certificate</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    function limit_words($text, $limit) {
                                        $words = explode(' ', $text);
                                        $output = '';
                                        for ($i = 0; $i < count($words); $i += $limit) {
                                            $output .= implode(' ', array_slice($words, $i, $limit)) . '<br>';
                                        }
                                        return $output;
                                    }

                                    $cnt = 1; // Initialize the counter
                                  $select_users = "SELECT u.user_id, u.fullname, u.username, u.gender, u.phone, 
                    s.info_id, -- Include info_id in the select statement
                    s.school, s.department, s.course, s.ss_name, 
                    s.ss_start_date, s.ss_end_date, s.csee_document, 
                    s.as_name, s.as_start_date, s.as_end_date, 
                    s.acsee_document, s.birth_certificate ,s.status_1
                FROM users u
                INNER JOIN students_info s ON u.user_id = s.user_id
                WHERE u.usertype = 'STUDENT' 
                AND s.department = '$loggedInUserDepartment'";// Add condition to match HOD's department
                                    $result = mysqli_query($connect, $select_users);
                                    
                                    // Debugging: display query and error
                                    if (!$result) {
                                        echo "Error: " . mysqli_error($connect);
                                    } else {
                                        $number = mysqli_num_rows($result);
                                        if ($number > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $cnt++; ?></td>
                                                    <td style="color:black"><?php echo $row['fullname']; ?></td>
                                                    <td style="color:black"><?php echo $row['username']; ?></td>
                                                    <td style="color:black"><?php echo $row['gender']; ?></td>
                                                    <td style="color:black"><?php echo $row['phone']; ?></td>
                                                    <td style="color:black"><?php echo limit_words($row['school'], 2); ?></td>
                                                    <td style="color:black"><?php echo limit_words($row['department'], 2); ?></td>
                                                    <td style="color:black"><?php echo limit_words($row['course'], 2); ?></td>
                                                    <td style="color:black"><?php echo $row['ss_name']; ?></td>
                                                    <td style="color:black"><?php echo $row['ss_start_date']; ?></td>
                                                    <td style="color:black"><?php echo $row['ss_end_date']; ?></td>
                                                    <td style="color:black"><a href="./uploads/<?php echo $row['csee_document']; ?>" target="_blank">View</a></td>
                                                    <td style="color:black"><?php echo $row['as_name']; ?></td>
                                                    <td style="color:black"><?php echo $row['as_start_date']; ?></td>
                                                    <td style="color:black"><?php echo $row['as_end_date']; ?></td>
                                                    <td style="color:black"><a href="./uploads/<?php echo $row['acsee_document']; ?>" target="_blank">View</a></td>
                                                    <td style="color:black"><a href="./uploads/<?php echo $row['birth_certificate']; ?>" target="_blank">View</a></td>
                                                    <td style="color:<?php echo $row['status_1'] == 1 ? 'green' : 'red'; ?>"><?php echo $row['status_1'] == 1 ? 'Approved' : 'Not Approved'; ?></td>
                                                    <td>
                                                        <span>
                                                            <a href="../STUDENT/approval1.php?user_id=<?php echo $row['user_id'] ?>">
                                                                <button class="btn btn-success" style="width: 40px;">
                                                                    <i class="fa fa-edit"></i>
                                                                </button>
                                                            </a>
                                                        </span>
                                                        <span>
                                                            <button class="btn btn-danger" style="width: 40px;"
                                                                    onclick="confirmDelete(<?php echo $row['info_id'] ?>)">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </span>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            echo "<tr><td colspan='18'>0 results</td></tr>";
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../include/footer.php'; ?>


<script>
function confirmDelete(Id) {
    // Display confirmation dialog
    if (confirm("Are you sure you want to delete?")) {
        // If user confirms, redirect to delete script
        window.location.href = "./delete.php?info_id=" + Id;
    }
}
</script>