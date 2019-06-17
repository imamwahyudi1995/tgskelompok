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

      $username = $_POST['username'];
      $password = $_POST['password'];
      $_SESSION['userName']=$username;

      $sql =<<<EOF
      set search_path to sco;
      select * from register where uname = '$username';
EOF;
      
      $ret = pg_query($db, $sql);
      if(pg_num_rows ($ret)==0){
         echo "<script type=\"text/javascript\">".
        "alert('Enter valid username');".
        "</script>";
        header('Location: index.html');
        exit;
      }
      else{
         $row = pg_fetch_row($ret);
         if($password==$row[2]){
          switch ($row[4]) {
            case 'supplier':
              echo "<script>location='Supplier.php'</script>";
              break;
            case 'distributor':
              echo "<script>location='Distributor.php'</script>";
              break;
            case 'transporter':
              echo "<script>location='transporter.php'</script>";
              break;
            case 'manufacturer':
              echo "<script>location='Manufacture.php'</script>";
              break;
            default:
              # code...
              break;
          }
        exit;
         }
         else{
            echo "<script type=\"text/javascript\">".
        "alert('Enter valid password');".
        "</script>";
        echo "<script>location='index.html'</script>";
        exit;
         }
      }

      if(!$ret) {
         echo pg_last_error($db);
      }
      
      pg_close($db);
      
      
      }
   
?>