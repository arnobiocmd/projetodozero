<?php
	
	class Usuario{

		public static function AtualizarUsuario($senha,$nome,$imagem){
			$sql = MySql::conectar()->prepare("UPDATE pro_admin_usuario SET password = ?, img = ?, nome = ? WHERE user = ?");
			if($sql->execute(array($senha,$imagem,$nome,$_SESSION['user']))){
				return true;
			}else{
				return false;
			}
		}

		public static function userExiste($user){
			$sql = MySql::conectar()->prepare("SELECT * FROM pro_admin_usuario WHERE user = ? ");
			$sql->execute(array($user));
			if($sql->rowCount() > 0){
				return true;
			}else{
				return false;
			}
		}

		public static function adicionarUsuario($user,$password,$img,$nome,$cargo){
			$sql = MySql::conectar()->prepare("INSERT INTO pro_admin_usuario VALUES (null,?,?,?,?,?)");
			if($sql->execute(array($user,$password,$img,$nome,$cargo))){
					return true;
				}else{
					return false;
				}
			}
	}