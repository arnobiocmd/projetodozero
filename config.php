<?php
	session_start();

	date_default_timezone_set('America/Sao_Paulo');
	$autoload = function($class){
		if($class == 'Email'){
			require_once('classes/phpmailer/PHPMailerAutoload.php');
		}
		include('classes/'.$class.'.php');
	};

	spl_autoload_register($autoload);

	define('INCLUDE_PATH', 'http://localhost/dozeronovo/');
	define('INCLUDE_PATH_PAINEL', INCLUDE_PATH.'painel/');
	define('BASE_DIR_PAINEL',__DIR__.'/painel');

	/*Conecção com Banco de dados*/

	define('HOST', 'localhost');
	define('DATABASE', 'projeto_1');
	define('USER', 'root');
	define('PASSWORD', '');

	define('NOME_EMPRESA', 'APFWEB.COM');

	/*Funçoes do sistema*/

	function pegarCargo($indice){

		return Painel::$cargos[$indice];
		
	}
	function selecinaMenu($par){
		$url = explode('/', @$_GET['url'])[0];
		if($url == $par){
			echo 'class="menu-active"';

		}
	}

	function verificarPermissaoMenu($permissao){
		if($_SESSION['cargo'] >= $permissao){
			return;
		}else{
			echo "style=display:none";
		}

	}

	function verificarPermissaoPagina($permissao){
		if($_SESSION['cargo'] >= $permissao){
			return;
		}else{
			include('painel/pages/permissao-negada.php');
			die();
		}
	}

	function recoverPost($post){
		if(isset($_POST[$post])){
			echo $_POST[$post];
		}
	}