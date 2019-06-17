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

      $product = $_POST['product'];
      $quantity=$_POST['quantity'];
      $user = $_SESSION['userName'];

      

      $sql =<<<EOF
      set search_path to sco;
      select * from  manufacturer where mname='$user' and product='$product';
EOF;
      
      $ret = pg_query($db, $sql);
      
      while($row=pg_fetch_row($ret)){
         $sql =<<<EOF
         select * from  order_m where uname='$user' and product='$row[2]';
EOF;
         $r = pg_query($db, $sql);
         $req=$quantity*$row[3];

         if(pg_num_rows($r)==0){
            $que =<<<EOF
            insert into order_m values ('$user','$row[2]','$req');
EOF;
            pg_query($db, $que);
            
         }
         else{
          
            pg_query($db, "update order_m set quantity=quantity+'$req' where uname='$user' and product='$row[2]'");

         }
      }

      
      pg_close($db);
      
      echo "<script>location='placeorderm.php'</script>";
      exit;
      }
   
?>