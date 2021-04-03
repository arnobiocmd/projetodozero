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
				<a <?php selecinaMenu('cadastrar-depomento')?> href="<?php echo INCLUDE_PATH_PAINEL?>cadastrar-depomento">Cadastrar Depoimento</a>
				<a <?php selecinaMenu('cadastrar-servicos')?> href="<?php echo INCLUDE_PATH_PAINEL?>cadastrar-servicos">Cadastrar Serviço</a>
				<a <?php selecinaMenu('cadastrar-slide')?> href="<?php echo INCLUDE_PATH_PAINEL?>cadastrar-slide">Cadastrar Slides</a>
				<a <?php selecinaMenu('cadastrar-produtos')?> href="<?php echo INCLUDE_PATH_PAINEL?>cadastrar-produtos">Cadastrar Produtos</a>
				<h2>Gestão</h2>
				<a <?php selecinaMenu('lista-depoimentos')?> href="<?php echo INCLUDE_PATH_PAINEL?>lista-depoimentos">Listar Depoimento</a>
				<a <?php selecinaMenu('lista-servicos')?> href="<?php echo INCLUDE_PATH_PAINEL?>lista-servicos">Listar Serviço</a>
				<a <?php selecinaMenu('lista-slide')?> href="<?php echo INCLUDE_PATH_PAINEL?>lista-slide">Listar Slides</a>
				<a <?php selecinaMenu('lista-produtos')?> href="<?php echo INCLUDE_PATH_PAINEL?>lista-produtos">Listar Produtos</a>
				<h2>Administração do Painel</h2>
				<a <?php selecinaMenu('editar-usuario')?> href="<?php echo INCLUDE_PATH_PAINEL?>editar-usuario">Editar Usuário</a>
				<a <?php selecinaMenu('adicionar-usuario')?> <?php verificarPermissaoMenu(2)?> href="<?php echo INCLUDE_PATH_PAINEL?>adicionar-usuario">Adicionar Usuário</a>
				<h2>Configuração Gegal</h2>
				<a <?php selecinaMenu('editar-site')?> href="<?php echo INCLUDE_PATH_PAINEL?>editar-site">Editar Site</a>
				<h2>Gestão de Notícias</h2>
				<a <?php selecinaMenu('cadastrar-categorias')?> href="<?php echo INCLUDE_PATH_PAINEL?>cadastrar-categorias">Cadastrar Categorias</a>
				<a <?php selecinaMenu('gerenciar-categorias')?> href="<?php echo INCLUDE_PATH_PAINEL?>gerenciar-categorias">Gerenciar Categorias</a>
				<a <?php selecinaMenu('cadastrar-noticias')?> href="<?php echo INCLUDE_PATH_PAINEL?>cadastrar-noticias">Cadastrar Notícias</a>
				<a <?php selecinaMenu('gerenciar-noticias')?> href="<?php echo INCLUDE_PATH_PAINEL?>gerenciar-noticias">Gerenciar Notícias</a>
			</div>
		</div>
	</div>
	<header>
		<div class="center">
			<div class="menu-btn">
				<i class="fa fa-bars"></i>
			</div>

			<div class="loggout">
				<a <?php if(@$_GET['url'] == '') { ?>style="background-color: #416a85;padding: 16px" <?php }?> href="<?php echo INCLUDE_PATH_PAINEL?>"><i class="fa fa-home"></i> Pagina inicial</a>
				<a href="<?php echo INCLUDE_PATH_PAINEL?>?loggout"><i class="fa fa-sign-out"></i> Sair</a>

			</div>
			<div class="clear"></div>
		</div>
	

	</header>

	<div class="content">
		<?php Painel::carregarPagina();?>
	</div>


	<div class="clear"></div>
	<script type="text/javascript" src="<?php echo INCLUDE_PATH?>assets/js/jquery-3.6.0.min.js"></script>
	<script type="text/javascript" src="<?php echo INCLUDE_PATH_PAINEL?>assets/js/jquery.mask.js"></script>
	<script type="text/javascript" src="<?php echo INCLUDE_PATH_PAINEL?>assets/js/main.js"></script>
	<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  	<script>
  	tinymce.init({
  	selector:'.tinymce',
  	plugins:'image',
  
  	toolbar: 'image',	
  	});</script>
</body>
</html>