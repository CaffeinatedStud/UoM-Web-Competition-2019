<?php
session_start();

?>
<html>
<head>
	<meta charset="utf-8">

	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/font-awesome.min.css" rel="stylesheet">
	<link href="../css/datepicker3.css" rel="stylesheet">
	<link href="../css/styles.css" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->


<body>
  <?php
  $activemenu = "home";
  include('../includes/amenu.php');
  ?>
<div style='margin-left:20%;margin-top:3%'>
<?php

  require_once "../includes/db_connect.php";

    $query="SELECT * FROM post WHERE reportcount>=10";

    $Result=$conn->query($query);

    while($result=$Result->fetch(PDO::FETCH_ASSOC))
    {


?>
		<?php echo 'This Comment was reported '. $result['reportcount'] .'times' ?>
		</br>
		<?php echo '     '.$result['username'] ?>
		</br>
		<?php echo '     '.$result['category'] ?>
		</br>
      	<?php echo '     '.$result['posttext'] ?>
		</br>
      	<?php echo '     '.$result['dateposted'] ?>
		</br>



<?php
  }
?>
</div>
<script src="../js/jquery-1.11.1.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
</body>
</html>
