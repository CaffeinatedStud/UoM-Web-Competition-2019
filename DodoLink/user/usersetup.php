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
            $lastname = $othernames = $dob = $course = $interest = "";
            if ($_SERVER["REQUEST_METHOD"] == "POST"){
                $lastname = $_POST['lastname'];
                $othernames=$_POST['othernames'];
                $dob=$_POST['dob'];
                $interest=$_POST['interest'];

                require_once "../includes/db_connect.php";

                $uUpdate = "UPDATE  user
                            SET     othernames='$othernames', lastname='$lastname', dob='$dob', interest='$interest'
                            WHERE   username='$user'";
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $uResult=$conn->exec($uUpdate);
                if ($uUpdate){
                    header("Location: education.php");
                }
            }
        ?>

        <form id="msform" method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
            <fieldset>
                <h2 class="fs-title">Personal Information</h2>
                <h3 class="fs-subtitle">Set up your profile</h3>
                <input type="text" value="<?php echo $lastname;?>" id="lastname" name="lastname" placeholder="Last Name"/><br/><br/>
                <input type="text" value="<?php echo $othernames;?>" id="othernames" name="othernames" placeholder="Other Names"/><br/><br/>
                <input type="date" id="birthday" name="dob">
                <input type="text" id="interest" name="interest" placeholder="Interest" />
                <input type="submit" name="submit" class = "submit action-button" value="Submit" />
            </fieldset>
        </form>
    </body>
</head>