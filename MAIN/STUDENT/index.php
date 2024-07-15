<?php
session_start();
include '../../connection/connection.php';
include '../include/header.php';
include '../include/std_sidebar.php';

// Get progress value from URL parameter
$progressValue = isset($_GET['progress']) ? $_GET['progress'] : 0;

// Define variables to hold the progress words
$progressWords = "";
$progressColor = "";

// Determine the progress words based on the progress value
if ($progressValue < 50) {
    $progressWords = "Partial Verified";
    $progressColor = "#e74c3c"; // Red color
} elseif ($progressValue == 50) {
    $progressWords = "H.O.D Level";
    $progressColor = "#094469"; // Default color
} elseif ($progressValue == 100) {
    $progressWords = "Successfully Verified";
    $progressColor = "#2ecc71"; // Green color
}

?>

<!--**********************************
    Content body start
***********************************-->
<div class="content-body shadow">
    <div class="container-fluid shadow">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4 style="color:#094469">Hi, welcome ( <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>)</h4>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-6 col-sm-12 text-center">
                <div class="progress-container shadow">
                    <div class="progress-bar" id="progressBar" style="width: <?php echo $progressValue; ?>%; background-color: <?php echo $progressColor; ?>;"></div>
                </div>
                <div class="progress-text" id="progressText" style="color: <?php echo $progressColor; ?>;">
                    <?php echo $progressWords; ?>: <?php echo $progressValue; ?>%
                </div>
            </div>
        </div>
    </div>
</div>
<!--**********************************
    Content body end
***********************************-->

<?php include '../include/footer.php'; ?>

<style>
.progress-container {
    width: 100%;
    height: 30px;
    background-color: #ddd;
    border-radius: 5px;
    margin-top: 20px;
    position: relative;
}

.progress-bar {
    height: 100%;
    background-color: #094469;
    border-radius: 5px;
    text-align: center;
    color: white;
    line-height: 30px; /* Adjust based on the height of the progress bar */
}

.progress-text {
    margin-top: 10px;
    font-size: 1.2rem;
    color: #094469;
}

.shadow {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Set the progress dynamically from the URL parameter
    var progressValue = <?php echo $progressValue; ?>;
    document.getElementById('progressBar').style.width = progressValue + '%';
    document.getElementById('progressText').textContent = '<?php echo $progressWords; ?>: ' + progressValue + '%';
});
</script>
