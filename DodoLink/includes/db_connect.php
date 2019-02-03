<?php
    $server_name = "localhost";
    $user_name = "root";
    $dpassword = "";
    $db_name = "dodolink";

    try{
        $conn = new PDO("mysql:host=$server_name;dbname=$db_name", $user_name, $dpassword);
    }
    catch(PDOException $e){
        echo $sql . "<br>" . $e->getMessage();
    }
?>
