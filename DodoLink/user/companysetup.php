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
            $companyname=$sector=$edate=$url=$location="";
            if ($_SERVER["REQUEST_METHOD"] == "POST"){
                $sector=$_POST['sector'];
                $edate=$_POST['edate'];
                $url=$_POST['url'];
                $location=$_POST['location'];

                require_once "../includes/db_connect.php";

                $uUpdate = "UPDATE  company
                            SET     sector='$sector', establishmentdate='$edate', websiteurl='$url', location='$location'
                            WHERE   companyname='$user'";
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $uResult=$conn->exec($uUpdate);
                if ($uUpdate){
                    header("Location: home.php");
                }
            }
        ?>

        <form id="msform" method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
            <fieldset>
                <h2 class="fs-title">Company Details</h2>
                <h3 class="fs-subtitle">Almost done</h3>
                <input type="text" id="sector" name="sector" placeholder="Sector"/><br/><br/>
                <input type="date" id="edate" name="Establishment Date">
                <input type="text" id="url" name="url" placeholder="URL" />
                <input type="text" id="location" name="location" placeholder="Location" />
                <input type="submit" name="submit" class = "submit action-button" value="Submit" />
            </fieldset>
        </form>
    </body>
</head>