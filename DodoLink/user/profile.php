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
        <title>Profile</title>
        <link rel="stylesheet" href="../css/mystyle.css">
        <link rel="stylesheet" href="../css/menu.css">
        <link rel="stylesheet" href="../css/story.css">
        <link rel="stylesheet" href="../css/profile.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="http://code.jquery.com/jquery-1.10.1.min.js" ></script>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>

    <body>
        <?php
            $activemenu="";
            include('../includes/menu.php');

            require_once "../includes/db_connect.php";

            if (isset($_GET['profile'])){
                $profile=$_GET['profile'];
            }
            else{
                $profile=$user;
            }

            $aQuery="       SELECT  accounttype
                            FROM    login
                            WHERE   username= '$profile'";
            $aResult=$conn->query($aQuery);
            $aRow=$aResult->fetch();
            if ($aRow['accounttype']== 'normal'){
                $userQuery="    SELECT  lastname, othernames, description, dob, email
                                FROM    user
                                WHERE   username= '$profile'";
                $userResult=$conn->query($userQuery);
                $userRow=$userResult->fetch();
                echo '<h1>'.$userRow['lastname'].' '.$userRow['othernames'].'</h1>';
                echo '<p>'.$userRow['description'].'</p>';
                echo '<h3>'.$userRow['dob'].'</h3>';
                echo '<h3>'.$userRow['email'].'</h3>';
                echo '<hr style = "padding-bottom: 50px;">';

                $eQuery="       SELECT  *
                                FROM    education
                                WHERE   username= '$profile'";
                $eResult=$conn->query($eQuery);
                $eRow=$eResult->fetch();

                echo '<h1>Education</h1>';
                echo '<h3>'.$eRow['degreename'].'</h3>';
                echo '<h3>'.$eRow['university'].'</h3>';
                echo '<hr style = "padding-bottom: 50px;">';
                $postQuery="    SELECT      post.posttext, post.dateposted, post.category, post.username, user.interest
                                FROM        post, user
                                WHERE       post.reportcount<10
                                AND         post.username=user.username
                                AND         post.username='$profile'
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
            } else{
                $cQuery="       SELECT  *
                                FROM    company
                                WHERE   companyname = '$profile'";
                $cResult=$conn->query($cQuery);
                $cRow=$cResult->fetch();
                echo '<h1>'.$cRow['companyname'].'</h1>';
                // echo '<p>'.$userRow['description'].'</p>';
                echo '<h3>'.$cRow['sector'].'</h3>';
                echo '<h3>'.$cRow['establishmentdate'].'</h3>';
                echo '<h3>'.$cRow['websiteurl'].'</h3>';
                echo '<hr style = "padding-bottom: 50px;">';
            }




        ?>
    </body>
</html>