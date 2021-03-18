<?php
	session_start();
	$autoload = function($class){
		if($class == 'Email'){
			require_once('classes/phpmailer/PHPMailerAutoload.php');
		}
		include('classes/'.$class.'.php');
	};

	spl_autoload_register($autoload);

	define('INCLUDE_PATH', 'http://localhost/dozeronovo/');
	define('INCLUDE_PATH_PAINEL', INCLUDE_PATH.'painel/');

	/*Conecção com Banco de dados*/

	define('HOST', 'localhost');
	define('DATABASE', 'projeto_1');
	define('USER', 'root');
	define('PASSWORD', '');

	define('NOME_EMPRESA', 'APFWEB.COM');

	/*Funçoes do sistema*/

	function pegarCargo($cargo){
		$arr = [
			'0'=>'Normal',
			'1'=>'Sub Administrador',
			'2'=>'Administrador'
		];

		return $arr[$cargo];

		
	}