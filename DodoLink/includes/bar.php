

<?php
    if(isset($_POST))
    {
      $data =array();
      $sent=array();
       require_once 'db_connect.php';
       $select='SELECT interest,COUNT(DISTINCT username) as numUser
                FROM user
                GROUP BY interest';
                $selectq='SELECT COUNT(*) as TOTAL
                         FROM user';

      $select=$conn->query($select);
      $selectq=$conn->query($selectq);
      $tot=$selectq->fetch();

      while($row=$select->fetch(PDO::FETCH_ASSOC))
      {
        $data['y']=($row['numUser']/$tot['TOTAL'])*100;
        $data['label']= $data['y'].'%';
        $data['indexLabel']= $row['interest'];

        $sent[]=$data;
      }
      //print_r($sent);
      echo json_encode($sent);


    }
?>
