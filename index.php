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
	
	.dropdown-backdrop {
	  positi on: static;
	}
	
	.navbar {
		z-index: 999;
	}

}
</style>
<body style="width:100%;">
<?php include 'views/header.php'; ?>
<div style="margin-top: -8%; margin-left:20%; border-radius: 6px; text-align:center; width:90%; position:absolute; z-index: -1;" class="center-block formular-middle title">
	<img src="img/logo.png">
</div>

<div style="margin-left:10%; margin-top:19%; background: rgba(255, 255, 255, 0.5); border-radius: 6px; text-align:center; width:80%; position:absolute; z-index: -1;" class="center-block formular-middle title">
	<h3> Creativitatea-i un joc, invata romana pe loc !</h3>
</div>

<div style=" margin-top:29%; border-radius: 6px; text-align:center; width:90%" class="center-block formular-middle title">
	<img style="width:40%" src="img/learning.gif">
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