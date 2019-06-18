<?php
   $host        = "host = ec2-54-227-250-33.compute-1.amazonaws.com";
   $port        = "port = 5432";
   $dbname      = "dbname = dfh1ffcplg2486";
   $credentials = "user = eacvhyhfmkrufp password=09ed8a0efcefee49aecd377a6e0a69cbfa41939219c9a9747eb0324c7d616d24";
   session_start();
   $db = pg_connect( "$host $port $dbname $credentials"  );
   if(!$db) {
      echo "Error : Unable to open database\n";
   }


   if(isset($_POST['submit'])){

      $tgl = date('d-m-Y H:i:s');
      $raw = $_POST['raw_material'];
      $cost = $_POST['cost'];
      $avail = $_POST['Availability'];
      $user = $_SESSION['userName'];

      

      $sql =<<<EOF
      set search_path to sco;
      insert into supplier values ('$user','$raw','$cost','$avail','$tgl');
EOF;
      
      $ret = pg_query($db, $sql);
      if(!$ret) {
         echo pg_last_error($db);
      }
      
      pg_close($db);

      echo "<script>location='Supplier.php'</script>";
      exit;
      }
   
?>