<?php
 include 'class_core.php';
if (class_exists("lessos")==0)
{
	 class lessons extends core
	{
		public function __construct ()
		{
			$type=NULL;
			if(isset($_GET["type"]))
				$type=$this->secure($_GET["type"]);
			
		
			if($type=="addLesson")
				$this->addLesson($_POST["lessons_name"], $_POST["lessons_content"], $_POST["lessons_examples"], $_POST["lessons_tags"], $_POST["lessons_hero_name"], $_POST["lessons_hero_description"]);
			
			if($type=="editLesson")
				$this->editLesson($_GET["id"], $_POST["lessons_name"], $_POST["lessons_content"], $_POST["lessons_examples"], $_POST["lessons_tags"], $_POST["lessons_hero_name"], $_POST["lessons_hero_description"]);
			
			if($type=="editLessonQuizz")
				$this->editLessonQuizz($_GET["name"], $_GET["number"], $_GET["question"], $_GET["answer"], $_GET["answer1"], $_GET["answer2"], $_GET["answer3"], $_GET["answer4"]);
			
			if($type=="solveLessonQuizz")
				$this->solveLessonQuizz($_GET["name"], $_GET["count"]);
			
		}
		
		private function addLesson($lessons_name, $lessons_content, $lessons_examples, $lessons_tags, $lessons_hero_name, $lessons_hero_description) {
			$lessons_name=$this->secure($lessons_name);
			$lessons_tags=$this->secure($lessons_tags);
			$lessons_hero_name=$this->secure($lessons_hero_name);
			$lessons_hero_description=$this->secure($lessons_hero_description);
			
			mysql_query("INSERT INTO `lessons` (`lessons_id`, `lessons_name`, `lessons_content`, `lessons_examples`, `lessons_tags`, `lessons_hero_name`, `lessons_hero_description`) VALUES (NULL, '$lessons_name', '$lessons_content', '$lessons_examples', '$lessons_tags', '$lessons_hero_name','$lessons_hero_description');") or die(mysql_error());
			
			if(file_exists($_FILES['fileToUpload']['tmp_name']))
			{
				$id = $this->get_lesson_id( $lessons_name );
				echo $id;
				move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], ROOT.'/img/'.$id);
				echo "Uploadat";
			}
			
			header('Location: /lessons.php');
		}
		
		private function editLesson($id, $lessons_name, $lessons_content, $lessons_examples, $lessons_tags, $lessons_hero_name, $lessons_hero_description) {
			$id=$this->secure($id);
			$lessons_content = $lessons_content;
			$lessons_name=$this->secure($lessons_name);
			$lessons_tags=$this->secure($lessons_tags);
			$lessons_hero_name=$this->secure($lessons_hero_name);
			$lessons_hero_description=$this->secure($lessons_hero_description);
			
			mysql_query("UPDATE `lessons` SET `lessons_name` = '$lessons_name', `lessons_content` = '$lessons_content', `lessons_examples` = '$lessons_examples', `lessons_tags` = '$lessons_tags', `lessons_hero_name` = '$lessons_hero_name', `lessons_hero_description` = '$lessons_hero_description' WHERE `lessons`.`lessons_id` = '$id';") or die(mysql_error());
			
			if(file_exists($_FILES['fileToUpload']['tmp_name']))
			{
				echo $id;
				move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], ROOT.'/img/'.$id);
				echo "Uploadat";
			}

			header('Location: /lessons.php');
		}
		
		
		public function list_lessons()
		{
			$val=array();
			$query=mysql_query("SELECT * FROM `lessons`   ORDER BY `lessons_id` DESC ");
			
			while($k=mysql_fetch_array($query))
			{
					array_push($val,$k);
			}
			return $val;
		}
		
		public function get_lesson_by_name($name)
		{
			$val=array();
			$query=mysql_query("SELECT * FROM `lessons` WHERE `lessons_name` LIKE '$name'  ORDER BY `lessons_id` DESC ");
			
			while($k=mysql_fetch_array($query))
			{
					array_push($val,$k);
			}
			return $val;
		}
		
		public function get_lesson_id($name)
		{
			$val=array();
			$query=mysql_query("SELECT * FROM `lessons`   ORDER BY `lessons_id` DESC ");
			
			$k=mysql_fetch_array ($query);
			return $k["lessons_id"];
		}
		
		public function editLessonQuizz( $name, $number, $question, $answer, $answer1, $answer2, $answer3, $answer4 ) {
			$name=$this->secure_just_sql($name);
			$number=$this->secure_just_sql($number);
			$question=$this->secure_just_sql($question);
			$answer=$this->secure_just_sql($answer);
			$answer1=$this->secure_just_sql($answer1);
			$answer2=$this->secure_just_sql($answer2);
			$answer3=$this->secure_just_sql($answer3);
			$answer4=$this->secure_just_sql($answer4);
			
			$query = mysql_query("SELECT * FROM `lessons` WHERE `lessons_name` LIKE '$name' "); 
			$k = mysql_fetch_array($query);
			
			$aux = explode("#", $k['lessons_quizz_questions']);
			$maxCrt = max($number, count($aux));
			
			
			$dbQuestion = explode("#", $k['lessons_quizz_questions']);
			$dbAnswer = explode("#", $k['lessons_quizz_answer']);
			$dbAnswer1 = explode("#", $k['lessons_quizz_answer1']);
			$dbAnswer2 = explode("#", $k['lessons_quizz_answer2']);
			$dbAnswer3 = explode("#", $k['lessons_quizz_answer3']);
			$dbAnswer4 = explode("#", $k['lessons_quizz_answer4']);
			
			$newQuestion = NULL;
			$newAnswer = NULL;
			$newAnswer1 = NULL;
			$newAnswer2 = NULL;
			$newAnswer3 = NULL;
			$newAnswer4 = NULL;
			
			for($i=0; $i<$maxCrt; $i++){
				if($number == $i+1)
				{
					$newQuestion.=$question;
					$newAnswer .= $answer;
					$newAnswer1.=$answer1;
					$newAnswer2.=$answer2;
					$newAnswer3.=$answer3;
					$newAnswer4.=$answer4;
				}
				else
				{
					$newQuestion.=$dbQuestion[$i];
					$newAnswer .= $dbAnswer[$i];
					$newAnswer1.= $dbAnswer1[$i];
					$newAnswer2.= $dbAnswer2[$i];
					$newAnswer3.= $dbAnswer3[$i];
					$newAnswer4.= $dbAnswer4[$i];
				}
				if($i < $maxCrt-1 )
				{
					$newQuestion .= "#";
					$newAnswer .= "#";
					$newAnswer1 .= "#";
					$newAnswer2 .= "#";
					$newAnswer3 .= "#";
					$newAnswer4 .= "#";
				}
			}
			
			mysql_query("UPDATE `lessons` SET 
			`lessons_quizz_questions` = '$newQuestion',
			`lessons_quizz_answer` = '$newAnswer',
			`lessons_quizz_answer1` = '$newAnswer1',
			`lessons_quizz_answer2` = '$newAnswer2',
			`lessons_quizz_answer3` = '$newAnswer3',
			`lessons_quizz_answer4` = '$newAnswer4'
			WHERE `lessons`.`lessons_name` = '$name'") or die (mysql_error());
			
			echo "done";
		}
		
		public function solveLessonQuizz($name, $count) {
			$name=$this->secure($name);
			$count=$this->secure($count);
			
			$query = mysql_query("SELECT * FROM `lessons` WHERE `lessons_name` LIKE '$name' "); 
			$k = mysql_fetch_array($query);
			$id = $k["lessons_id"];
			
			$aux = explode("#", $k['lessons_quizz_questions']);
			$pc = 0;
			$dbAnswer = explode("#", $k['lessons_quizz_answer']);
			
			for($i=0; $i <= count($aux); $i++ ){
				$crtAnswer = $_POST["answer".($i+1)];
				$crtAnswer = $this->secure($crtAnswer);
				
				//echo $crtAnswer." ".$dbAnswer[$i]."   |||||  ";
				if($crtAnswer == $dbAnswer[$i])
					$pc++;
			}
			$pc--;
			$pcMaxim = count($aux);
			$status = "failed";
			
			if($pc >= $pcMaxim /2 ) // I dam eroul
			{
				$status = "solved";
				$users_name = $this->get_from_sesion("users_name");

				$query = mysql_query("SELECT * FROM `users` WHERE `users_name` LIKE '$users_name' ");
				$k = mysql_fetch_array($query);
				
				if( strpos($k["user_heroes"], "#".$id ) === false )
				{
					echo "Facut";
					$crtHeroes = $k["user_heroes"]."#".$id;
				
					$query = mysql_query("UPDATE `users` SET `user_heroes` = '$crtHeroes' WHERE `users`.`users_name` = '$users_name'") or die(mysql_error());
				}
		
			}
			
			header('Location: /profile.php?status='.$status.'&pc='.$pc.'&pcMaxim='.$pcMaxim);
		}
		
	}
}
$obj_lessons=new lessons(); 
?>