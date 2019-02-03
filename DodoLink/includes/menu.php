<?php
    if (isset($_POST['search'])){

        $input=$_POST['search'];
        header("Location: searchresults.php?input=$input");
    }
?>
<div class="topnav">
    <ul class="sidenav">
        <li><a href="home.php" <?php if ($activemenu=="home"){echo "class=\"active\"";} ?> style="font-size: 20px;font-weight: 500;">DodoLink</a></li>
        <li class="dropdown">
            <a href="javascript:void(0)"  <?php if ($activemenu=="discover"){echo "class=\"active\"";} ?>class="dropbtn">Discover</a>
            <div class="dropdown-content">
                <?php
                    require_once "db_connect.php";
                    $sectorQuery = "    SELECT  DISTINCT    sector
                                        FROM                company
                                        ORDER BY            sector";
                    $sectorResult=$conn->query($sectorQuery);
                    while($sectorRow=$sectorResult->fetch()){
                        echo '<a href="discover.php?category='.$sectorRow['sector'].'">'.$sectorRow['sector'].'</a>';
                    }
                ?>
            </div>
        </li>
        <li><a href="asks.php" <?php if ($activemenu=="create"){echo "class=\"active\"";} ?>>Asks</a></li>
        <div class="search">
            <form method="post">
                <input type="text" id="search" name="search" placeholder="Search">
                <input type="submit" value=">>">
            </form>
        </div>
        <li class="rdropdown">
            <a href="javascript:void(0)" class="dropbtn">Account</a>
            <div class="rdropdown-content">
                <a href="profile.php">Profile</a>
                <a href="logout.php">Logout</a>
            </div>
        </li>
    </ul>
</div>
