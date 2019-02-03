<?php
    session_start();
?>

<html>
    <head>
        <title>Register</title>
        <link rel="stylesheet" href="../css/mystyle.css">
        <link rel="stylesheet" href="../css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <script>
            $(document).ready(function(){
                $("#error").hover(function(){
                    $("#iderror").fadeToggle();
                });
            });
        </script>
    </head>

    <body>

        <?php
            $email = $username = $password = $cpassword = "";
            $emailErr = $usernameErr = $passwordErr = $cpasswordErr = "";
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                require_once "../includes/db_connect.php";

                if (empty($_POST['email'])){
                    $emailErr="Email cannot be blank";
                }
                else{
                    $emailentered=$_POST['email'];
                    $emailcheck = " SELECT  *
                                    FROM    user
                                    WHERE   user.email='$emailentered'";
                    $emailResult = $conn->query($emailcheck);
                    $emailrows=$emailResult->rowCount();
                    if ($emailrows == 0){
                        $email = $_POST['email'];
                    }
                    else{
                        $emailErr="This account already exists.";
                    }
                }

                if (empty($_POST['username'])){
                    $usernameErr="Username cannot be blank";
                }
                else{
                    $usernameentered = $_POST['username'];
                    $usernamecheck = "  SELECT  *
                                        FROM    user
                                        WHERE   username='$usernameentered'";
                    $usernameResult = $conn->query($usernamecheck);
                    $usernamerows=$usernameResult->rowCount();
                    if ($usernamerows == 0){
                        $username=$_POST['username'];
                    }
                    else{
                        $usernameErr="This username is already taken";
                    }
                }

                if (empty($_POST['password'])){
                    $passwordErr="Password cannot be blank";
                }
                else{
                    if (empty($_POST['cpassword'])){
                        $cpasswordErr="Please confirm password";
                    }
                    else{
                        $pass=$_POST['password'];
                        $cpass=$_POST['cpassword'];
                        if ($pass!=$cpass){
                            $cpasswordErr="Password does not match. Try again";
                        }
                        else{
                            $password=$_POST['password'];
                        }
                    }
                }

                
                if ($emailErr == "" && $usernameErr == "" && $passwordErr == "" && $cpasswordErr == ""){
                    if (empty($_POST['company'])){
                        $loginInsert = "INSERT INTO login(username, password)
                                        VALUES      ('$username', '$password')";
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $loginResult = $conn->exec($loginInsert);

                        $userInsert="   INSERT INTO user(username, email)
                                        VALUES      ('$username', '$email')";
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $userResult=$conn->exec($userInsert);

                        $eduInsert="    INSERT INTO education(username)
                                        VALUES      ('$username')";
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $eduResult=$conn->exec($eduInsert);

                        if ($userResult && $eduResult){
                            $_SESSION['username'] = $username;
                            header("Location: usersetup.php");
                        }
                    }
                    else{
                        $loginInsert = "INSERT INTO login(username, password ,accounttype)
                                        VALUES      ('$username', '$password', 'company')";
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $loginResult = $conn->exec($loginInsert);

                        $companyInsert="    INSERT INTO company(companyname, email)
                                            VALUES      ('$username', '$email')";
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $companyResult=$conn->exec($companyInsert);
                        if ($companyResult){
                            $_SESSION['username'] = $username;
                            header("Location: companysetup.php");
                        }

                    }
                }
            }
        ?>

        <form id="msform" method="post" action="<?php echo $_SERVER["PHP_SELF"];?>" >
            <fieldset>
                <h2 class="fs-title">Account Setup</h2>
                <h3 class="fs-subtitle">Create an account</h3>
                <!-- <div class="input-container"> -->
                    <input type="text" value="<?php echo $email;?>" id="email" name="email" onblur="blurFunction('email')" placeholder="Email"  />
                    <!-- <i id="error" class="fa fa-exclamation-circle"></i>
                    <h4 id="iderror" style = "display: none;" >error</h4>
                </div> -->
                <span class="fs-subtitle"><?php echo $emailErr;?></span><br/><br/>
                <input type="text" value="<?php echo $username;?>" id="username" name="username" onblur="blurFunction('username')" placeholder="Username"/>
                <span class="fs-subtitle"><?php echo $usernameErr;?></span><br/><br/>
                <input type="password" id="password" name="password" onblur="blurFunction('password')" placeholder="Password"/>
                <span class="fs-subtitle"><?php echo $passwordErr;?></span><br/><br/>
                <input type="password" id="cpassword" name="cpassword" onblur="blurFunction('cpassword')" placeholder="Confirm Password" onfocus="focusFunction('cpassword')"/>
                <span class="fs-subtitle"><?php echo $cpasswordErr;?></span><br/>
                <input type="checkbox" name="company" value="company"> Company<br>
                <input type="submit" name="submit" class = "submit action-button" value="Submit"/>
                <p class="loginhere">
                    <a href="login.php" class="loginhere-link">Already have an account?</a>
                </p>
            </fieldset>
        </form>
        <script  src="../js/submit.js"></script>
        <script src="../js/validate.js"></script>
    </body>
</html>
