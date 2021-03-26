<?php
	if(isset($_GET['excluir'])){
		$idExcluir = intval($_GET['excluir']);
		Painel::excluir('pro_admin_depoimentos',$idExcluir);
		Painel::redirect(INCLUDE_PATH_PAINEL.'lista-depoimentos');
	}else if(isset($_GET['order']) && isset($_GET['id'])){
		Painel::orderItem('pro_admin_depoimentos',$_GET['order'],$_GET['id']);

	}




	$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
	$porPagina = 3;
	$depoimentos = Painel::selectAll('pro_admin_depoimentos',($paginaAtual -1 ) * 
		$porPagina,$porPagina);
?>

<div class="box-content">
	<h2><i class="fa fa-comment"></i> Depoimento Cadastrados</h2>
	<div class="wraper-table">
		
	
	<table>
		<tr>
			<td>Nome</td>
			<td>Data</td>
			<td>Editar</td>
			<td>Excluir</td>
			<td><i class="fa fa-angle-up"></i></td>
			<td><i class="fa fa-angle-down"></i></td>
		</tr>
		<?php foreach ($depoimentos as $key => $value) { ?>
		<tr>
			<td><?php echo $value['nome']?></td>
			<td><?php echo $value['data']?></td>
			<td><a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL?>editar-comentario?id=<?php echo $value['id']?>"><i class="fa fa-pencil"></i> Editar</a></td>
			<td><a actionBtn="confirme" class="btn delete" href="<?php echo INCLUDE_PATH_PAINEL?>lista-depoimentos?excluir=<?php echo $value['id']?>"><i class="fa fa-trash"></i> Excluir</a></td>
			<td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL?>lista-depoimentos?order=up&id=<?php echo $value['id']?>"><i class="fa fa-angle-double-up"></i></a></td>
			<td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL?>lista-depoimentos?order=down&id=<?php echo $value['id']?>"><i class="fa fa-angle-double-down"></i></a></td>
		</tr>
	<?php }?>
		
	
	</table>
		<div class="paginacao">
					
					<?php

						$totalPagina = ceil(count(Painel::selectAll('pro_admin_depoimentos')) / $porPagina);

							for ($i=1; $i <= $totalPagina; $i++) { 
								if($i == $paginaAtual)
									echo '<a class="page-select" href="'.INCLUDE_PATH_PAINEL.'lista-depoimentos?pagina='.$i.'">'.$i.'</a>';	
									else
									echo '<a href="'.INCLUDE_PATH_PAINEL.'lista-depoimentos?pagina='.$i.'">'.$i.'</a>';
							}



					?>

		</div>
</div>


</div>	