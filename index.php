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
</head>
<body>

	<header>
		<div class="center">
			<div class="logo"><a href="./">LOGOMARCA</a></div>
			<nav class="menu-desktop">
				<ul>
					<li><a href="<?php echo INCLUDE_PATH?>">Home</a></li>
					<li><a href="<?php echo INCLUDE_PATH?>sobre">Sobre</a></li>
					<li><a href="<?php echo INCLUDE_PATH?>servicos">Serviços</a></li>
					<li><a href="<?php echo INCLUDE_PATH?>contato">Contato</a></li>
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
					<li><a href="<?php echo INCLUDE_PATH?>contato">Contato</a></li>
				</ul>
			</nav>
			<div class="clear"></div>
		</div>
	</header>

	<?php
	$url = isset($_GET['url']) ? $_GET['url'] : 'home';
	if(file_exists('pages/'.$url.'.php')){
		include('pages/'.$url.'.php');
	}else{
		$pagina404 = true;
		include('pages/erro404.php');
	}

	?>
	
	<footer <?php if(isset($pagina404) && $pagina404 == true) echo 'class="fixed"'?>>
		<div class="center">
			<p>Todos os direitos reservados</p>
		</div>
	</footer>

	<script type="text/javascript" src="<?php echo INCLUDE_PATH?>assets/js/jquery-3.6.0.min.js"></script>
	<script type="text/javascript" src="<?php echo INCLUDE_PATH?>assets/js/script.js"></script>
</body>
</html>