<?php
session_start();
error_reporting(0);
include ('includes/config.php');

// Ensure session is active
if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
    exit;
}

if (isset($_GET['stid'])) {
    $stid = $_GET['stid'];

    // Fetch student details
    $sql = "SELECT * FROM tblstudents WHERE StudentId=:stid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':stid', $stid, PDO::PARAM_STR);
    $query->execute();
    $student = $query->fetch(PDO::FETCH_OBJ);

    if (!$student) {
        echo "Student not found!";
        exit;
    }
}

// Handle form submission
if (isset($_POST['update'])) {
    $studentname = $_POST['fullname'];
    $rollid = $_POST['rollid'];
    $studentemail = $_POST['emailid'];
    $gender = $_POST['gender'];
    $classid = $_POST['class'];
    $dob = $_POST['dob'];

    // Update student details
    $sql = "UPDATE tblstudents SET StudentName=:studentname, RollId=:rollid, StudentEmail=:studentemail, Gender=:gender, ClassId=:classid, DOB=:dob WHERE StudentId=:stid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':studentname', $studentname, PDO::PARAM_STR);
    $query->bindParam(':rollid', $rollid, PDO::PARAM_STR);
    $query->bindParam(':studentemail', $studentemail, PDO::PARAM_STR);
    $query->bindParam(':gender', $gender, PDO::PARAM_STR);
    $query->bindParam(':classid', $classid, PDO::PARAM_INT);
    $query->bindParam(':dob', $dob, PDO::PARAM_STR);
    $query->bindParam(':stid', $stid, PDO::PARAM_STR);

    if ($query->execute()) {
        $msg = "Student details updated successfully";
    } else {
        $error = "Something went wrong. Please try again";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SRMS Admin | Edit Student</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" media="screen">
    <link rel="stylesheet" href="css/font-awesome.min.css" media="screen">
    <link rel="stylesheet" href="css/main.css" media="screen">
    <script src="js/modernizr/modernizr.min.js"></script>
</head>
<body class="top-navbar-fixed">
    <div class="main-wrapper">
        <!-- ========== TOP NAVBAR ========== -->
        <?php include ('includes/topbar.php'); ?>
        <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
        <div class="content-wrapper">
            <div class="content-container">
                <?php include ('includes/leftbar.php'); ?>

                <div class="main-page">
                    <div class="container-fluid">
                        <div class="row page-title-div">
                            <div class="col-md-6">
                                <h2 class="title">Edit Student</h2>
                            </div>
                        </div>
                        <!-- /.row -->
                        <div class="row breadcrumb-div">
                            <div class="col-md-6">
                                <ul class="breadcrumb">
                                    <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                    <li><a href="manage-students.php">Students</a></li>
                                    <li class="active">Edit Student</li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>

                    <section class="section">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel">
                                        <div class="panel-heading">
                                            <div class="panel-title">
                                                <h5>Update Student Info</h5>
                                            </div>
                                        </div>
                                        <?php if ($msg) { ?>
                                            <div class="alert alert-success left-icon-alert" role="alert">
                                                <?php echo htmlentities($msg); ?>
                                            </div>
                                        <?php } else if ($error) { ?>
                                            <div class="alert alert-danger left-icon-alert" role="alert">
                                                <?php echo htmlentities($error); ?>
                                            </div>
                                        <?php } ?>
                                        <div class="panel-body p-20">
                                            <form class="form-horizontal" method="post">
                                                <div class="form-group">
                                                    <label for="fullname" class="col-sm-2 control-label">Full Name</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="fullname" class="form-control" id="fullname" value="<?php echo htmlentities($student->StudentName); ?>" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="rollid" class="col-sm-2 control-label">Reg. No</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="rollid" class="form-control" id="rollid" value="<?php echo htmlentities($student->RollId); ?>" maxlength="10" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="emailid" class="col-sm-2 control-label">Email id</label>
                                                    <div class="col-sm-10">
                                                        <input type="email" name="emailid" class="form-control" id="emailid" value="<?php echo htmlentities($student->StudentEmail); ?>" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="gender" class="col-sm-2 control-label">Gender</label>
                                                    <div class="col-sm-10">
                                                        <input type="radio" name="gender" value="Male" <?php if ($student->Gender == 'Male') echo 'checked'; ?>> Male
                                                        <input type="radio" name="gender" value="Female" <?php if ($student->Gender == 'Female') echo 'checked'; ?>> Female
                                                        <input type="radio" name="gender" value="Other" <?php if ($student->Gender == 'Other') echo 'checked'; ?>> Other
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="class" class="col-sm-2 control-label">Department & Sec</label>
                                                    <div class="col-sm-10">
                                                        <select name="class" class="form-control" id="class" required>
                                                            <option value="">Select Department</option>
                                                            <?php
                                                            $sql = "SELECT * FROM tblclasses";
                                                            $query = $dbh->prepare($sql);
                                                            $query->execute();
                                                            $classes = $query->fetchAll(PDO::FETCH_OBJ);
                                                            foreach ($classes as $class) {
                                                                $selected = ($class->id == $student->ClassId) ? 'selected' : '';
                                                                echo "<option value='".htmlentities($class->id)."' $selected>".htmlentities($class->ClassName)." Year-".htmlentities($class->ClassNameNumeric)." Section-".htmlentities($class->Section)."</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="dob" class="col-sm-2 control-label">Date of Birth</label>
                                                    <div class="col-sm-10">
                                                        <input type="date" name="dob" class="form-control" id="dob" value="<?php echo htmlentities($student->DOB); ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-offset-2 col-sm-10">
                                                        <button type="submit" name="update" class="btn btn-primary">Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>

        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>

