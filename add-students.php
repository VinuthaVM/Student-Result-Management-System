<?php
session_start();

// Enable full error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('includes/config.php');

// Ensure session is active
if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
    exit;
} else {
    if (isset($_POST['submit'])) {
        // Retrieve form data
        $studentname = $_POST['fullname']; // Corrected name
        $rollid = $_POST['rollid'];
        $studentemail = $_POST['emailid'];
        $gender = $_POST['gender'];
        $classid = $_POST['class'];
        $dob = $_POST['dob'];

        try {
            // Set PDO error mode to exception for detailed error reporting
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Prepare SQL statement without Status column
            $sql = "INSERT INTO tblstudents (StudentName, RollId, StudentEmail, Gender, ClassId, DOB) 
                    VALUES (:studentname, :rollid, :studentemail, :gender, :classid, :dob)";
            $query = $dbh->prepare($sql);

            // Bind parameters
            $query->bindParam(':studentname', $studentname, PDO::PARAM_STR);
            $query->bindParam(':rollid', $rollid, PDO::PARAM_STR);
            $query->bindParam(':studentemail', $studentemail, PDO::PARAM_STR);
            $query->bindParam(':gender', $gender, PDO::PARAM_STR);
            $query->bindParam(':classid', $classid, PDO::PARAM_INT); // Assuming classid is an integer
            $query->bindParam(':dob', $dob, PDO::PARAM_STR);

            // Execute query
            if ($query->execute()) {
                $lastInsertId = $dbh->lastInsertId();
                if ($lastInsertId) {
                    $msg = "Student info added successfully";
                } else {
                    $error = "Something went wrong. Please try again";
                }
            } else {
                $error = "Execution failed. Please check your query.";
            }
        } catch (PDOException $e) {
            // Catch and display detailed PDO exceptions
            $error = "Error: " . $e->getMessage();
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SRMS Admin | Add Student</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" media="screen">
    <link rel="stylesheet" href="css/font-awesome.min.css" media="screen">
    <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen">
    <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen">
    <link rel="stylesheet" href="css/prism/prism.css" media="screen">
    <link rel="stylesheet" href="css/select2/select2.min.css">
    <link rel="stylesheet" href="css/main.css" media="screen">
    <script src="js/modernizr/modernizr.min.js"></script>
</head>
<body class="top-navbar-fixed">
    <div class="main-wrapper">
        <!-- ========== TOP NAVBAR ========== -->
        <?php include('includes/topbar.php'); ?>
        <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
        <div class="content-wrapper">
            <div class="content-container">
                <!-- ========== LEFT SIDEBAR ========== -->
                <?php include('includes/leftbar.php'); ?>
                <!-- /.left-sidebar -->
                <div class="main-page">
                    <div class="container-fluid">
                        <div class="row page-title-div">
                            <div class="col-md-6">
                                <h2 class="title">Add Student</h2>
                            </div>
                        </div>
                        <!-- /.row -->
                        <div class="row breadcrumb-div">
                            <div class="col-md-6">
                                <ul class="breadcrumb">
                                    <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                    <li><a href="#">Students</a></li>
                                    <li class="active">Add Student</li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <div class="panel-title">
                                            <h5>Fill the Student info</h5>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <?php if (isset($msg)) { ?>
                                            <div class="alert alert-success left-icon-alert" role="alert">
                                                <strong>Well done!</strong> <?php echo htmlentities($msg); ?>
                                            </div>
                                        <?php } else if (isset($error)) { ?>
                                            <div class="alert alert-danger left-icon-alert" role="alert">
                                                <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                                            </div>
                                        <?php } ?>
                                        <form class="form-horizontal" method="post">
                                            <div class="form-group">
                                                <label for="fullname" class="col-sm-2 control-label">Full Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="fullname" class="form-control"
                                                        id="fullname" required="required" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="rollid" class="col-sm-2 control-label">Reg. No</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="rollid" class="form-control" id="rollid"
                                                        maxlength="10" required="required" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="emailid" class="col-sm-2 control-label">Email id</label>
                                                <div class="col-sm-10">
                                                    <input type="email" name="emailid" class="form-control" id="emailid"
                                                        required="required" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="gender" class="col-sm-2 control-label">Gender</label>
                                                <div class="col-sm-10">
                                                    <input type="radio" name="gender" value="Male" required="required"
                                                        checked=""> Male 
                                                    <input type="radio" name="gender" value="Female"
                                                        required="required"> Female 
                                                    <input type="radio" name="gender"
                                                        value="Other" required="required"> Other
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="class" class="col-sm-2 control-label">Department & Sec</label>
                                                <div class="col-sm-10">
                                                    <select name="class" class="form-control" id="class" required="required">
                                                        <option value="">Select Department</option>
                                                        <?php
                                                        $sql = "SELECT * from tblclasses";
                                                        $query = $dbh->prepare($sql);
                                                        $query->execute();
                                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                        if ($query->rowCount() > 0) {
                                                            foreach ($results as $result) { ?>
                                                                <option value="<?php echo htmlentities($result->id); ?>">
                                                                    <?php echo htmlentities($result->ClassName); ?>&nbsp;
                                                                    Year-<?php echo htmlentities($result->ClassNameNumeric); ?>&nbsp;
                                                                    Section-<?php echo htmlentities($result->Section); ?>
                                                                </option>
                                                            <?php }
                                                        } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="dob" class="col-sm-2 control-label">Date of Birth</label>
                                                <div class="col-sm-10">
                                                    <input type="date" name="dob" class="form-control" id="dob">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <button type="submit" name="submit" class="btn btn-primary">Add</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- /.col-md-12 -->
                        </div>
                    </div>
                </div>
                <!-- /.content-container -->
            </div>
            <!-- /.content-wrapper -->
        </div>
        <!-- /.main-wrapper -->
        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>
        <script src="js/prism/prism.js"></script>
        <script src="js/select2/select2.min.js"></script>
        <script src="js/main.js"></script>
        <script>
            $(function($) {
                $(".js-states").select2();
                $(".js-states-limit").select2({
                    maximumSelectionLength: 2
                });
                $(".js-states-hide").select2({
                    minimumResultsForSearch: Infinity
                });
            });
        </script>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container">
                <p class="m-0 text-center text-white"><span class="copyright-text">&#169; <?php echo date("Y"); ?> All rights reserved to the University</span></p>
            </div>
        </footer>
    </body>
</html>
<?php } ?>
