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
        <title>Reported Users</title>
        <link href="../css/bootstrap.min.css" rel="stylesheet">
      	<link href="../css/font-awesome.min.css" rel="stylesheet">
      	<link href="../css/datepicker3.css" rel="stylesheet">
      	<link href="../css/styles.css" rel="stylesheet">
        <link href="../css/table.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>

    <body>
      <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    		<div class="row">
    			<ol class="breadcrumb">
    				<li><a href="#">
    					<em class="fa fa-users"></em>
    				</a></li>
    				<li class="active">Reported Users</li>
    			</ol>
    		</div>
        <div class="row">
    			<div class="col-lg-12">
    				<h1 class="page-header">Reported Users</h1>
    			</div>
    		</div>

        <div class="panel panel-container">

      <!-- <h2 style = 'text-align: center'>Reported Users</h2> -->

      <!-- <h3 style = 'margin-left: 390px'> User Report Reason</h3> -->
        <?php
            $activemenu="user";
            include('../includes/amenu.php');
            require_once "../includes/db_connect.php";

            if (isset($_GET['action'])){
                $action=$_GET['action'];
                if (isset($_GET['profile'])){
                    $profile=$_GET['profile'];

                    if ($action == "ban"){
                        $aQuery = " UPDATE  user
                                    SET     ban = 1
                                    WHERE   user.username = '$profile'; ";
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $updateResult=$conn->exec($aQuery);
                    }
                  }
            }






            //Display list of flagged Users
            $uQuery =  "  SELECT  user, reportreason
                          FROM    block
                          WHERE   report = 1";
            $uResult = $conn->query($uQuery);
            // echo '<ul style = "margin-left: 3px">';

            echo '<div class="panel-heading">';
            echo '<table style = "margin-left: 25px; padding-bttom: 25px;"><tr><th>User</th><th>Report Reason</th><th></th></tr>';
            
            while ($row = $uResult->fetch()) {
            //  echo '<li>'. $row['user'].'   '.$row['reportreason'].' </li>';
            echo '<tr>';
            echo '<td>' . $row['user'] . '</td>';
            echo '<td>' . $row['reportreason'] . '</td>';
            echo "<td>Click <a href='aviewuser.php?profile=" . $row['user'] . "' target=_blank >here </a> to view user profile</td>";
            echo '</tr>';
            }//end while

          //  echo '</table>';

          //  echo '</ul>';
        ?>
        </div>

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
