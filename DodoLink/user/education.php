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
        <title>Setup</title>
        <link rel="stylesheet" href="../css/mystyle.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>

    <body>

        <?php
            $degreename = $major = $university = $startdate = $enddate = "";
            if ($_SERVER["REQUEST_METHOD"] == "POST"){
                $degreename = $_POST['degreename'];
                $major=$_POST['major'];
                $university=$_POST['university'];
                $startdate=$_POST['startdate'];
                $enddate=$_POST['enddate'];
                
                require_once "../includes/db_connect.php";

                $uUpdate = "UPDATE  education
                            SET     degreename='$degreename', major='$major', university='$university', startdate='$startdate', enddate='$enddate'
                            WHERE   username='$user'";
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $uResult=$conn->exec($uUpdate);
                if ($uUpdate){
                    header("Location: home.php");
                }
            }
        ?>

        <form id="msform" method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
            <fieldset>
                <h2 class="fs-title">Education Details</h2>
                <h3 class="fs-subtitle">Almost done</h3>
                <input type="text" id="degreename" name="degreename" placeholder="Degree Name"/><br/><br/>
                <input type="text" id="major" name="major" placeholder="Major"/><br/><br/>
                <input type="text" id="university" name="university" placeholder="University" />
                <input type="date" id="startdate" name="Start Date">
                <input type="date" id="enddate" name="End Date">
                <input type="submit" name="submit" class = "submit action-button" value="Submit" />
            </fieldset>
        </form>
    </body>
</head>