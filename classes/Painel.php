<?php

class Painel
{
	
	public static function logado(){
		return isset($_SESSION['logged']) ? true : false;
	} 

	public static function loggout(){
		session_destroy();
		header('Location: '.INCLUDE_PATH_PAINEL);
		die();
	}
	
}