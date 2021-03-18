<?php
	if(isset($_GET['loggout'])){
		Painel::loggout();
		
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Painel de Controle</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH?>assets/css/font-awesome.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH_PAINEL ?>assets/css/style.css">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>

	<div class="menu">
		<div class="menu-waper">
			<div class="box-usurario">
				<?php if($_SESSION['img'] == '') {?>
					<div class="avatar-usurio">
						<i class="fa fa-user"></i>
					</div>
				<?php }else{?>
					<div class="imagem-usuario">
						<img src="<?php echo INCLUDE_PATH_PAINEL?>uploads/<?php echo $_SESSION['img']?>">
					</div>
				<?php }?>	
				<div class="nome-usuario">
					<p><?php echo $_SESSION['nome']?></p>
					<p><?php echo pegarCargo($_SESSION['cargo'])?></p>
				</div>
			</div>
			<div class="itens-menu">
				<h2>Cadastro</h2>
				<a href="">Cadastrar Depoimento</a>
				<a href="">Cadastrar Serviço</a>
				<a href="">Cadastrar Slides</a>
				<h2>Gestão</h2>
				<a href="">Listar Depoimento</a>
				<a href="">Listar Serviço</a>
				<a href="">Listar Slides</a>
				<h2>Administração do Painel</h2>
				<a href="">Editar Usuário</a>
				<a href="">Adicionar Usuaário</a>
				<h2>Configuração Gegal</h2>
				<a href="">Editar</a>
			</div>
		</div>
	</div>
	<header>
		<div class="center">
			<div class="menu-btn">
				<i class="fa fa-bars"></i>
			</div>

			<div class="loggout"><a href="<?php echo INCLUDE_PATH_PAINEL?>?loggout"><i class="fa fa-sign-out"></i> Sair</a></div>
			<div class="clear"></div>
		</div>
	

	</header>

	<div class="content">
		<div class="box-content w100">
			<h2><i class="fa fa-home"></i> Painel de Controle - <?php echo NOME_EMPRESA?></h2>
			<div class="box-metricas">
				<div class="box-metricas-single">
					<div class="box-metricas-wraper">
						<h2>Usuarios Online</h2>
						<p>10</p>
					</div>
				</div>
				<div class="box-metricas-single">
					<div class="box-metricas-wraper">
						<h2>Total de Visitas</h2>
						<p>10</p>
					</div>
				</div>
				<div class="box-metricas-single">
					<div class="box-metricas-wraper">
						<h2>Visitas Hoje</h2>
						<p>10</p>
					</div>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<!--<div class="box-content w100">
			
		</div>
		<div class="box-content w50 left">
			
		</div>
		<div class="box-content w50 rigth">
			
		</div>-->
	</div>


	<div class="clear"></div>
	<script type="text/javascript" src="<?php echo INCLUDE_PATH?>assets/js/jquery-3.6.0.min.js"></script>
	<script type="text/javascript" src="<?php echo INCLUDE_PATH_PAINEL?>assets/js/main.js"></script>
</body>
</html>