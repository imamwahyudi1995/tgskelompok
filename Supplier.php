<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/supply.css">
</head>
<body class="supplier">

<div class="container">
<?php 
  session_start(); 
  if($_SESSION['userName']==true){
    $user = $_SESSION['userName']; 
  }
?>
<h2><?php echo $user; ?>'s Table</h2> 
<div class="red1">
  <a href="logout.php" class="btn">Logout</a>
</div>
<div class="sup">
    <a href="sHistorys.html" class="btn">Order History</a>
    <a href="update.html" class="btn">Update</a>
    <a href="delete.html" class="btn">Delete</a>
    <a href="newSupply.html" class="btn">Add New</a>
</div>
  <div class="table-responsive">          
  <table class="table">
    <thead>
      <tr>
        <th>Raw Material</th>
        <th>Cost Per Ton</th>
        <th>Availability</th>
      </tr>

<?php
   $host        = "host = ec2-54-227-250-33.compute-1.amazonaws.com";
   $port        = "port = 5432";
   $dbname      = "dbname = dfh1ffcplg2486";
   $credentials = "user = eacvhyhfmkrufp password=09ed8a0efcefee49aecd377a6e0a69cbfa41939219c9a9747eb0324c7d616d24";

   $db = pg_connect( "$host $port $dbname $credentials"  );
   if(!$db) {
      echo "Error : Unable to open database\n";
   }


      $sql =<<<EOF
      set search_path to sco;
      select * from supplier where suppliername='$user';
EOF;

      $ret = pg_query($db, $sql);
      if(!$ret) {
         echo pg_last_error($db);
      }
      
      while($row=pg_fetch_row($ret)){
         $raw_material = $row[1];
         $cpt = $row[2];
         $ava = $row[3];
?>  
   
      <tr>
         <td><?php echo $raw_material; ?></td>
         <td><?php echo $cpt; ?></td>
         <td><?php echo $ava;?></td>
      </tr>

<?php       
      }          
      pg_close($db);
      exit;
   
?>
  </thead>
  </table>

  </div>

</div>
</body>
</html>
