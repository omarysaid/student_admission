<?php
session_start();
include '../../connection/connection.php';
include '../include/std_header.php';
include '../include/std_sidebar.php';



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add"])) {
  
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
    $school = isset($_POST["school"]) ? $_POST["school"] : '';
    $department = isset($_POST["department"]) ? $_POST["department"] : '';
    $course = isset($_POST["course"]) ? $_POST["course"] : '';
    $ss_name = isset($_POST["ss_name"]) ? $_POST["ss_name"] : '';
    $ss_start_date = isset($_POST["ss_start_date"]) ? $_POST["ss_start_date"] : '';
    $ss_end_date = isset($_POST["ss_end_date"]) ? $_POST["ss_end_date"] : '';
    $as_name = isset($_POST["as_name"]) ? $_POST["as_name"] : '';
    $as_start_date = isset($_POST["as_start_date"]) ? $_POST["as_start_date"] : '';
    $as_end_date = isset($_POST["as_end_date"]) ? $_POST["as_end_date"] : '';

 
    $csee_document = '';
    if (!empty($_FILES["csee_document"]["name"])) {
        $csee_document = uploadFile($_FILES["csee_document"]);
    }

   
    $acsee_document = '';
    if (!empty($_FILES["acsee_document"]["name"])) {
        $acsee_document = uploadFile($_FILES["acsee_document"]);
    }

  
    $birth_certificate = '';
    if (!empty($_FILES["birth_certificate"]["name"])) {
        $birth_certificate = uploadFile($_FILES["birth_certificate"]);
    }

 
    $sql = "INSERT INTO students_info (user_id, school, department, course, ss_name, ss_start_date, ss_end_date, csee_document, as_name, as_start_date, as_end_date, acsee_document, birth_certificate) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("issssssssssss", $user_id, $school, $department, $course, $ss_name, $ss_start_date, $ss_end_date, $csee_document, $as_name, $as_start_date, $as_end_date, $acsee_document, $birth_certificate);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Student information added successfully.";
        header("location: std_view.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $stmt->error;
    }
    $stmt->close();
}


function uploadFile($file) {
    $targetDir = "./uploads/";
    $fileName = basename($file["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
    $allowTypes = array('jpg', 'jpeg', 'png', 'pdf', 'docx');

    if (in_array(strtolower($fileType), $allowTypes)) {
        if (move_uploaded_file($file["tmp_name"], $targetFilePath)) {
            return $fileName;
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "Sorry, only JPG, JPEG, PNG, PDF, and DOCX files are allowed.";
    }
    return '';
}
?>


<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0" style="background-color:#094469";">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4 style="color:white">Student Registration Form</h4>
                </div>
            </div>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-xl-12 col-xxl-12">
                <div class="card shadow">
                    <div class="card-body">
                        <!-- Step Indicator -->
                        <div class="step-indicator-box">
                            <div class="step-indicator">
                                <div class="circle active" id="circle1">1</div>
                                <div class="line"></div>
                                <div class="circle" id="circle2">2</div>
                                <div class="line"></div>
                                <div class="circle" id="circle3">3</div>
                                <div class="line"></div>
                                <div class="circle" id="circle4">4</div>
                            </div>
                        </div>

                        <div class="basic-form">
                            <form name="userForm" method="POST" onsubmit="return validateForm()" enctype="multipart/form-data">


                              <?php
                            // Display success message if it exists
                            if (isset($_SESSION['success_message'])) {
                                echo '<div class="alert alert" style="color:white;background-color:#094469">' . $_SESSION['success_message'] . '</div>';
                                unset($_SESSION['success_message']); // Clear the success message
                            }
                            ?>
                                <!-- Step 1 -->
                                <div id="step1">
                                            <div class="col-md-6">
                                            <div>
                                                
                                                <input type="hidden" value="<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ''; ?> "readonly class="form-control" style="height:50px">
                                            </div>
                                        </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <div>
                                                <label class="col-form-label" style="color:black">Fullname</label>
                                                <input type="text" value="<?php echo isset($_SESSION['fullname']) ? $_SESSION['fullname'] : ''; ?> "readonly class="form-control" style="height:50px">
                                            </div>
                                        </div>
                                         <div class="col-md-6">
                                            <div>
                                                <label class="col-form-label" style="color:black">Username</label>
                                                <input type="text" value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?> "readonly class="form-control" style="height:50px">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                           <div class="col-md-6">
                                            <div>
                                                <label class="col-form-label" style="color:black">Gender</label>
                                                <input type="text" value="<?php echo isset($_SESSION['gender']) ? $_SESSION['gender'] : ''; ?> "readonly class="form-control" style="height:50px">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div>
                                                <label class="col-form-label" style="color:black">Country</label>
                                                <input type="text" value="<?php echo isset($_SESSION['country']) ? $_SESSION['country'] : ''; ?> "readonly class="form-control" style="height:50px">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <div>
                                                <label class="col-form-label" style="color:black">Region</label>
                                                <input type="text" value="<?php echo isset($_SESSION['region']) ? $_SESSION['region'] : ''; ?> "readonly class="form-control" style="height:50px">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div>
                                                <label class="col-form-label" style="color:black">District</label>
                                                <input type="text" value="<?php echo isset($_SESSION['district']) ? $_SESSION['district'] : ''; ?> "readonly class="form-control" style="height:50px">
                                            </div>
                                        </div>
                                    </div>

                                      <div class="form-group row">
                                        <div class="col-md-6">
                                            <div>
                                                <label class="col-form-label" style="color:black">Phone</label>
                                                <input type="text" value="<?php echo isset($_SESSION['phone']) ? $_SESSION['phone'] : ''; ?> "readonly class="form-control" style="height:50px">
                                            </div>
                                        </div>
                                       
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <button type="button" class="btn btn"  style="background-color:#094469"  onclick="showStep2()">Next</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Step 2 -->
                                <div id="step2" style="display:none;">
                                  
                                    <div class="form-group row">
                                         <div class="col-md-6">
                                        <div>
                                            <label class="col-form-label" style="color:black">School</label>
                                            <select name="school" class="form-control" style="height:50px">
                                                <option value="" disabled selected>Select school</option>
                                                <option value="The School of Architecture, Construction Economics and Management (SACEM)">The School of Architecture, Construction Economics and Management (SACEM)</option>
                                                <option value="The School of Earth Sciences, Real Estates, Business and Informatics (SERBI)">The School of Earth Sciences, Real Estates, Business and Informatics (SERBI)</option>
                                                <option value="The School of Engineering and Environmental Studies (SEES)">The School of Engineering and Environmental Studies (SEES)</option>
                                                <option value="The School of Spatial Planning and Social Science (SSPSS)">The School of Spatial Planning and Social Science (SSPSS)</option>
                                             
                                            </select>
                                        </div>
                                    </div>
                                        <div class="col-md-6">
                                        <div>
                                            <label class="col-form-label" style="color:black">Depertment</label>
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
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                        <div>
                                            <label class="col-form-label" style="color:black">Course</label>
                                            <select name="course" class="form-control" style="height:50px">
                                                <option value="" disabled selected>Select course</option>
                                                <option value="Bachelor of Science in Quantity Surveying and Construction Economics">Bachelor of Science in Quantity Surveying and Construction Economics</option>
                                                <option value="Bachelor of Architecture">Bachelor of Architecture</option>
                                                <option value="Bachelor of Science in Interior Design">Bachelor of Science in Interior Design</option>
                                                <option value="Bachelor of Science in Landscape Architecture">Bachelor of Science in Landscape Architecture</option>
                                                <option value="Bachelor of Science in Geomatics">Bachelor of Science in Geomatics</option>
                                                <option value="Bachelor of Science in Geographical Information Systems and Remote Sensing">Bachelor of Science in Geographical Information Systems and Remote Sensing</option>
                                                <option value="Diploma in GFM4">Diploma in GFM4</option>
                                                <option value="Bachelor of Science in Information Systems Management">Bachelor of Science in Information Systems Management</option>
                                                <option value="Bachelor of Science in Computer Systems and Networks">Bachelor of Science in Computer Systems and Networks</option>
                                                <option value="Bachelor of Science in Real Estate (Finance and Investment)">Bachelor of Science in Real Estate (Finance and Investment)</option>
                                                <option value="Bachelor of Science in Accounting and Finance">Bachelor of Science in Accounting and Finance</option>
                                                  <option value="Bachelor of Science in Land Management and Valuation">Bachelor of Science in Land Management and Valuation</option>
                                                    <option value="Bachelor of Science in Property and Facilities Management">Bachelor of Science in Property and Facilities Management</option>
                                                      <option value="Bachelor of Science in Civil Engineering">Bachelor of Science in Civil Engineering</option>
                                                        <option value="Bachelor of Science in Environmental Engineering">Bachelor of Science in Environmental Engineering</option>
                                                          <option value="Bachelor of Science in Municipal and Industrial Services Engineering">Bachelor of Science in Municipal and Industrial Services Engineering</option>
                                                            <option value="Bachelor of Science in Environmental Science and Management">Bachelor of Science in Environmental Science and Management</option>
                                                              <option value="Bachelor of Science in Environmental Laboratory Sciences and Technology">Bachelor of Science in Environmental Laboratory Sciences and Technology</option>
                                                                <option value="Bachelor of Science in Urban and Regional Planning">Bachelor of Science in Urban and Regional Planning</option>
                                                                  <option value="Bachelor of Science in Housing and Infrastructure Planning">Bachelor of Science in Housing and Infrastructure Planning</option>
                                                                    <option value="Bachelor of Science in Regional Development Planning">Bachelor of Science in Regional Development Planning</option>
                                                                      <option value="Bachelor of Arts in Community and Development Studies">Bachelor of Arts in Community and Development Studies</option>
                                                                      
                                            </select>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <button type="button" class="btn btn" style="background-color:#094469"  onclick="showStep1()">Previous</button>
                                            <button type="button" class="btn btn"  style="background-color:#094469" onclick="showStep3()">Next</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Step 3 -->
                                <div id="step3" style="display:none;">
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <div>
                                                <label class="col-form-label" style="color:black">Sec school Name</label>
                                                <input type="text" name="ss_name" class="form-control" placeholder="Enter Sec School Name" style="height:50px">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div>
                                                <label class="col-form-label" style="color:black">Start year</label>
                                                <input type="number" name="ss_start_date" class="form-control" style="height:50px">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <div>
                                                <label class="col-form-label" style="color:black"> End year</label>
                                                <input type="number" name="ss_end_date" class="form-control" style="height:50px">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div>
                                                <label class="col-form-label" style="color:black">CSEE Certificate</label>
                                                <input type="file" name="csee_document" class="form-control" style="height:50px">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <button type="button" class="btn btn" style="background-color:#094469"  onclick="showStep2()">Previous</button>
                                            <button type="button" class="btn btn" style="background-color:#094469"   onclick="showStep4()">Next</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Step 4 -->
                                <div id="step4" style="display:none;">
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <div>
                                                <label class="col-form-label" style="color:black">High school/ College Name</label>
                                                <input type="text" name="as_name" class="form-control" placeholder="Enter school/college Name" style="height:50px">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div>
                                                <label class="col-form-label" style="color:black"> Start Year</label>
                                                <input type="number" name="as_start_date" class="form-control" style="height:50px">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                                                                <div class="col-md-6">
                                            <div>
                                                <label class="col-form-label" style="color:black">End Year</label>
                                                <input type="number" name="as_end_date" class="form-control" style="height:50px">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div>
                                                <label class="col-form-label" style="color:black">ACSEE/Colledge Certificate</label>
                                                <input type="file" name="acsee_document" class="form-control" style="height:50px">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <div>
                                                <label class="col-form-label" style="color:black">Birth Certificate</label>
                                                <input type="file" name="birth_certificate" class="form-control" style="height:50px">
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="usertype" class="form-control" value="HOD" style="height:50px">
                                 
                                     
                                            <button type="button" class="btn btn" style="background-color:#094469"   onclick="showStep3()">Previous</button>
                                            <button type="submit" name="add" class="btn btn" style="background-color:#094469">Submit</button>
                                     
                                 
                                </div>
                            </form>
                            <script>
                                function showStep1() {
                                    document.getElementById('step1').style.display = 'block';
                                    document.getElementById('step2').style.display = 'none';
                                    document.getElementById('step3').style.display = 'none';
                                    document.getElementById('step4').style.display = 'none';
                                    document.getElementById('circle1').classList.add('active');
                                    document.getElementById('circle2').classList.remove('active');
                                    document.getElementById('circle3').classList.remove('active');
                                    document.getElementById('circle4').classList.remove('active');
                                }
                                function showStep2() {
                                    document.getElementById('step1').style.display = 'none';
                                    document.getElementById('step2').style.display = 'block';
                                    document.getElementById('step3').style.display = 'none';
                                    document.getElementById('step4').style.display = 'none';
                                    document.getElementById('circle1').classList.remove('active');
                                    document.getElementById('circle2').classList.add('active');
                                    document.getElementById('circle3').classList.remove('active');
                                    document.getElementById('circle4').classList.remove('active');
                                }
                                function showStep3() {
                                    document.getElementById('step1').style.display = 'none';
                                    document.getElementById('step2').style.display = 'none';
                                    document.getElementById('step3').style.display = 'block';
                                    document.getElementById('step4').style.display = 'none';
                                    document.getElementById('circle1').classList.remove('active');
                                    document.getElementById('circle2').classList.remove('active');
                                    document.getElementById('circle3').classList.add('active');
                                    document.getElementById('circle4').classList.remove('active');
                                }
                                function showStep4() {
                                    document.getElementById('step1').style.display = 'none';
                                    document.getElementById('step2').style.display = 'none';
                                    document.getElementById('step3').style.display = 'none';
                                    document.getElementById('step4').style.display = 'block';
                                    document.getElementById('circle1').classList.remove('active');
                                    document.getElementById('circle2').classList.remove('active');
                                    document.getElementById('circle3').classList.remove('active');
                                    document.getElementById('circle4').classList.add('active');
                                }
                            </script>
                            <script src="path/to/your/validation.js"></script>
                            <style>
                                .step-indicator-box {
                                    display: flex;
                                    justify-content: center;
                                    margin-bottom: 20px;
                                }
                                .step-indicator {
                                    display: flex;
                                    align-items: center;
                                }
                                .circle {
                                    width: 30px;
                                    height: 30px;
                                    border-radius: 50%;
                                    background-color: lightgray;
                                    display: flex;
                                    justify-content: center;
                                    align-items: center;
                                    color: black;
                                    font-weight: bold;
                                }
                                .circle.active {
                                    background-color: #094469;
                                    color: white;
                                }
                                .line {
                                    width: 100px;
                                    height: 2px;
                                    background-color: #094469;
                                    margin: 0 10px;
                                }
                                .circle.active + .line {
                                    background-color: #094469;
                                }
                            </style>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 
<?php include '../include/footer.php'; ?>

