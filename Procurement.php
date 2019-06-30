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
    <a href="placeOrder.html" class="btn">Place Order</a>
    <a href="aitemd.html" class="btn">Add item</a>
    <a href="uitemd.html" class="btn">Update item</a>
    <a href="pHistoryd.html" class="btn">Purchase History</a>
    <a href="sHistoryd.html" class="btn">Sales History</a>
</div>
  <div class="table-responsive">          
  <table class="table">
    <thead>
      <tr>
        <th>Tanggal</th>
        <th>Raw Material</th>
        <th>Quantity</th>
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
      select * from procurement where pname='$user';
EOF;

      $ret = pg_query($db, $sql);
      if(!$ret) {
         echo pg_last_error($db);
      }
      
      while($row=pg_fetch_row($ret)){
         $tgl = $row[0];
         $material = $row[1];
         $quantity = $row[3];
?>  
   
      <tr>
         <td><?php echo $tgl; ?></td>
         <td><?php echo $material; ?></td>
         <td><?php echo $quantity;?></td>
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