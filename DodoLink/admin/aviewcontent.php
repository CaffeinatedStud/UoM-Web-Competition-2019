<?php
    session_start();

    if (!isset($_SESSION['username'])){
        header("Location: alogin.php");
    }
    else{
        $admin=$_SESSION['username'];
    }
?>

<html>
    <head>
        <title>View Content</title>
        <link href="../css/bootstrap.min.css" rel="stylesheet">
      	<link href="../css/font-awesome.min.css" rel="stylesheet">
      	<link href="../css/datepicker3.css" rel="stylesheet">
      	<link href="../css/styles.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>

    <body>
        <?php

            $activemenu = "content";
            include('../includes/amenu.php');
            require_once "../includes/db_connect.php";
        ?>

<!-- ************************************************************************************************* -->
        <title></title>
        <link rel="stylesheet" href="../css/mystyle.css">

        <link rel="stylesheet" href="../css/story.css">
        <link rel="stylesheet" href="../css/reader.css">

        <script src="http://code.jquery.com/jquery-1.10.1.min.js" ></script>
        <script>
        $(document).ready(function(){
            $("form").on('submit',function(event){
            event.preventDefault();
                data = $(this).serialize();

                $.ajax({
                type: "POST",
                url: "action.php",
                data: data
                }).done(function( msg ) {
                alert( msg );
                document.getElementById("add").value="Bookmarked";
                });
            });
        });
        </script>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">


    </head>

    <body>
        <?php
            require_once "../includes/db_connect.php";

            $storyid=$_GET['storyid'];

            if (isset($_GET['chapterno'])){
                $chapterno=$_GET['chapterno'];
            }
            else{
                $bookmarkQuery="    SELECT  chapterno
                                    FROM    bookmark
                                    WHERE   username='$user'
                                    AND     storyid=$storyid";
                $bookmarkResult=$conn->query($bookmarkQuery);
                $bookmark=$bookmarkResult->fetch();
                $rowCount=$bookmarkResult->rowCount();
                if ($rowCount == 0){
                    $chapterno=1;
                }
                else{
                    $chapterno=$bookmark['chapterno'];
                }
            }

            if (isset($_GET['action'])){
                if ($_GET['action'] == "add"){
                    $storyQuery="   SELECT  *
                                    FROM    myreads
                                    WHERE   storyid=$storyid
                                    AND     username='$user'";
                    $queryResult=$conn->query($storyQuery);
                    $rowCount=$queryResult->rowCount();
                    if ($rowCount == 0){
                        $storyInsert="  INSERT INTO myreads(storyid,username, currentreads)
                                        VALUES      ($storyid, '$user', 1)";
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $insertResult=$conn->exec($storyInsert);
                    }
                    else{
                        $storyUpdate="  UPDATE  myreads
                                        SET     archive=0, currentreads=1, readinglist=0";
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $updateResult=$conn->exec($storyUpdate);
                    }
                }

                if ($_GET['action'] == "review"){
                    $username=$user;
                    $chapterno=$_GET['chapterno'];
                    $storyid=$_GET['storyid'];
                    $commentdate=date("Y/m/d");

                    if (empty($_POST['comment'])){
                        $commenttext="";
                    }
                    else{
                        $commenttext=$_POST['comment'];
                    }

                    if (empty($_POST['rating'])){
                        $rating=0;
                    }
                    else{
                        $rating=$_POST['rating'];
                    }

                    $commentInsert="    INSERT INTO review(username, storyid, chapterno, commenttext, commentdate, rating)
                                        VALUES      ('$user', $storyid, $chapterno, '$commenttext', '$commentdate', $rating)";
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $commentResult=$conn->exec($commentInsert);
                }

                if ($_GET['action'] == "publish"){
                    $publishUpdate="    UPDATE  chapter
                                        SET     published=1
                                        WHERE   chapterno=$chapterno
                                        AND     storyid=$storyid";
                    $publishResult=$conn->exec($publishUpdate);
                }

                if ($_GET['action'] == "delete"){
                    $deleteChapter="    DELETE
                                        FROM    chapter
                                        WHERE   chapterno=$chapterno
                                        AND     storyid=$storyid";
                    $deleteResult=$conn->exec($deleteChapter);
                    if($deleteResult){
                        header("Location:profile.php");
                    }
                }

                if ($_GET['action'] == "deletecomment"){
                    $reviewid=$_GET['review'];
                    $deleteReview=" DELETE
                                    FROM    review
                                    WHERE   reviewid=$reviewid";
                    $deleteResult=$conn->exec($deleteReview);
                }

                if ($_GET['action'] == "flag"){
                    $reviewid=$_GET['review'];
                    $flagReview="   UPDATE  review
                                    SET     flag=1
                                    WHERE   reviewid=$reviewid";
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $flagResult=$conn->exec($flagReview);
                }

            }

            $storydetailQuery="     SELECT  storyname, author
                                    FROM    story
                                    WHERE   storyid=$storyid";
            $storydetailResult=$conn->query($storydetailQuery);
            $detail=$storydetailResult->fetch();

            $author=$detail['author'];
            if ($author == $user){
                $chapterQuery=" SELECT  chapterno, chaptername
                                FROM    chapter
                                WHERE   storyid=$storyid";
            }
            else{
                $chapterQuery=" SELECT  chapterno, chaptername
                                FROM    chapter
                                WHERE   storyid=$storyid
                                AND     published=1";
            }
            $chapterResults=$conn->query($chapterQuery);
            $chapterRows=$chapterResults->rowCount();

            $storyQuery="   SELECT  story, chaptername, flag
                            FROM    chapter
                            WHERE   chapterno=$chapterno
                            AND     storyid=$storyid";
            $storyResult=$conn->query($storyQuery);
            $story=$storyResult->fetch();

            $pchaptQuery="  SELECT  MAX(chapterno) AS chapterno
                            FROM    chapter
                            WHERE   storyid=$storyid
                            AND     chapterno<$chapterno";
            $pqueryResult=$conn->query($pchaptQuery);
            $pchaptRow=$pqueryResult->fetch();
            $pchapt=$pchaptRow['chapterno'];
            $prevRow=$pqueryResult->rowCount();

            $nchaptQuery="  SELECT  MIN(chapterno) AS chapterno
                            FROM    chapter
                            WHERE   storyid=$storyid
                            AND     chapterno>$chapterno";
            $nqueryResult=$conn->query($nchaptQuery);
            $nchaptRow=$nqueryResult->fetch();
            $nchapt=$nchaptRow['chapterno'];
            $nextRow=$nqueryResult->rowCount();

            if ($chapterRows == 0){
                echo '<h4>No chapters yet</h4>';
            }
            else{
                echo '  <div class="topnav">
                            <ul class="profilesidenav">
                                <li class="dropdown">
                                    <a href="javascript:void(0)" class="dropbtn">'.$detail['storyname'].'</a>
                                    <div class="dropdown-content">
                ';
                                        while ($row=$chapterResults->fetch()) {
                                            echo '<a href="reader.php?storyid='.$storyid.'&chapterno='.$row["chapterno"].'">'.$row["chaptername"].'</a>';
                                        }
                echo'               </div>
                                </li>
                            </ul>
                        </div>

                        <h1>'.$story['chaptername'].'</h1>';

                echo'       <br/>
                            <div class="aread">
                ';
                            // if ($story['flag'] == 1){
                            //     echo 'This chapter has been flagged.';
                            // }else{
                                echo $story['story'];

                echo'       </div>';
                            if ($prevRow != 0){
                                echo '  <div class="rbuttonlink" style = " margin-left: 400px">
                                            <a href="aviewcontent.php?storyid='.$storyid.'&chapterno='.$pchapt.'">Previous</a>
                                        </div>
                                ';
                            }
                            if ($nextRow != 0){
                                echo '  <div class="rbuttonlink" style = " margin-left: 400px">
                                            <a href="aviewcontent.php?storyid='.$storyid.'&chapterno='.$nchapt.'">Next</a>
                                        </div>
                                ';
                            }

                        
                    echo'   <div class="review">
                                <h1>Reviews</h1>
                            </div>
                    ';
                $commentQuery=" SELECT  reviewid, username, commenttext, commentdate
                                FROM    review
                                WHERE   storyid=$storyid
                                AND     chapterno=$chapterno
                                AND     flag=0";
                $commentResult=$conn->query($commentQuery);
                while($row=$commentResult->fetch()){
                    echo'   <div class="comment">
                                <div class="user">
                                    <a href="profile.php?profile='.$row['username'].'">'.$row['username'].'</a>
                                </div>
                                <div class="commenttext">
                                    '.$row['commenttext'].'
                                </div>
                                <div class="date">
                                    '.$row['commentdate'].'
                                </div>
                    ';          if ($row['username'] == $user){
                                    echo '<a href="reader.php?storyid='.$storyid.'&chapterno='.$chapterno.'&action=deletecomment&review='.$row['reviewid'].'">Delete comment</a>';
                                }
                                else{
                                    echo '<a href="reader.php?storyid='.$storyid.'&chapterno='.$chapterno.'&action=flag&review='.$row['reviewid'].'">Flag comment</a>';
                                }
                    echo    '</div>';
                    }
        }
            ?>
    <!-- ************************************************************************************************************** -->
        <script src="../js/jquery-1.11.1.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
    </body>
</html>
