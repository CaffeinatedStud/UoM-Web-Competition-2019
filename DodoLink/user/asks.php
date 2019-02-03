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

            if (isset($_GET['category'])){
                $category=$_GET['category'];
            }
        ?>

        <h2>Queries</h2>

        <?php
            $postQuery="    SELECT      post.posttext, post.dateposted, post.category, post.username, user.interest
                            FROM        post, user
                            WHERE       post.reportcount<10
                            AND         post.username=user.username
                            AND         user.username='$user'
                            AND         post.category=user.interest
                            ORDER BY    post.dateposted  DESC";
            $postResult=$conn->query($postQuery);
            while ($postRow=$postResult->fetch()){
            echo '  <div class="w3-row">
                        <div class="w3-col l8 s12">
                            <div class="w3-card-4 w3-margin w3-white">
                                <div class="w3-container">
                                <h3><b>'.$postRow['interest'].'</b></h3>
                                    <h5>'.$postRow['username'].', <span class="w3-opacity">'.$postRow['dateposted'].'</span></h5>
                                </div>
                                <div class="w3-container">
                                    <p>'.$postRow['posttext'].'</p>
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