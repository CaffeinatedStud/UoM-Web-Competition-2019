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
        <title>User Details</title>
        <link href="../css/bootstrap.min.css" rel="stylesheet">
      	<link href="../css/font-awesome.min.css" rel="stylesheet">
      	<link href="../css/datepicker3.css" rel="stylesheet">
      	<link href="../css/styles.css" rel="stylesheet">
        <link href="../css/profile.css" rel="stylesheet">
        <link href="../css/aviewprofilestyle.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    </head>

    <body>
        <?php
            $activemenu="user";
            include('../includes/amenu.php');
            require_once "../includes/db_connect.php";

            if (isset($_GET['profile'])){
                $profile=$_GET['profile'];
                echo '<div style = "margin-left: 350px; ">
                        Do you want to ban this user?
                        <a href = "auser.php?action=ban&profile='.$profile.'">Yes</a>
                        <a href = "auser.php?action=notban&profile='.$profile.'"> No</a>
                      </div>';
            }




            include('../includes/aprofileheader.php');


        ?>
        <!-- code to display profile -->
        <div style="margin-left:15%;padding:1px 16px;height:1000px;">

        </div>
        <script src="../js/jquery-1.11.1.min.js"></script>
      	<script src="../js/bootstrap.min.js"></script>
      	<script src="../js/chart.min.js"></script>
      	<script src="../js/chart-data.js"></script>
      	<script src="../js/easypiechart.js"></script>
      	<script src="../js/easypiechart-data.js"></script>
      	<script src="../js/bootstrap-datepicker.js"></script>
      	<script src="../js/custom.js"></script>
    </body>
</html>
