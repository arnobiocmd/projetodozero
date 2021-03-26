<?php
	
	class Site{
		public static function carregarUsuariosOline(){
			if(isset($_SESSION['logge'])){
				$token = $_SESSION['logge'];
				$horaAtual = date('Y-m-d:H:i:s');
				$check = MySql::conectar()->prepare("SELECT * FROM pro_admin_online WHERE token = ?");
				$check->execute(array($_SESSION['logge']));
				if($check->rowCount() > 0){
					$sql = MySql::conectar()->prepare("UPDATE pro_admin_online SET ultima_acao = ? WHERE token = ?");
					$sql->execute(array($horaAtual,$token));
				}else{
					$ip = $_SERVER["REMOTE_ADDR"];
					$token = $_SESSION['logge'];
					$horaAtual = date('Y-m-d:H:i:s');
					$sql = MySql::conectar()->prepare("INSERT INTO pro_admin_online VALUES (null,?,?,?)");
					$sql->execute(array($ip,$horaAtual,$token));
				}	
			}else{
				$_SESSION['logge'] = uniqid();
				$ip = $_SERVER["REMOTE_ADDR"];
				$token = $_SESSION['logge'];
				$horaAtual = date('Y-m-d:H:i:s');
				$sql = MySql::conectar()->prepare("INSERT INTO pro_admin_online VALUES (null,?,?,?)");
				$sql->execute(array($ip,$horaAtual,$token));

				
			}
		} 

		public static function contador(){
			setcookie('visita','true',time() - 1, '/');
			if(!isset($_COOKIE['visita'])){
			setcookie('visita','true',time() + (60*60*24*7), '/');
			$sql = MySql::conectar()->prepare("INSERT INTO pro_admin_visitas VALUES (null,?,?)");
			$sql->execute(array($_SERVER["REMOTE_ADDR"],date('Y-m-d')));

			}
		} 


	}