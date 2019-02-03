<!DOCTYPE html>
<?php
    session_start();

    if (!isset($_SESSION['username'])){
        header("Location: login.php");
    }
    else{
        $user=$_SESSION['username'];
    }
?>

<html>
    <head>
        <title>Home</title>
        <link rel="stylesheet" href="../css/mystyle.css">
        <link rel="stylesheet" href="../css/menu.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="http://code.jquery.com/jquery-1.10.1.min.js" ></script>
        
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>

    <body>
        <?php
            $activemenu="home";
            include('../includes/menu.php');
            require_once "../includes/db_connect.php";

            if (isset($_GET['action'])){
                if (action == "report"){
                    $postid=$_GET['postid'];

                    $reportQuery="  SELECT  reportcount
                                    FROM    post
                                    WHERE   postid=$postid";
                    $reportResult=$conn->query($reportQuery);
                    $reportcount=$reportResult->fetch();
                    $reportcount=$reportcount+1;

                    $reportUpdate=" UPDATE  post
                                    SET     reportcount=$reportcount
                                    WHERE   postid=$postid";
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $reportResult=$conn->exec($reportUpdate);
                }
            }
            $query = $queryError = "";
            $category = $categoryError = "";
            if ($_SERVER["REQUEST_METHOD"] == "POST"){
                if (empty($_POST['query'])){
                    $queryError = "You cannot submit an empty query";
                }
                else{
                    $query=$_POST['query'];
                }

                $dateposted=date("Y/m/d");

                if (empty($_POST['category'])){
                    $categoryError="A category must be specified";
                }
                else{
                    $category=$_POST['category'];
                }

                
                if ($queryError == "" && $categoryError == ""){
                    $postInsert="   INSERT INTO post(posttext, dateposted, category, username)
                                    VALUES      ('$query', '$dateposted', '$category', '$user')";
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $postResult=$conn->exec($postInsert);

                    if ($postResult){
                        header("Location: home.php");
                    }
                }
            }
        ?>

        <h2>Post a query</h2>
        <form id="msform" method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
            <textarea rows="7" cols="30" name="query" id="query" placeholder="Query"><?php echo $query;?></textarea><br/><br/>
            <span class="fs-subtitle"><?php echo $queryError;?></span><br/><br/>
            <h5>Choose a category</h5>
            <select name="category" id="category">
                <option value="" selected>Pick a category</option>
                <option value="IT" <?php if ($category=="IT"){echo 'selected';}?> >IT</option>
                <option value="Finance" <?php if ($category=="Finance"){echo 'selected';}?> >Finance</option>
                <option value="Accounts" <?php if ($category=="Accounts"){echo 'selected';}?> >Accounts</option>
                <option value="Human Resource" <?php if ($category=="Human Resource"){echo 'selected';}?> >Human Resource</option>
                <option value="Engineering" <?php if ($category=="Engineering"){echo 'selected';}?> >Engineering</option>
                <option value="Oceanic Study"> <?php if ($category=="Oceanic Study"){echo 'selected';}?> Oceanic Study</option>
            </select>
            <br/>
            <span class="fs-subtitle"><?php echo $categoryError;?></span><br/><br/>
            <input type="submit" value="Post">
        </form>

        <h2>User Queries</h2>

        <?php
            $postQuery="    SELECT      post.postid, post.posttext, post.dateposted, post.category, post.username
                            FROM        post, user
                            WHERE       post.category=user.interest
                            AND         user.username='$user'
                            ORDER BY    post.dateposted  DESC
                            LIMIT       5";
            $postResult=$conn->query($postQuery);
            while ($postRow=$postResult->fetch()){
                echo '  <div class="w3-row">
                            <div class="w3-col l8 s12">
                                <div class="w3-card-4 w3-margin w3-white">
                                    <div class="w3-container">
                                    <h3><b>'.$postRow['category'].'</b></h3>
                                        <h5>'.$postRow['username'].', <span class="w3-opacity">'.$postRow['dateposted'].'</span></h5>
                                    </div>
                                    <div class="w3-container">
                                        <p>'.$postRow['posttext'].'</p>
                                        <div class="w3-row">
                                            <div class="w3-col m4 w3-hide-small">
                                                <p><span class="w3-padding-large w3-right"><a href="https://www.google.com/gmail/">Contact</a></span></p>
                                            </div>
                                            <div class="w3-col m4 w3-hide-small">
                                                <p><span class="w3-padding-large w3-right"><a href="home.php?action=report&postid='.$postRow['postid'].'">Report</a></span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>
                ';
            }
        ?>
        <h2>Vacancies</h2>

        <?php
            $postQuery="    SELECT      vacancies.companyname, vacancies.targetqualification, vacancies.sector, vacancies.vacancydescription
                            FROM        vacancies, education
                            WHERE       vacancies.targetqualification=education.degreename
                            AND         education.username='$user'
                            LIMIT       5";
            $postResult=$conn->query($postQuery);
            while ($postRow=$postResult->fetch()){
                echo '  <div class="w3-row">
                            <div class="w3-col l8 s12">
                                <div class="w3-card-4 w3-margin w3-white">
                                    <div class="w3-container">
                                    <h3><b>'.$postRow['companyname'].'</b></h3>
                                        <h5>'.$postRow['targetqualification'].', <span class="w3-opacity">'.$postRow['sector'].'</span></h5>
                                    </div>
                                    <div class="w3-container">
                                        <p>'.$postRow['vacancydescription'].'</p>
                                        <div class="w3-row">
                                            <div class="w3-col m4 w3-hide-small">
                                                <p><span class="w3-padding-large w3-right"><a href="https://www.google.com/gmail/">Contact</a></span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>
                ';
            }
        ?>
    </body>
</html>