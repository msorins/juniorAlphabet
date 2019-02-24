<?php
include 'scripts/class_users.php'; 
$type=NULL;
if(isset($_GET["type"]))
	$type=$_GET["type"];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>juniorAlphabet</title>
    <meta name="description" content=""/>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Loading Bootstrap -->
    <link href="dist/css/vendor/bootstrap.min.css" rel="stylesheet">

    <!-- Loading Flat UI -->
    <link href="dist/css/flat-ui.css" rel="stylesheet">
    <link href="docs/assets/css/demo.css" rel="stylesheet">

    <link rel="shortcut icon" href="img/favicon.ico">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
      <script src="dist/js/vendor/html5shiv.js"></script>
      <script src="dist/js/vendor/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
      <?php include 'views/header.php'; ?>
	  <div style="min-height:800px;">
		  <?php
		  if($type=="login"){ ?>
			  <div style="margin-top:10%;" class="tile center-block formular-middle">
			  <h4>Loghează-te</h4>
			  <br>
					<div style="margin-top:0px;" class="tile center-block formular-middle">
						<div class="center-block formular-middle" >
								 <form action="scripts/class_users.php?type=login_user" method="post" enctype="multipart/form-data" role="form" class="center-block">
									 <p class="help-block" style="float:left; margin-bottom:5px;">Nume utilizator : </p>
									 <input name="users_name" id="users_name" type="text" class="form-control">
									 <br>
									 <p class="help-block" style="float:left; margin-bottom:5px;">Parolă : </p>
									 <input name="users_password" id="users_password" type="password" class="form-control">
									 <br>
									 <button class="btn btn-primary btn-large btn-block" type="submit">Click</button>
								</form>
						</div>
				  </div>
			 </div>
			 <?php } 
			  if($type=="register"){ ?>
			  <div style="margin-top:10%;" class="tile center-block formular-middle">
			  <h4>Inregistreaza-te</h4>
			  <br>
					<div style="margin-top:0px;" class="tile center-block formular-middle">
						<div class="center-block formular-middle" >
								 <form action="scripts/class_users.php?type=register_user" method="post" enctype="multipart/form-data" role="form" class="center-block">
									 <p class="help-block" style="float:left; margin-bottom:5px;">Nume utilizator : </p>
									 <input name="users_name" id="users_name" type="text" class="form-control">
									 <br>
									 <p class="help-block" style="float:left; margin-bottom:5px;">Parolă : </p>
									 <input name="users_password" id="users_password" type="password" class="form-control">
									 <br>
									 <button class="btn btn-primary btn-large btn-block" type="submit">Click</button>
								</form>
						</div>
				  </div>
			 </div>
			 <?php } 
			 if($type==NULL)
			 {
			
			 }
		 
			 if($type=="edit")
			 {
				 
			 }
		 ?>
	 </div>

    <script src="dist/js/vendor/jquery.min.js"></script>
    <script src="dist/js/vendor/video.js"></script>
    <script src="dist/js/flat-ui.min.js"></script>
    <script src="docs/assets/js/application.js"></script>

    <script>
      videojs.options.flash.swf = "dist/js/vendors/video-js.swf"
    </script>
  </body>

</html>
