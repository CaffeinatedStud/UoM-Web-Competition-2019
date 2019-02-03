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
        <title>Reported Contents</title>
        <link href="../css/bootstrap.min.css" rel="stylesheet">
      	<link href="../css/font-awesome.min.css" rel="stylesheet">
      	<link href="../css/datepicker3.css" rel="stylesheet">
      	<link href="../css/styles.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>

    <body>
      <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
          <ol class="breadcrumb">
            <li><a href="#">
              <em class="fa fa-bar-chart"></em>
            </a></li>
            <li class="active">Reported Contents</li>
          </ol>
        </div>
        <div class="row">
    			<div class="col-lg-12">
    				<h1 class="page-header">Reported Contents</h1>
    			</div>
    		</div>

      <!-- <h2 style = 'text-align: center'>Reported Contents</h2> -->

      <!-- <h3 style = 'margin-left: 390px'> User Report Reason</h3> -->
        <?php
            $activemenu="content";
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
            $cQuery =  "  SELECT  story.storyid, story.storyname, chapter.chaptername, chapter.flagreason
                          FROM    story, chapter
                          WHERE   chapter.flag = 1
                          AND     story.storyid = chapter.storyid";
            $cResult = $conn->query($cQuery);
            // echo '<ul style = "margin-left: 400px">';

            echo '<table><tr><th>Story Name</th><th>Chapter Name</th><th>Flag Reason</th><th></th></tr>';

            while ($row = $cResult->fetch()) {
            //  echo '<li>'. $row['user'].'   '.$row['reportreason'].' </li>';
            echo '<tr>';
            echo '<td>' . $row['storyname'] . '</td>';
            echo '<td>' . $row['chaptername'] . '</td>';
            echo '<td>' . $row['flagreason'] . '</td>';
            echo "<td>Click <a href='aviewcontent.php?storyid=" . $row['storyid'] . "' target=_blank >here </a> to view chapter</td>";
            echo '</tr>';
            }//end while

          //  echo '</table>';

          //  echo '</ul>';
        ?>

      </div>

        <script src="../js/jquery-1.11.1.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>

    </body>
</html>
