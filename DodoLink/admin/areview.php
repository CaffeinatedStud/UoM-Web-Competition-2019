<?php
    session_start();

    if (!isset($_SESSION['username'])){
        header("Location: alogin.php");
    }
    else{
        $admin=$_SESSION['username'];
    }
?>

<html>
    <head>
        <title>Reported Reviews</title>
        <link href="../css/bootstrap.min.css" rel="stylesheet">
      	<link href="../css/font-awesome.min.css" rel="stylesheet">
      	<link href="../css/datepicker3.css" rel="stylesheet">
      	<link href="../css/styles.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>

    <body>

        <?php
            $activemenu = "review";
            include('../includes/amenu.php');
            require_once "../includes/db_connect.php";
        ?>

        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
      		<div class="row">
      			<ol class="breadcrumb">
      				<li><a href="#">
      					<em class="fa fa-comments-o"></em>
      				</a></li>
      				<li class="active">Reported Comments</li>
      			</ol>
      		</div>
          <div class="row">
            <div class="col-lg-12">
              <h1 class="page-header">Reported Comments</h1>
            </div>
          </div>
        </div>


        <script src="../js/jquery-1.11.1.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
    </body>
</html>
