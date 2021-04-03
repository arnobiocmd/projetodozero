<?php
	$url = explode('/', $_GET['url']);

	$verificar_categoria = MySql::conectar()->prepare("SELECT * FROM pro_portal_categorias WHERE slug = ?");
	$verificar_categoria->execute(array($url[1]));
	if($verificar_categoria->rowCount() == 0){
		Painel::redirect(INCLUDE_PATH.'noticias');
	}
	$categoria_info = $verificar_categoria->fetch();

	$post = MySql::conectar()->prepare("SELECT * FROM pro_portal_noticias WHERE slug = ? AND categoria_id = ?");
	$post->execute(array($url[2],$categoria_info['id']));
	if($post->rowCount() == 0 ){
		Painel::redirect(INCLUDE_PATH.'noticias');
	}

	$post = $post->fetch();

?>	



<section class="noticia-single">
	<div class="center">
		<header>
			<h1><i class="fa fa-calendar"></i> <?php echo date('Y-m-d',strtotime($post['data'])) ?> - <?php echo $post['titulo']?></h1>


		</header>
		<article>
			<?php
				echo $post['conteudo'];
			?>
			<td><img style="width: 500px;height: 500px;" src="<?php echo INCLUDE_PATH_PAINEL?>/uploads/<?php echo $post['capa']?>"></td>
			
		</article>
		
	</div>
	
</section>
