<?php
session_start();
error_reporting(0);
include ('includes/config.php');

if (strlen($_SESSION['alogin']) == 0) {
    header("Location: index.php");
    exit();
} else {
    $minPercentage = null;
    $maxPercentage = null;

    if (isset($_POST['submit'])) {
        $minPercentage = floatval($_POST['minPercentage']);
        $maxPercentage = floatval($_POST['maxPercentage']);
    }

    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>View Marks by Percentage Range | SRMS Admin</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen">
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen">
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen">
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen">
        <link rel="stylesheet" href="css/prism/prism.css" media="screen">
        <link rel="stylesheet" type="text/css" href="js/DataTables/datatables.min.css" />
        <link rel="stylesheet" href="css/main.css" media="screen">
        <script src="js/modernizr/modernizr.min.js"></script>
        <style>
            .errorWrap {
                padding: 10px;
                margin: 0 0 20px 0;
                background: #fff;
                border-left: 4px solid #dd3d36;
                -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
                box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            }

            .succWrap {
                padding: 10px;
                margin: 0 0 20px 0;
                background: #fff;
                border-left: 4px solid #5cb85c;
                -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
                box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            }

            .form-group {
                margin-bottom: 15px;
            }
        </style>
    </head>

    <body class="top-navbar-fixed">
        <div class="main-wrapper">
            <?php include ('includes/topbar.php'); ?>
            <div class="content-wrapper">
                <div class="content-container">
                    <?php include ('includes/leftbar.php'); ?>
                    <div class="main-page">
                        <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-md-6">
                                    <h2 class="title">View Marks by Percentage Range</h2>
                                </div>
                            </div>
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
                                        <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                        <li class="active">View Marks by Percentage Range</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-md-offset-3">
                                    <div class="panel">
                                        <div class="panel-heading">
                                            <div class="panel-title">
                                                <h5>Select Percentage Range</h5>
                                            </div>
                                        </div>
                                        <div class="panel-body p-20">
                                            <form method="post" action="">
                                                <div class="form-group">
                                                    <label>Minimum Percentage:</label>
                                                    <input type="number" name="minPercentage" class="form-control"
                                                        step="0.01" min="0" max="100"
                                                        value="<?php echo isset($minPercentage) ? $minPercentage : ''; ?>"
                                                        required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Maximum Percentage:</label>
                                                    <input type="number" name="maxPercentage" class="form-control"
                                                        step="0.01" min="0" max="100"
                                                        value="<?php echo isset($maxPercentage) ? $maxPercentage : ''; ?>"
                                                        required>
                                                </div>
                                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php if (isset($_POST['submit'])): ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <div class="panel-title">
                                                    <h5>Marks by Percentage Range: <?php echo htmlentities($minPercentage); ?>%
                                                        - <?php echo htmlentities($maxPercentage); ?>%</h5>
                                                </div>
                                            </div>
                                            <div class="panel-body p-20">
                                                <table id="example" class="display table table-striped table-bordered"
                                                    cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Student Name</th>
                                                            <th>Roll No</th>
                                                            <th>Department</th>
                                                            <th>Total Marks</th>
                                                            <th>Percentage</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sql = "SELECT 
                                                                    tblstudents.StudentName, 
                                                                    tblstudents.RollId, 
                                                                    tblclasses.ClassName, 
                                                                    SUM(tblresult.Marks) AS TotalMarks, 
                                                                    (SUM(tblresult.Marks) / COUNT(tblresult.Marks)) AS Percentage 
                                                                FROM 
                                                                    tblresult 
                                                                JOIN 
                                                                    tblstudents ON tblstudents.StudentId = tblresult.StudentId 
                                                                JOIN 
                                                                    tblclasses ON tblclasses.id = tblresult.ClassId 
                                                                GROUP BY 
                                                                    tblstudents.StudentId 
                                                                HAVING 
                                                                    Percentage BETWEEN :minPercentage AND :maxPercentage";

                                                        $query = $dbh->prepare($sql);
                                                        $query->bindParam(':minPercentage', $minPercentage, PDO::PARAM_STR);
                                                        $query->bindParam(':maxPercentage', $maxPercentage, PDO::PARAM_STR);
                                                        $query->execute();
                                                        $results = $query->fetchAll(PDO::FETCH_OBJ);

                                                        if ($query->rowCount() > 0) {
                                                            foreach ($results as $result) {
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo htmlentities($result->StudentName); ?></td>
                                                                    <td><?php echo htmlentities($result->RollId); ?></td>
                                                                    <td><?php echo htmlentities($result->ClassName); ?></td>
                                                                    <td><?php echo htmlentities($result->TotalMarks); ?></td>
                                                                    <td><?php echo round($result->Percentage , 2); ?>%</td>
                                                                </tr>
                                                                <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <tr>
                                                                <td colspan="5">No records found.</td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
            <?php include ('includes/footer.php'); ?>
        </div>
        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>
        <script src="js/prism/prism.js"></script>
        <script src="js/DataTables/datatables.min.js"></script>
        <script src="js/main.js"></script>
        <script>
            $(function ($) {
                $('#example').DataTable();
            });
        </script>
    </body>

    </html>
<?php } ?>