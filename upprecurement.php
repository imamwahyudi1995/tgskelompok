
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Registration</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/my-login.css">
	<link rel="stylesheet" type="text/css" href="css/newSupply.css">
</head>
<body class="my-login-page">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<div class="ab">
						
                    </div>
                    <?php 
  session_start(); 
  if($_SESSION['userName']==true){
    $user = $_SESSION['userName']; 
  }
   $host        = "host = ec2-54-227-250-33.compute-1.amazonaws.com";
   $port        = "port = 5432";
   $dbname      = "dbname = dfh1ffcplg2486";
   $credentials = "user = eacvhyhfmkrufp password=09ed8a0efcefee49aecd377a6e0a69cbfa41939219c9a9747eb0324c7d616d24";

   $db = pg_connect( "$host $port $dbname $credentials"  );
   if(!$db) {
      echo "Error : Unable to open database\n";
   }

    $page = $_GET['page'];
      $sql =<<<EOF
      set search_path to sco;
      select * from procurement where id='$page';
EOF;

      $ret = pg_query($db, $sql);
      if(!$ret) {
         echo pg_last_error($db);
      }
      
      $row=pg_fetch_row($ret);
      pg_close($db);
?>  

					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title">Information</h4>
							<form method="POST" action="updateprocurement.php">
								<div class="form-group">
									<label for="raw_material">Raw Material</label>
									<input id="raw_material" type="text" class="form-control" value="<?php echo $row[1]; ?>" name="raw_material" required>
								</div>
								<div class="form-group">
									<label for="Availability">Add quantity</label>
									<input id="Availability" type="number" class="form-control" value="<?php echo $row[2]; ?>" name="Availability" required data-eye>
								</div>
								<div class="form-group no-margin">
                                    <input type="hidden" name="id" value="<?php echo $row[4] ?>" >
									<input type="submit" name="submit" value="Submit" class="btn btn-primary btn-block" />
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/jquery.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="js/my-login.js"></script>
</body>
</html>
