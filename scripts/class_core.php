<?php

if(defined("ROOT")==0)
	define("ROOT", "/home/mirceasorin/domains/junioralphabet.ironcoders.com/public_html");
if(defined("PROJ_NAME")==0)
	define("PROJ_NAME", "JuniorAlphabet");

if (class_exists("core")==0)
{
	class core
	{
		public function __construct ()
		{
			$this->connect_mysql();
			if(session_id() == '')
				session_start();
		}
		
		//Se conecteaza la mysql
		private function connect_mysql()
		{
			// informatii de conectare
			$host = "#"; 
			$users = "#"; 
			$pass = "#"; 
			$db = "#";
			
			// deschide conexiunea
			$connection = mysql_connect($host, $users, $pass) or die ("Unable to connect!". mysql_error());
			// selecteaza baza de date
			mysql_select_db($db) or die ("Unable to select database!". mysql_error());
			mysql_set_charset('utf8',$connection); //THIS IS THE IMPORTANT PART
		}
		
		//Sanitizeaza input-ul
		public function secure($string)
		{
			if(isset($string))
			{
				$string=mysql_real_escape_string($string);
				$string=htmlspecialchars($string, ENT_QUOTES);
                
                $aux = explode(" HTTP", $string);
                $string=$aux[0];
                
				return $string;
			}
			return $string;
		}
		
		public function secure_just_sql($string)
		{
			if(isset($string))
			{
				$string=mysql_real_escape_string($string);
				return $string;
			}
			return $string;
		}
		
		//Cripteaza un string
		public function crypt($text)
		{
			$salt="A3cr3tfo@rt3m45e#@d";
			return trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $salt, $text, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND))));
		}
		
		//Decripteaza un string
		public function decrypt($text)
		{
			$salt="A3cr3tfo@rt3m45e#@d";
			return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $salt, base64_decode($text), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)));
		}
	
		//Pune o valaore in sesiune
		public function put_in_session($key,$str)
		{
			$_SESSION[$key]=$this->crypt($str);
		}
		
		//Ia o valaore din sesiune
		public function get_from_sesion($key)
		{
			if(isset($_SESSION[$key]))
				return $this->decrypt($_SESSION[$key]);
			return NULL;
		}
		
		
	}
}
$obj_core=new core();
?>