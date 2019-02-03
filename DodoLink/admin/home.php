<?php
session_start();

?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> Dashboard </title>
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/font-awesome.min.css" rel="stylesheet">
	<link href="../css/datepicker3.css" rel="stylesheet">
	<link href="../css/styles.css" rel="stylesheet">

	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
<style>

             body {
                background-image: url("../images/jobs.jpg");
                background-size: 100%;
                background-origin: content;
                background-repeat: no-repeat;
             }
  </style>
</head>
<body >




  <?php
  $activemenu = "home";
  include('../includes/amenu.php');
  ?>
<?php
  if(isset($_GET['referer'])){
  	if($_GET['referer'] == 'login')
  	{
   	 echo "Welcome " . $_SESSION['username'];
  	}//end if
  	if($_GET['referer'] == 'indexedit.php')
  	{
   	 echo "Please <a href='login.php'>login</a> first to complete a review";
  	}//end if
  }//end if(isset($_GET['referer']))
  ?>




</div>


</body>
</html>
