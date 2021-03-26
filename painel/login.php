<?php
	if(isset($_COOKIE['lembrar'])){
		$user = $_COOKIE['user'];
		$password = $_COOKIE['password'];
		$sql = MySql::conectar()->prepare("SELECT * FROM pro_admin_usuario WHERE user = ? AND password = ?");
				$sql->execute(array($user,$password));
			if($sql->rowCount() > 0){
				$info = $sql->fetch();
					$_SESSION['logged'] = true;
					$_SESSION['user'] = $user;
					$_SESSION['password'] = $password;
					$_SESSION['img'] = $info['img'];
					$_SESSION['nome'] = $info['nome'];
					$_SESSION['cargo'] = $info['cargo'];
					header('Location: '.INCLUDE_PATH_PAINEL);
					die();

			}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Pagina de Login</title>
	<meta charset="utf-8">
	 <link rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH?>assets/css/font-awesome.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH_PAINEL ?>assets/css/style.css">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>

	<div class="box-login">
		<?php
			if(isset($_POST['acao'])){
				if($_POST['user'] != '' && $_POST['password'] != ''){
					$user = addslashes($_POST['user']);
					$password = addslashes($_POST['password']);
					$sql = MySql::conectar()->prepare("SELECT * FROM pro_admin_usuario WHERE user = ? AND password = ?");
					$sql->execute(array($user,$password));
						if($sql->rowCount() > 0){
							$info = $sql->fetch();
							$_SESSION['logged'] = true;
							$_SESSION['user'] = $user;
							$_SESSION['password'] = $password;
							$_SESSION['img'] = $info['img'];
							$_SESSION['nome'] = $info['nome'];
							$_SESSION['cargo'] = $info['cargo'];
								if(isset($_POST['lembrar'])){
									setcookie('lembrar',true,time() + (60*60*24) ,'/');
									setcookie('user',$user, time()+ (60*60*24) , '/');
									setcookie('password',$password, time() + (60*60*24), '/');
								}
							
							
							header('Location: '.INCLUDE_PATH_PAINEL);
							die();
						}else{
							echo '<h2 class="campos-vazios">Usuario ou senha incorretos!</h2>';
						}
				}else{
					echo '<h2 class="campos-vazios">Campos vazios, não são permitidos!</h2>';
				}
			}

		?>
		<h2>Efetue o login</h2>
		<form method="POST">
			<input type="text" name="user" placeholder="Login..." required >
			<input type="password" name="password" placeholder="Senha..." required >
			<div class="box-login-check left">
				<input type="submit" name="acao" value="Entrar">
			</div>
			<div class="box-login-check rigth">
				<label>Lembrar-me</label>
				<input type="checkbox" name="lembrar">
			</div>
			
		</form>
		
	</div>

</body>
</html>