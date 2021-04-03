<?php
	if(isset($_GET['excluir'])){
		$idExcluir = intval($_GET['excluir']);
		$selectImagem = MySql::conectar()->prepare("SELECT capa FROM pro_portal_noticias WHERE id = ?");
		$selectImagem->execute(array($_GET['excluir']));
		$imagem = $selectImagem->fetch()['capa'];
		Painel::deleteFile($imagem);
		Painel::excluir('pro_portal_noticias',$idExcluir);
		Painel::redirect(INCLUDE_PATH_PAINEL.'gerenciar-noticias');
	}else if(isset($_GET['order']) && isset($_GET['id'])){
		Painel::orderItem('pro_portal_noticias',$_GET['order'],$_GET['id']);

	}

	$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
	$porPagina = 3;
	$slides = Painel::selectAll('pro_portal_noticias',($paginaAtual -1 ) * 
		$porPagina,$porPagina);
?>

<div class="box-content">
	<h2><i class="fa fa-slideshare"></i> Notícias Cadastradas</h2>
	<div class="wraper-table">
		
	
	<table>
		<tr>
			<td>Titulo</td>
			<td>Categoria</td>
			<td>Imagem</td>
			<td>Editar</td>
			<td>Excluir</td>
			<td><i class="fa fa-angle-up"></i></td>
			<td><i class="fa fa-angle-down"></i></td>
		</tr>
		<?php foreach ($slides as $key => $value) { ?>
			<?php $puxaCategoria = Painel::select('pro_portal_categorias','id=?',array($value['categoria_id']))['nome']; ?>
		<tr>
			<td><?php echo $value['titulo']?></td>
			<td><?php echo $puxaCategoria ?></td>
			<td><img style="width: 80px;height: 80px;" src="<?php echo INCLUDE_PATH_PAINEL?>/uploads/<?php echo $value['capa']?>"></td>
			<td><a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL?>editar-noticias?id=<?php echo $value['id']?>"><i class="fa fa-pencil"></i> Editar</a></td>
			<td><a actionBtn="confirme" class="btn delete" href="<?php echo INCLUDE_PATH_PAINEL?>gerenciar-noticias?excluir=<?php echo $value['id']?>"><i class="fa fa-trash"></i> Excluir</a></td>
			<td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL?>gerenciar-noticias?order=up&id=<?php echo $value['id']?>"><i class="fa fa-angle-double-up"></i></a></td>
			<td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL?>gerenciar-noticias?order=down&id=<?php echo $value['id']?>"><i class="fa fa-angle-double-down"></i></a></td>
		</tr>
	<?php }?>
		
	
	</table>
		<div class="paginacao">
					
					<?php

						$totalPagina = ceil(count(Painel::selectAll('pro_portal_noticias')) / $porPagina);

							for ($i=1; $i <= $totalPagina; $i++) { 
								if($i == $paginaAtual)
									echo '<a class="page-select" href="'.INCLUDE_PATH_PAINEL.'gerenciar-noticias?pagina='.$i.'">'.$i.'</a>';	
									else
									echo '<a href="'.INCLUDE_PATH_PAINEL.'gerenciar-noticias?pagina='.$i.'">'.$i.'</a>';
							}



					?>

		</div>
</div>


</div>	