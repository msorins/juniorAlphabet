<?php
include 'scripts/class_core.php'; 
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
<!--[if lt IE 9]>
      <script src="dist/js/vendor/html5shiv.js"></script>
      <script src="dist/js/vendor/respond.min.js"></script>
    <![endif]-->
</head>
<style>
body {
	 background-image: url("img/bg.png");
     background-repeat: no-repeat;
    background-attachment: fixed;
}
</style>
<body style="width:100%;">
<?php
if(isset($_GET["status"]))
{
	if($_GET["status"]=="solved") {
		echo "daa";
		?>
		<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="myModal">
		  <div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div style="margin-top:10px; background-color: #eff0f2; border-radius: 6px; text-align:center; width:90%" class="center-block formular-middle title">
					<h3> Felicitari, ai primit un erou ! </h3>
					<hr>
					<h4> Ai obtinut <span style="color:green"><?php echo htmlentities($_GET["pc"], ENT_QUOTES, "UTF-8");?></span> / <?php echo htmlentities($_GET["pcMaxim"], ENT_QUOTES, "UTF-8");?> puncte </h4>
				</div>
				<div class="center-block">
					<img class="center-block" src="img/congrats.jpg">
				</div>
			</div>
		  </div>
		</div>
	   <?php
	}
	else {
		?>
		<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="myModal">
		  <div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div style="margin-top:10px; background-color: #eff0f2; border-radius: 6px; text-align:center; width:90%" class="center-block formular-middle title">
					<h3> Hai ca poti, mai citeste lectia ! </h3>
					<hr>
					<h4> Ai obtinut <span style="color:red"><?php echo htmlentities($_GET["pc"], ENT_QUOTES, "UTF-8");?></span> / <?php echo htmlentities($_GET["pcMaxim"], ENT_QUOTES, "UTF-8");?> puncte </h4>
				</div>
				<div class="center-block">
					<img class="center-block" src="img/try-again.jpg">
				</div>
			</div>
		  </div>
		</div>
		
		<?php
	}
	
	   echo "<script type=\"text/javascript\">
			$(window).load(function(){
				$('#myModal').modal('show');
			});
		</script>
		";
}

?>
<?php include 'views/header.php'; ?>

<div style="margin-top:10px; background-color: #eff0f2; border-radius: 6px; text-align:center; width:90%" class="center-block formular-middle title">

	<h2 style="margin-top:20px;"> Colectia ta de eroi ! </h2>
	
	<?php 
		$users_name = $obj_core->get_from_sesion("users_name");

 		$query = mysql_query("SELECT * FROM `users` WHERE `users_name` LIKE '$users_name' ");
		$k = mysql_fetch_array($query);

		$heroes = explode("#", $k["user_heroes"]);

		for($i=1; $i<count($heroes); $i++) {
			$crtId = $heroes[$i];
			
			$query2 = mysql_query("SELECT * FROM `lessons` WHERE `lessons_id` = '$crtId' ");
			$k2 = mysql_fetch_array($query2);

			?>
			<div style="margin-top:10px;" class="row">
				<div style="width: 80%; margin-top:30px; min-height:225px; border:1px solid;" class="alert alert-info center-block" role="alert">
					<div class="col-md-6 center-block">
						<img src="img/<?php echo $heroes[$i];?>" style="height:35%; width:35%">
					</div>
					<div class="col-md-6 center-block">
						<h4> <?php echo $k2["lessons_hero_name"]; ?> </h4>
						<br>
						<p> <?php echo $k2["lessons_hero_description"]; ?> </p>
					</div>
				</div>
			</div>
			<?php
			}
		
		
	?>

</div>
  
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