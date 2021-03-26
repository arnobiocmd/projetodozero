<?php
	if(isset($_GET['excluir'])){
		$idExcluir = intval($_GET['excluir']);
		$selectImagem = MySql::conectar()->prepare("SELECT slide FROM pro_admin_slides WHERE id = ?");
		$selectImagem->execute(array($_GET['excluir']));
		$imagem = $selectImagem->fetch()['slide'];
		Painel::deleteFile($imagem);
		Painel::excluir('pro_admin_slides',$idExcluir);
		Painel::redirect(INCLUDE_PATH_PAINEL.'lista-slide');
	}else if(isset($_GET['order']) && isset($_GET['id'])){
		Painel::orderItem('pro_admin_slides',$_GET['order'],$_GET['id']);

	}

	$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
	$porPagina = 3;
	$slides = Painel::selectAll('pro_admin_slides',($paginaAtual -1 ) * 
		$porPagina,$porPagina);
?>

<div class="box-content">
	<h2><i class="fa fa-slideshare"></i> Slides Cadastrados</h2>
	<div class="wraper-table">
		
	
	<table>
		<tr>
			<td>Titulo</td>
			<td>Slide</td>
			<td>Editar</td>
			<td>Excluir</td>
			<td><i class="fa fa-angle-up"></i></td>
			<td><i class="fa fa-angle-down"></i></td>
		</tr>
		<?php foreach ($slides as $key => $value) { ?>
		<tr>
			<td><?php echo $value['nome']?></td>
			<td><img style="width: 80px;height: 80px;" src="<?php echo INCLUDE_PATH_PAINEL?>/uploads/<?php echo $value['slide']?>"></td>
			<td><a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL?>editar-slide?id=<?php echo $value['id']?>"><i class="fa fa-pencil"></i> Editar</a></td>
			<td><a actionBtn="confirme" class="btn delete" href="<?php echo INCLUDE_PATH_PAINEL?>lista-slide?excluir=<?php echo $value['id']?>"><i class="fa fa-trash"></i> Excluir</a></td>
			<td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL?>lista-slide?order=up&id=<?php echo $value['id']?>"><i class="fa fa-angle-double-up"></i></a></td>
			<td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL?>lista-slide?order=down&id=<?php echo $value['id']?>"><i class="fa fa-angle-double-down"></i></a></td>
		</tr>
	<?php }?>
		
	
	</table>
		<div class="paginacao">
					
					<?php

						$totalPagina = ceil(count(Painel::selectAll('pro_admin_slides')) / $porPagina);

							for ($i=1; $i <= $totalPagina; $i++) { 
								if($i == $paginaAtual)
									echo '<a class="page-select" href="'.INCLUDE_PATH_PAINEL.'lista-slide?pagina='.$i.'">'.$i.'</a>';	
									else
									echo '<a href="'.INCLUDE_PATH_PAINEL.'lista-slide?pagina='.$i.'">'.$i.'</a>';
							}



					?>

		</div>
</div>


</div>	