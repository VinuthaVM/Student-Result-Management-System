<?php
session_start();
error_reporting(0);
include ('includes/config.php');
if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
} else {
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>View Failed Subjects | SRMS Admin</title>
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
                                    <h2 class="title">Failed Subjects</h2>
                                </div>
                            </div>
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
                                        <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                        <li class="active">Failed Subjects</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <section class="section">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <div class="panel-title">
                                                    <h5>List of Failed Subjects</h5>
                                                </div>
                                            </div>
                                            <div class="panel-body p-20">
                                                <?php if ($msg) { ?>
                                                    <div class="alert alert-success left-icon-alert" role="alert">
                                                        <strong>Well done!</strong><?php echo htmlentities($msg); ?>
                                                    </div>
                                                <?php } else if ($error) { ?>
                                                        <div class="alert alert-danger left-icon-alert" role="alert">
                                                            <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                                                        </div>
                                                <?php } ?>
                                                <table id="example" class="display table table-striped table-bordered"
                                                    cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>S.no</th>
                                                            <th>Student Name</th>
                                                            <th>Reg. No</th>
                                                            <th>Department</th>
                                                            <th>Failed Subject</th>
                                                            <th>Obtained Marks</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        // SQL query to fetch students with failed subjects
                                                        $sql = "SELECT tblstudents.StudentName, tblstudents.RollId, tblstudents.StudentId, tblclasses.ClassName, tblclasses.ClassNameNumeric, tblclasses.Section, tblsubjects.SubjectName, tblresult.Marks FROM tblresult JOIN tblstudents ON tblstudents.StudentId = tblresult.StudentId JOIN tblclasses ON tblclasses.id = tblresult.ClassId JOIN tblsubjects ON tblsubjects.id = tblresult.SubjectId WHERE tblresult.Marks < 35 ORDER BY tblstudents.StudentName, tblsubjects.SubjectName";
                                                        $query = $dbh->prepare($sql);
                                                        $query->execute();
                                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                        $cnt = 1;
                                                        if ($query->rowCount() > 0) {
                                                            foreach ($results as $result) {
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo htmlentities($cnt); ?></td>
                                                                    <td><?php echo htmlentities($result->StudentName); ?></td>
                                                                    <td><?php echo htmlentities($result->RollId); ?></td>
                                                                    <td><?php echo htmlentities($result->ClassName); ?>
                                                                        Year-<?php echo htmlentities($result->ClassNameNumeric); ?>
                                                                        Section-<?php echo htmlentities($result->Section); ?></td>
                                                                    <td><?php echo htmlentities($result->SubjectName); ?></td>
                                                                    <td><?php echo htmlentities($result->Marks); ?></td>
                                                                </tr>
                                                                <?php
                                                                $cnt++;
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
                        </section>
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