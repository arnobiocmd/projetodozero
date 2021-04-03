<?php
	if(isset($_GET['excluir'])){
		$idExcluir = intval($_GET['excluir']);
		Painel::excluir('pro_portal_categorias',$idExcluir);
		$noticias = MySql::conectar()->prepare("SELECT * FROM pro_portal_noticias WHERE categoria_id = ?");
		$noticias->execute(array($idExcluir));
		$noticias = $noticias->fetchAll();
		foreach ($noticias as $key => $value) {
			$imgDelete = $value['capa'];
			Painel::deleteFile($imgDelete);
		}
		$noticias = MySql::conectar()->prepare("DELETE FROM pro_portal_noticias WHERE categoria_id = ?");
		$noticias->execute(array($idExcluir));
		Painel::redirect(INCLUDE_PATH_PAINEL.'gerenciar-categorias');
	}else if(isset($_GET['order']) && isset($_GET['id'])){
		Painel::orderItem('pro_portal_categorias',$_GET['order'],$_GET['id']);

	}

	$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
	$porPagina = 3;
	$categorias = Painel::selectAll('pro_portal_categorias',($paginaAtual -1 ) * 
		$porPagina,$porPagina);
?>

<div class="box-content">
	<h2><i class="fa fa-slideshare"></i> Categorias Cadastradas</h2>
	<div class="wraper-table">
		
	
	<table>
		<tr>
			<td>Nome</td>
			<td>Editar</td>
			<td>Excluir</td>
			<td><i class="fa fa-angle-up"></i></td>
			<td><i class="fa fa-angle-down"></i></td>
		</tr>
		<?php foreach ($categorias as $key => $value) { ?>
		<tr>
			<td><?php echo $value['nome']?></td>
		
			<td><a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL?>editar-categoria?id=<?php echo $value['id']?>"><i class="fa fa-pencil"></i> Editar</a></td>
			<td><a actionBtn="confirme" class="btn delete" href="<?php echo INCLUDE_PATH_PAINEL?>gerenciar-categorias?excluir=<?php echo $value['id']?>"><i class="fa fa-trash"></i> Excluir</a></td>
			<td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL?>gerenciar-categorias?order=up&id=<?php echo $value['id']?>"><i class="fa fa-angle-double-up"></i></a></td>
			<td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL?>gerenciar-categorias?order=down&id=<?php echo $value['id']?>"><i class="fa fa-angle-double-down"></i></a></td>
		</tr>
	<?php }?>
		
	
	</table>
		<div class="paginacao">
					
					<?php

						$totalPagina = ceil(count(Painel::selectAll('pro_portal_categorias')) / $porPagina);

							for ($i=1; $i <= $totalPagina; $i++) { 
								if($i == $paginaAtual)
									echo '<a class="page-select" href="'.INCLUDE_PATH_PAINEL.'gerenciar-categorias?pagina='.$i.'">'.$i.'</a>';	
									else
									echo '<a href="'.INCLUDE_PATH_PAINEL.'gerenciar-categorias?pagina='.$i.'">'.$i.'</a>';
							}



					?>

		</div>
</div>


</div>	