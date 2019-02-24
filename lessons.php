<?php
header('Content-type: text/html; charset=utf-8');
include 'scripts/class_core.php'; 
include 'scripts/class_users.php'; 
include 'scripts/class_lessons.php'; 
$type=NULL;
if(isset($_GET["type"]))
	$type=$_GET["type"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>juniorAlphabet | Lectii</title>
<meta name="description" content=""/>
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Loading Bootstrap -->
<link href="dist/css/vendor/bootstrap.min.css" rel="stylesheet">

<meta http-equiv="content-type" content="text/html; charset=utf-8" />

<!-- Loading Flat UI -->
<link href="dist/css/flat-ui.css" rel="stylesheet">
<link href="docs/assets/css/demo.css" rel="stylesheet">
<link rel="shortcut icon" href="img/favicon.ico">

<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
<!--[if lt IE 9]>
      <script src="dist/js/vendor/html5shiv.js"></script>
      <script src="dist/js/vendor/respond.min.js"></script>
    <![endif]-->

	<script src="/js/editor/ckeditor.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	
</head>
<style>
body {
	 background-image: url("img/bg.png");
     background-repeat: no-repeat;
    background-attachment: fixed;
}
</style>
<body style="width:100%;">
<?php include 'views/header.php'; ?>

<?php if($type == "add" || $type == "edit") { 

	if($type == "edit") {
		$name = $obj_core->secure($_GET["name"]);
		$k = $obj_lessons->get_lesson_by_name($name);
		$action = "scripts/class_lessons.php?type=editLesson&id=".$k[0]["lessons_id"];;
	}
	else
	{
		$k = NULL;
		$action = "scripts/class_lessons.php?type=addLesson";
	}
?>

<div style=" margin-top:40px; width:80%" class="tile center-block formular-middle">
			  <h4> <?php if($type == "edit") echo "Editeaza lectia <span id=\"lesson_name\">". $name ."</span>"; else echo "Adauga o lectie"; ?> </h4>
			  <br>
				 <div style="margin-top:10px;" class="center-block formular-middle">
					<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" role="form" style="width:100%" class="center-block">
					    <div class="row">
						    <div class="col-md-6">
								<input name="lessons_name" id="lessons_name" type="text" class="form-control" placeholder="Nume lectiei" value="<?php echo $k[0]["lessons_name"]; ?>">
								<br>
						 		
								<br>
							</div>
							
							<div class="col-md-6">
								<input name="lessons_tags" id="lessons_tags" type="text" class="form-control" placeholder="Taguri" value="<?php echo $k[0]["lessons_tags"]; ?>">
								<p class="help-block" style="float:left; margin-bottom:5px;">Tag-urile sunt despartite de un spatiu</p>
								<br>
							</div>
							<hr>
							<div class="col-md-12">
								 <div class="form-group">
								  <label style="float:left" for="comment"><b>Continut:</b></label><hr>
								  <div style="height:7px;"></div>
								   <textarea name="lessons_content" id="editor1" rows="10" cols="80">
										<?php echo $k[0]["lessons_content"]; ?>
								  </textarea>
								   <script>
										CKEDITOR.replace( 'editor1' );
								   </script>
								</div>
							</div>
							<div class="col-md-12">
								 <div class="form-group">
								  <label style="float:left" for="comment"><b>Exemple:</b></label><hr>
								  <div style="height:7px;"></div>
								   <textarea name="lessons_examples" id="editor2" rows="10" cols="80">
										<?php echo $k[0]["lessons_examples"]; ?>
								  </textarea>
								   <script>
										CKEDITOR.replace( 'editor2' );
								   </script>
								</div>
							</div>
							 <div class="col-md-6">
								<input name="lessons_hero_name" id="lessons_hero_name" type="text" class="form-control" placeholder="Nume eroului" value="<?php echo $k[0]["lessons_hero_name"];?>" >
								<br>
								
								<br>
							</div>
							
							<div class="col-md-6">
								<label class="btn btn-default btn-file">
									Browse <input type="file" name="fileToUpload" id="fileToUpload">
								</label>
							</div>
							
							 <div class="col-md-12">
								<textarea name="lessons_hero_description" id="lessons_hero_description" type="text" class="form-control"> <?php echo $k[0]["lessons_hero_description"];?></textarea>
								<br>
								
								<br> 
							</div>
							
							</div>
							<button class="btn btn-primary btn-large btn-block" type="submit">Adauga</button>
						</form>
					</div>
	</div>							
							<?php if($type == "edit") { ?>
						<div style=" margin-top:40px; width:80%; margin-top:50px; min-height:600px;" class="tile center-block formular-middle">
							<hr>
							<h2> Quizz </h2>
				
							<div name="lista_quizz" id="lista-quizz"  class="lista-quizz btn-group">
								<button onclick="adauga_quizz()" type="button" class="btn btn-default">
									<span  style="margin-left:5px;" class="glyphicon glyphicon-plus"></span>
								</button>
								<button onclick="schimba_button(1)" type="button" id="1" class="btn btn-default nr-quizz">1</button>
						   
						   </div>
							
						   <div>
							   <div class="col-md-6">
									 <b><label style="float:left" for="comment">Intrebare:</label></b>
									 <input name="lessons_quizz_question" id="lessons_quizz_question" type="text" class="form-control" placeholder="Intrebare" >
							  </div>
							  <div class="col-md-6">
									 <b><label style="float:left" for="comment">Raspuns corect:</label></b>
									 <select name="lessons_quizz_answer" id="lessons_quizz_answer" class="form-control">
										  <option value="1">1</option>
										  <option value="2">2</option>
										  <option value="3">3</option>
										  <option value="4">4</option>
									</select>
							
							  </div>
							  <div class="col-md-6">
									 <b><label style="float:left" for="comment">Varianta 1:</label></b>
									 <input name="answer1" id="answer1" type="text" class="form-control" placeholder="Intrebare 1" >
							  </div>
							  <div class="col-md-6">
									 <b><label style="float:left" for="comment">Varianta 2:</label></b>
									 <input name="answer2" id="answer2" type="text" class="form-control" placeholder="Intrebare 2" >
							  </div>
							  <div class="col-md-6">
									 <b><label style="float:left" for="comment">Varianta 3:</label></b>
									 <input name="answer3" id="answer3" type="text" class="form-control" placeholder="Intrebare 3" >
							  </div>
							  <div class="col-md-6">
									  <b><label style="float:left" for="comment">Varianta 4:</label></b>
									 <input name="answer4" id="answer4" type="text" class="form-control" placeholder="Intrebare 4" >
							  </div>
							
							<br>
							 <div class="col-md-12">
								 <div style="margin-top:20px;" id="confirmButton">
									<button style="margin-top:20px;" onclick="query_quizz(1)" class="btn btn-primary btn-large btn-block" type="submit">Salveza intrebarea 1</button>
								 </div>
							 </div>
							 
						   </div>
						</div> 
							<script>
							 var contor = 1; 
							 function adauga_quizz()
							{
								contor++;
							    $('.lista-quizz').append(" <button onclick=\"schimba_button("+contor+")\" type=\"button\" id=\""+contor+"\" class=\"btn btn-default nr-quizz\">"+contor+"</button>");
								$('.btn-group').toggleClass('myClass');
							};
							
							function schimba_button(id){
								$('#confirmButton').html("<button onclick=\"query_quizz("+id+")\" class=\"btn btn-primary btn-large btn-block\" type=\"submit\">Salveza intrebarea "+ id +"</button>");
								document.getElementById('lessons_quizz_question').value='';
								document.getElementById('answer1').value='';
								document.getElementById('answer2').value='';
								document.getElementById('answer3').value='';
								document.getElementById('answer4').value='';
							}
							
							 function query_quizz(id) {
								var xmlhttp;
								if (window.XMLHttpRequest)
								  {// code for IE7+, Firefox, Chrome, Opera, Safari
								  xmlhttp=new XMLHttpRequest();
								  }
								else
								  {// code for IE6, IE5
								  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
								  }
								xmlhttp.onreadystatechange=function()
								  {
								  if (xmlhttp.readyState==4 && xmlhttp.status==200)
									{
										var str=xmlhttp.responseText;
										console.log(str);
								   }
								   else
									   console.log(xmlhttp.readyState);
								 } 
								 
								var lessons_quizz_question=document.getElementById('lessons_quizz_question').value;
								var lessons_quizz_answer=document.getElementById('lessons_quizz_answer').value;
								var answer1=document.getElementById('answer1').value; 
								var answer2=document.getElementById('answer2').value;  
								var answer3=document.getElementById('answer3').value; 
								var answer4=document.getElementById('answer4').value;  
								var name = document.getElementById('lesson_name').innerText;


								var body = "type=editLessonQuizz&number="+id+"&name="+ name +"&question="+encodeURIComponent(lessons_quizz_question)+"&answer=" +lessons_quizz_answer+"&answer1="+encodeURIComponent(answer1)+"&answer2="+encodeURIComponent(answer2)+"&answer3="+encodeURIComponent(answer3)+"&answer4="+encodeURIComponent(answer4);

								
								xmlhttp.open("GET", "scripts/class_lessons.php?"+body, true);
								xmlhttp.send();
	
							 }
							</script>
							<?php } ?>

<?php } 


if($type == NULL) {
?>
	 <div style="margin-top:10px;" class="center-block formular-middle">
		<h3 style="margin-left:25px; color:white; font-family: Verdana" class="center-block"> Lista eroi </h3>
		
		<?php
			$k=$obj_lessons->list_lessons();
		
			for($i=0; $i<count($k); $i++)
			{
				?>
				<div style="margin-top:10px; background-color: #eff0f2; border-radius: 6px; text-align:center; width:90%; min-height:290px;" class="center-block formular-middle title">
					<div class="row">
						<div class="col-md-6">
							<img style="width:260px;" src="img/<?php echo $k[$i]["lessons_id"];?>"> 
						</div>
						<div class="col-md-6">
							<h2><?php echo $k[$i]["lessons_name"]; ?></h2>
						</div>
						<br><br><hr>
						<div class="col-md-6">
							<h4><?php echo $k[$i]["lessons_hero_name"]; ?></h4>
							<div style="height:8px;"></div>
							<p> <?php echo $k[$i]["lessons_hero_description"]; ?> </p>
						</div>
						
					</div>
					<?php
						if( $obj_core->get_from_sesion("users_rang")==1 ) { ?>
							<a style="float:right; margin-right:13%; margin-left:10px; margin-top:-50px;" href="lessons.php?type=edit&name=<?php echo $k[$i]["lessons_name"]; ?>"><button type="button" class="btn btn-danger">Editeaza</button></a>
						<?php } ?>
						
						<a style="float:right; margin-top:-50px; margin-right:1%" href="lessons.php?type=detail&name=<?php echo $k[$i]["lessons_name"]; ?>"><button type="button" class="btn btn-success">Invata</button></a>
						
				
				</div>
				<?php
			}
	    ?>
	 </div>

<?php }


if($type == "detail"){
	$name = $obj_core->secure($_GET["name"]);
	$k = $obj_lessons->get_lesson_by_name($name);

	?>
	

	<div style="margin-top:10px; background-color: #eff0f2; border-radius: 6px; text-align:center; width:90%" class="center-block formular-middle title">
		<h2><?php echo $k[0]["lessons_name"]; ?></h2>
		<img style="width:250px; height:250px;" src="img/<?php echo $k[0]["lessons_id"];?>"> 
		<div>
		  <!-- Nav tabs -->
		  <ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#content" aria-controls="content" role="tab" data-toggle="tab">Lectie</a></li>
			<li role="presentation"><a href="#examples" aria-controls="exemples" role="tab" data-toggle="tab">Exemple</a></li>
			<li role="presentation"><a href="#quizz" aria-controls="quizz" role="tab" data-toggle="tab">Joc</a></li>
		  </ul>

		  <!-- Tab panes -->
		  <div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="content"><p> <?php print $k[0]["lessons_content"]; ?> </p></div>
			<div role="tabpanel" class="tab-pane" id="examples"><?php echo $k[0]["lessons_examples"]; ?></div>
			<div role="tabpanel" class="tab-pane" id="quizz">
			
			<?php $dbQuestion = explode("#", $k[0]['lessons_quizz_questions']); ?>
			<form action="scripts/class_lessons.php?type=solveLessonQuizz&name=<?php echo $k[0]['lessons_name']; ?>&count=<?php echo count($dbQuestion); ?> " method="post" enctype="multipart/form-data" role="form" style="width:100%" class="center-block">
				<?php
					$dbAnswer1 = explode("#", $k[0]['lessons_quizz_answer1']);
					$dbAnswer2 = explode("#", $k[0]['lessons_quizz_answer2']);
					$dbAnswer3 = explode("#", $k[0]['lessons_quizz_answer3']);
					$dbAnswer4 = explode("#", $k[0]['lessons_quizz_answer4']);
					
					for($i=0; $i < count($dbQuestion); $i++){
					?> 
					  <h3> <?php echo $dbQuestion[$i] ;?> </h3>
					  <input type="checkbox" id="answer<?php echo $i+1; ?>" name="answer<?php echo $i+1; ?>" value="1"> <?php echo $dbAnswer1[$i] ;?><br>
					  <input type="checkbox" id="answer<?php echo $i+1; ?>" name="answer<?php echo $i+1; ?>" value="2"> <?php echo $dbAnswer2[$i] ;?><br>
					  <input type="checkbox" id="answer<?php echo $i+1; ?>" name="answer<?php echo $i+1; ?>" value="3"> <?php echo $dbAnswer3[$i] ;?><br>
					  <input type="checkbox" id="answer<?php echo $i+1; ?>" name="answer<?php echo $i+1; ?>" value="4"> <?php echo $dbAnswer4[$i] ;?><br>

					 <hr>

					<?php
					}
				?>
				<button class="btn btn-primary btn-large btn-block" type="submit">Trimite</button>
			</form>
			</div>
		  </div>

		</div>
	

	</div>  
	<?php
}

 ?>


  
</div>
<script src="dist/js/vendor/jquery.min.js"></script> >
<script src="dist/js/vendor/video.js"></script> 
<script src="dist/js/flat-ui.min.js"></script> 
<script src="docs/assets/js/application.js"></script> 
<script>
      videojs.options.flash.swf = "dist/js/vendors/video-js.swf"
 </script>
</body>
</html>