

<?php
    if(isset($_POST))
    {
      $data =array();
      $sent=array();
       require_once 'db_connect.php';
       $select='SELECT u.sector as sector,COUNT(DISTINCT username) as numUser
                FROM user u ,company c
                WHERE u.sector=c.sector
                GROUP BY u.sector';
      $select=$conn->query($select);
      while($row=$select->fetch(PDO::FETCH_ASSOC))
      {
        $data['label']= $row['sector'];
        $data['y']=$row['numUser'];

        $sent[]=$data;
      }
      //print_r($sent);
      echo json_encode($sent);


    }
?>
