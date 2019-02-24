 <?php
 include 'class_core.php';
 



 class users extends core
 {
		public function __construct()
		{
			$type=NULL;
			if(isset($_GET["type"]))
				$type=$this->secure($_GET["type"]);
			
			if($type=="login_user")
				$this->login($_POST["users_name"],$_POST["users_password"]);
			
			if($type=="register_user")
				$this->register($_POST["users_name"],$_POST["users_password"]);
			
			if($type=="delete_data")
				$this->delete_data($_GET["users_id"]);
			
			if($type=="edit_data")
				$this->edit_data($_GET["users_id"],$_POST["users_name"],$_POST["users_password"],$_POST["users_rang"]);
			
			if($type=="logout")
				$this->logout();
		}
		
	    //Logheaza un utilizator
		private function login($user,$password)
		{
			$query=mysql_query("SELECT * FROM  `users` ");
			while($k=mysql_fetch_array($query))
			{
				if($k["users_name"]==$user &&  $this->decrypt($k["users_password"])==$password)
				{
					$this->put_in_session("is_logged","1");
					$this->put_in_session("users_name",$user);
					$this->put_in_session("users_id",$k["users_id"]);
					$this->put_in_session("users_rang", $k["users_rang"]);
					header('Location: /');
				}
			}
			echo "Cont intexistent";
		}
		
		//Logheaza un utilizator
		private function register($user,$password)
		{
			$users_name=$this->secure($user);
			$users_password=$this->crypt($this->secure($password));
			$users_rang=$this->secure($users_rang);


			$query=mysql_query("INSERT INTO `users` (`users_id`, `users_name`, `users_password`) VALUES (NULL, '$users_name', '$users_password')");
			
			$this->login($user, $password);
		}
		
		private function logout()
		{
			session_destroy();
			header('Location: /');
			
		}
		
		private function edit_data($user_id,$users_name, $users_password, $users_rang, $users_institutions_id_aux)
		{
			$users_name=$this->secure($users_name);
			$users_password=$this->crypt($this->secure($users_password));
			$users_rang=$this->secure($users_rang);

	
			
			$query=mysql_query("UPDATE  `users` SET  `users_name` =  '$users_name',
								`users_rang` = '$users_rang',
								`users_password` =  '$users_password' WHERE  `users`.`users_id` = '$user_id'" );
			
			header('Location: /');
		}
		
		private function delete_data($users_id)
		{
			$users_id=$this->secure($users_id);
			
			$query=mysql_query("DELETE FROM `users` WHERE `users`.`users_id` = '$users_id'");
			header('Location: /users.php');
		}
		
		//Listeaza responsabilii
		public function list_data()
		{
			$val=array();
			$query=mysql_query("SELECT * FROM  `users` ");
			
			while($k=mysql_fetch_array($query))
			{
				array_push($val,$k);
			}
			
			return $val;
		}
		
		public function get_user($id)
		{
			$query=mysql_query("SELECT * FROM  `users` WHERE  `users_id` = '$id'");
			$k=mysql_fetch_array($query);
			return $k;
		}
		
 }
 
$obj_users=new users();
 
 ?>