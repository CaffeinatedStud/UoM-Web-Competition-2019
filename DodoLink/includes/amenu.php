<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span></button>
      <a class="navbar-brand" href="#">DODOLINK</a>
        </li>
      </ul>
    </div>
  </div><!-- /.container-fluid -->
</nav>
<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">

  <div class="divider"></div>

  <ul class="nav menu">
   <ul>
    <li><a href="home.php" 
         <?php 
	  	  if ($activemenu=="home")	
		echo "class=\"active\"";
	  ?>
	><em class="fa fa-dashboard">&nbsp;</em>Home</a></li>
    
    <li><a href="report.php"
    
	<?php 
	  if ($activemenu=="report")	
		echo "class=\"active\"";
	  ?>
    ><em class="fa fa-navicon">&nbsp;</em>Manage Report</a></li>
    </a></li>
     <li><a href="notification.php"
    
	<?php 
	  if ($activemenu=="notification")	
		echo "class=\"active\"";
	  ?>
    ><em class="fa fa-navicon">&nbsp;</em>Notification</a></li>
    </a></li>
    
    <li><a href="alogout.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
  </ul>
</div><!--/.sidebar-->

