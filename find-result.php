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
    <title>SRMS | Find Results</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" media="screen">
    <link rel="stylesheet" href="css/font-awesome.min.css" media="screen">
    <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen">
    <link rel="stylesheet" href="css/icheck/skins/flat/blue.css">
    <link rel="stylesheet" href="css/main.css" media="screen">
    <script src="js/modernizr/modernizr.min.js"></script>
</head>
<body class="">
    <div class="main-wrapper">
        <div class="login-bg-color bg-black-300">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="panel login-box">
                        <div class="panel-heading">
                            <div class="panel-title text-center">
                                <h4>Student Result Management System</h4>
                            </div>
                        </div>
                        <div class="panel-body p-20">
                            <form action="result.php" method="post">
                                <div class="form-group">
                                    <label for="rollid">Enter your register number:</label>
                                    <input type="text" class="form-control" id="rollid" placeholder="Enter Your Roll Id" autocomplete="off" name="rollid" required>
                                </div>
                                <div class="form-group">
                                    <label for="default" class="control-label">Department: </label>
                                    <select name="class" class="form-control" id="default" required>
                                        <option value="">Select Department</option>
                                        <?php
                                        $sql = "SELECT * FROM tblclasses";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $result) {
                                                echo '<option value="' . htmlentities($result->id) . '">' . htmlentities($result->ClassName) . ' Year-' . htmlentities($result->ClassNameNumeric) . ' Section-' . htmlentities($result->Section) . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group mt-20">
                                    <button type="submit" class="btn btn-success btn-labeled pull-right">Search<span class="btn-label btn-label-right"><i class="fa fa-check"></i></span></button>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="col-sm-6">
                                    <a href="index.php">Back to Home</a>
                                </div>
                            </form>
                            <hr>
                        </div>
                    </div>
                    <p class="text-muted text-center"><small>Student Result Management System</small></p>
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
    <script>
        $(function(){
            $('input.flat-blue-style').iCheck({
                checkboxClass: 'icheckbox_flat-blue'
            });
        });
    </script>

    <!-- Footer -->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">&#169; <?php echo date("Y"); ?> All rights reserved to the University</p>
        </div>
    </footer>
</body>
</html>

