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
        <title>Settings</title>
        <link rel="stylesheet" href="../css/mystyle.css">
        <link rel="stylesheet" href="../css/menu.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>

    <body>
        <?php
            $activemenu="";
            include('../includes/menu.php');
        ?>
        <div style="margin-left:15%;padding:1px 16px;height:1000px;">
            <?php
                require_once "../includes/db_connect.php";

                $userQuery="    SELECT  accounttype
                                FROM    login
                                WHERE   username='$user'";
                $userResult=$conn->query($userQuery);
                $usertype=$userResult->fetch();

                if ($usertype['accounttype'] == "normal"){

                    $infoQuery="    SELECT  user.othernames, user.lastname, user.dob, user.interest, education.degreename, education.major, education.university, education.startdate, education.enddate
                                    FROM    user, education
                                    WHERE   user.username=user.education
                                    AND     user.username='$user'";
                    $infoResult=$conn->query($infoQuery);
                    $row=$infoResult->fetch();
                    
                    $othernames=$row['othernames'];
                    $lastname=$row['lastname'];
                    $dob=$row['dob'];
                    $interest=$row['interest'];
                    $degreename=$row['degreename'];
                    $major=$row['major'];
                    $university=$row['university'];
                    $startdate=$row['startdate'];
                    $enddate=$row['enddate'];

                    if ($_SERVER["REQUEST_METHOD"] == "POST"){
                        if (isset($_POST['submit'])){
                            if ($_POST['submit'] == 'cancel'){
                                header("Location: profile.php");
                            }
                            if ($_POST['submit'] == 'reset'){
                                header("Location: settings.php");
                            }
                            if ($_POST['submit'] == 'save'){
                                $othernames=$_POST['othernames'];
                                $lastname=$_POST['lastname'];
                                $dob=$_POST['dob'];
                                $interest=$_POST['interest'];
                                $degreename=$_POST['degreename'];
                                $major=$_POST['major'];
                                $university=$_POST['university'];
                                $startdate=$_POST['startdate'];
                                $enddate=$_POST['enddate'];

                                $userUpdate = " UPDATE  user
                                                SET     othernames='$othernames', lastname='$lastname', dob='$dob', interest='$interest'
                                                WHERE   username='$user'";
    
                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $userResult=$conn->exec($userUpdate);

                                $eduUpdate = "  UPDATE  education
                                                SET     degreename='$degreename', major='$major', university='$university', startdate='$startdate', enddate='$enddate'
                                                WHERE   username='$user'";
    
                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $eduResult=$conn->exec($eduUpdate);

                                if ($userResult && $eduResult){
                                    header("Location: profile.php");
                                }
                            }
                        }
    
                    }

                    ?>
                        <form id="msform" method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
                            Last Name<input type="text" value="<?php echo $lastname;?>" id="lastname" name="lastname" placeholder="Last name"/><br/><br/>
                            Other Names<input type="text" value="<?php echo $othernames;?>" id="othernames" name="othernames" placeholder="Other names"/><br/><br/>
                            Date of birth<input type="date" value="<?php echo $dob;?>" id="birthday" name="dob">
                            Interest<input type="text" value="<?php echo $interest?>" id="interest" name="interest" placeholder="Interest"/><br/><br/>
                            Degree Name<input type="text" value="<?php echo $degreename;?>" id="degreename" name="degreename" placeholder="Degree Name"/><br/><br/>
                            Major<input type="text" value="<?php echo $degreename;?>" id="degreename" name="degreename" placeholder="Major"/><br/><br/>
                            University<input type="text" value="<?php echo $university;?>" id="university" name="university" placeholder="University"/><br/><br/>
                            Start Date<input type="date" value="<?php echo $startdate;?>" id="startdate" name="startdate">
                            End Date<input type="date" value="<?php echo $enddate;?>" id="enddate" name="enddate">
                            <button name="submit" type="submit" value="save">Save</button>
                            <button name="submit" type="submit" value="reset">Reset</button>
                            <button name="submit" type="submit" value="cancel">Cancel</button>
                        </form>
                    <?php
                }

            ?>
        </div>
    </body>
</html>
