<?php
session_start();
include('includes/config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SRMS | Results</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" media="screen">
    <link rel="stylesheet" href="css/font-awesome.min.css" media="screen">
    <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen">
    <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen">
    <link rel="stylesheet" href="css/prism/prism.css" media="screen">
    <link rel="stylesheet" href="css/main.css" media="screen">
    <script src="js/modernizr/modernizr.min.js"></script>
</head>
<body>
    <div class="main-wrapper">
        <div class="content-wrapper">
            <div class="content-container">
                <div class="main-page">
                    <div class="container-fluid">
                        <div class="row page-title-div">
                            <div class="col-md-12">
                                <h2 class="title" align="center">Student Result Management System</h2>
                            </div>
                        </div>
                    </div>
                    <section class="section" id="exampl">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2">
                                    <div class="panel">
                                        <div class="panel-heading">
                                            <div class="panel-title">
                                                <h3 align="center">Student Result Details</h3>
                                                <hr />
                                                <?php
                                                // Check if form data is available
                                                if (isset($_POST['rollid']) && isset($_POST['class'])) {
                                                    $rollid = $_POST['rollid'];
                                                    $classid = $_POST['class'];

                                                    $_SESSION['rollid'] = $rollid;
                                                    $_SESSION['classid'] = $classid;

                                                    try {
                                                        // Fetch student details
                                                        $query = "SELECT tblstudents.StudentName, tblstudents.RollId, tblclasses.ClassName, tblclasses.Section,tblclasses.ClassNameNumeric
                                                                  FROM tblstudents 
                                                                  JOIN tblclasses ON tblclasses.id = tblstudents.ClassId 
                                                                  WHERE tblstudents.RollId = :rollid AND tblstudents.ClassId = :classid";
                                                        $stmt = $dbh->prepare($query);
                                                        $stmt->bindParam(':rollid', $rollid, PDO::PARAM_STR);
                                                        $stmt->bindParam(':classid', $classid, PDO::PARAM_STR);
                                                        $stmt->execute();
                                                        $student = $stmt->fetch(PDO::FETCH_OBJ);

                                                        // Check if student record exists
                                                        if ($student) {
                                                            ?>
                                                            <p><b>Full Name :</b> <?php echo htmlentities($student->StudentName); ?></p>
                                                            <p><b>Reg. No :</b> <?php echo htmlentities($student->RollId); ?></p>
                                                            <p><b>Department:</b> <?php echo htmlentities($student->ClassName); ?> Year: <?php echo htmlentities($student->ClassNameNumeric); ?> Section:<?php echo htmlentities($student->Section); ?> </p>

                                                            <div class="panel-body p-20">
                                                                <table class="table table-hover table-bordered" border="1" width="100%">
                                                                    <thead>
                                                                        <tr style="text-align: center">
                                                                            <th style="text-align: center">S.no</th>
                                                                            <th style="text-align: center">Subject</th>
                                                                            <th style="text-align: center">Marks</th>
                                                                            <th style="text-align: center">Grade</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        // Fetch student result details
                                                                        $query = "SELECT tr.marks, tblsubjects.SubjectName 
                                                                                  FROM tblresult AS tr 
                                                                                  JOIN tblstudents AS sts ON tr.StudentId = sts.StudentId 
                                                                                  JOIN tblsubjects ON tblsubjects.id = tr.SubjectId 
                                                                                  WHERE sts.RollId = :rollid AND sts.ClassId = :classid";
                                                                        $stmt = $dbh->prepare($query);
                                                                        $stmt->bindParam(':rollid', $rollid, PDO::PARAM_STR);
                                                                        $stmt->bindParam(':classid', $classid, PDO::PARAM_STR);
                                                                        $stmt->execute();
                                                                        $results = $stmt->fetchAll(PDO::FETCH_OBJ);

                                                                        // Check if results are available
                                                                        if ($results) {
                                                                            $cnt = 1;
                                                                            $totalMarks = 0;
                                                                            $maxMarks = 100; // Assuming max marks for each subject is 100
                                                                            foreach ($results as $result) {
                                                                                $totalMarks += $result->marks;
                                                                                echo '<tr>';
                                                                                echo '<td align="center">' . $cnt . '</td>';
                                                                                echo '<td>' . htmlentities($result->SubjectName) . '</td>';
                                                                                echo '<td align="center">' . htmlentities($result->marks) . '</td>';
                                                                                echo '<td align="center">' . getGrade(htmlentities($result->marks)) . '</td>';
                                                                                echo '</tr>';
                                                                                $cnt++;
                                                                            }

                                                                            // Calculate percentage
                                                                            $numSubjects = $cnt - 1;
                                                                            $percentage = ($totalMarks / ($numSubjects * $maxMarks)) * 100;
                                                                            ?>
                                                                            <tr>
                                                                                <td colspan="2" align="center"><b>Total Marks</b></td>
                                                                                <td colspan="2" align="center"><b><?php echo $totalMarks; ?></b></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td colspan="2" align="center"><b>Percentage</b></td>
                                                                                <td colspan="2" align="center"><b><?php echo number_format($percentage, 2); ?>%</b></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td colspan="2" align="center"><b>Result</b></td>
                                                                                <td colspan="2" align="center"><b><?php echo $percentage >= 35 ? 'Pass' : 'Fail'; ?></b></td>
                                                                            </tr>
                                                                            <?php
                                                                        } else {
                                                                            echo '<tr><td colspan="4">No results found.</td></tr>';
                                                                        }
                                                                        ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <?php
                                                        } else {
                                                            echo '<div class="alert alert-danger" role="alert"><strong>Oh snap!</strong> Invalid Register Number or Class.</div>';
                                                        }
                                                    } catch (PDOException $e) {
                                                        echo '<div class="alert alert-danger" role="alert"><strong>Error:</strong> ' . $e->getMessage() . '</div>';
                                                    }
                                                } else {
                                                    echo '<div class="alert alert-danger" role="alert"><strong>Error!</strong> Required parameters are missing.</div>';
                                                }

                                                // Function to determine grade based on marks
                                                function getGrade($marks) {
                                                    if ($marks >= 90) return 'A+';
                                                    if ($marks >= 80) return 'A';
                                                    if ($marks >= 70) return 'B+';
                                                    if ($marks >= 60) return 'B';
                                                    if ($marks >= 50) return 'C+';
                                                    if ($marks >= 40) return 'C';
                                                    return 'F';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <!-- ========== COMMON JS FILES ========== -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <script src="js/jquery-ui/jquery-ui.min.js"></script>
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <script src="js/pace/pace.min.js"></script>
    <script src="js/lobipanel/lobipanel.min.js"></script>
    <script src="js/iscroll/iscroll.js"></script>
    <script src="js/icheck/icheck.min.js"></script>
    <script src="js/main.js"></script>

    <!-- Footer -->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">&#169; <?php echo date("Y"); ?> All rights reserved to the University</p>
        </div>
    </footer>
</body>
</html>




