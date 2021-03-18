<?php include('config.php');?>
<!DOCTYPE html>
<html>
<head>
	<title>Projeto 01</title>
	  <meta charset="UTF-8">
	  <link rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH?>assets/css/style.css">
	  <link rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH?>assets/css/font-awesome.min.css">
	  <meta name="description" content="Site de teste">
	  <meta name="keywords" content="palavras,chaves">
	  <meta name="author" content="Arnobio">
	  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	  <link rel="preconnect" href="https://fonts.gstatic.com">
	  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
	  <link rel="icon" href="<?php echo INCLUDE_PATH ?>favicon.ico" type="image/x-icon">
</head>
<body>

	
	<?php
	/*
				if(isset($_POST['acao']) && $_POST['identificador'] == 'form_home'){
					if($_POST['email'] != ''){
						$email = $_POST['email'];
						if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
  						$mail = new Email('162.241.2.88','contato@apfweb.com.br','palmeiras2019','Arnobio');
  						$mail->addAddress('arnobio@apfweb.com.br','ARNOBIO');
  						$corpo = "E-mail para cadastro no site:<hr>$email";
  						$info = ['assunto'=>'Um novo email cadastrado do site','corpo'=>$corpo];
  						$mail->formatarEmail($info);
  						if($mail->enviarEmail()){
  							echo '<script>alert("Email enviado com sucesso")</script>';
  						}else{
  							echo '<script>alert("erro ao enviar Email")</script>';
  						}
						}else{
						echo '<script>alert("Não é um email valido.")</script>';	
						}
					}else{
						echo '<script>alert("Campos Vazios não são permitidos")</script>';
					}
				}else if(isset($_POST['acao']) && $_POST['identificador'] == 'form_contato'){
						$assunto = "Email enviado pelo contato do site";
						$corpo = '';
						foreach ($_POST as $key => $value) {
							$corpo.=ucfirst($key).": ".$value;
							$corpo.='<hr>';
						}
						$info = ['assunto'=>$assunto,'corpo'=>$corpo];
						$mail = new Email('162.241.2.88','contato@apfweb.com.br','palmeiras2019','Arnobio');
  						$mail->addAddress('arnobio@apfweb.com.br','ARNOBIO');
  						$mail->formatarEmail($info);
  						if($mail->enviarEmail()){
  							echo '<script>alert("Email enviado com sucesso pelo contato")</script>';
  						}else{
  							echo '<script>alert("erro ao enviar Email pelo contato")</script>';
  						}

  						
					}
				*/
			?>
			
	<div class="erro">
		Ocorreu um erro ao enviar o E-mail
	</div>
	<div class="sucesso">
		E-mail enviado com sucesso!
	</div>
	<div class="loader-ajax">
		<img src="<?php echo INCLUDE_PATH?>assets/img/ajax-loader.gif">
	</div>


	<base base="<?php echo INCLUDE_PATH ?>">

	<?php
	$url = isset($_GET['url']) ? $_GET['url'] : 'home';
	switch ($url) {
		case 'sobre':
			echo '<target target="sobre">';
			break;
		case 'servicos':
			echo '<target target="servicos">';
			break;
	}

	?>



	<header>
		<div class="center">
			<div class="logo"><a href="./">LOGOMARCA</a></div>
			<nav class="menu-desktop">
				<ul>
					<li><a href="<?php echo INCLUDE_PATH?>">Home</a></li>
					<li><a href="<?php echo INCLUDE_PATH?>sobre">Sobre</a></li>
					<li><a href="<?php echo INCLUDE_PATH?>servicos">Serviços</a></li>
					<li><a realtime="contato" href="<?php echo INCLUDE_PATH?>contato">Contato</a></li>
				</ul>
			</nav>
			<nav class="menu-mobile">
				<div class="menu-btn">
					<i class="fa fa-bars"></i>
				</div>
				<ul>
					<li><a href="<?php echo INCLUDE_PATH?>">Home</a></li>
					<li><a href="<?php echo INCLUDE_PATH?>sobre">Sobre</a></li>
					<li><a href="<?php echo INCLUDE_PATH?>servicos">Serviços</a></li>
					<li><a realtime="contato" href="<?php echo INCLUDE_PATH?>contato">Contato</a></li>
				</ul>
			</nav>
			<div class="clear"></div>
		</div>
	</header>

	<div class="principal">
	<?php
	
	if(file_exists('pages/'.$url.'.php')){
		include('pages/'.$url.'.php');
	}else{
		if($url != 'sobre' && $url != 'servicos'){
		$pagina404 = true;
		include('pages/erro404.php');
		}else{
			include('pages/home.php');
		}
		
	}

	?>
	</div>
	
	<footer <?php if(isset($pagina404) && $pagina404 == true) echo 'class="fixed"'?>>
		<div class="center">
			<p>Todos os direitos reservados</p>
		</div>
	</footer>

	<script type="text/javascript" src="<?php echo INCLUDE_PATH?>assets/js/jquery-3.6.0.min.js"></script>
	<script type="text/javascript" src="<?php echo INCLUDE_PATH?>assets/js/script.js"></script>
	
	<script type="text/javascript" src="<?php echo INCLUDE_PATH?>assets/js/slide.js"></script>
	<script type="text/javascript" src="<?php echo INCLUDE_PATH?>assets/js/constant.js"></script>
	<script type="text/javascript" src="<?php echo INCLUDE_PATH?>assets/js/formulario.js"></script>
	
	<script src='https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyAbJVjJyMqXMTDAOHPD_KY6cC8ttSKEbpA'></script>
	<!--<script src="http://maps.google.com/maps/api/js?key=YOUR_API_KEY"></script>-->
	<script type="text/javascript" src="<?php echo INCLUDE_PATH?>assets/js/map.js"></script>
	
</body>
</html>