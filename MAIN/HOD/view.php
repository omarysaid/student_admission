<?php
session_start();
include '../../connection/connection.php';
include '../include/header.php';
include '../include/sidebar.php';
?> 

 <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
             <div class="row page-titles mx-0" style="background-color:#094469;">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4 style="color:white">H.O.Ds Details Table</h4>    <a href="./create.php" class="btn btn" style="width: 100px;
             margin-left:1000px;background-color:green"> ADD</a>
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
                                                  <th >Username</th>
                                                 <th >Gender</th>
                                                  
                                                     <th >Phone</th>
                                                     
                                                       <th >department</th>
                                                <th >Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
 <?php
                                        $cnt = 1; // Initialize the counter
                                        $select_users =
                                           $select_users = "SELECT * FROM users WHERE usertype = 'HOD'";
                                        $result = mysqli_query($connect, $select_users) or die(mysqli_error($connect));
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
                                                       
                                                           <td style="color:black"><?php echo $row['department']; ?></td>

                                          
                                            <td>

                                                <span>
                                                    <a href="./update.php?user_id=<?php echo $row['user_id'] ?>">
                                                        <button class="btn btn-success" style="width: 40px; ">
                                                            <i class="fa fa-edit"></i>
                                                            <!-- Eye icon for view -->
                                                        </button>
                                                    </a>
                                                </span>




                                                <span>
                                                    <button class="btn btn-danger" style="width: 40px;"
                                                        onclick="confirmDelete(<?php echo $row['user_id'] ?>)">
                                                        <i class="fa fa-trash"></i>
                                                        <!-- Trash icon for delete -->
                                                    </button>
                                                </span>



                                            </td>
                                        </tr>
                                        <?php
                                            }
                                        } else {
                                            echo "<tr><td colspan='5'>0 results</td></tr>";
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
        window.location.href = "./delete.php?user_id=" + Id;
    }
}
</script>


 
