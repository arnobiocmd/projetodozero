<?php
	if(isset($_GET['excluir'])){
		$idExcluir = intval($_GET['excluir']);
		Painel::excluir('pro_admin_servicos',$idExcluir);
		Painel::redirect(INCLUDE_PATH_PAINEL.'lista-servicos');
	}else if(isset($_GET['order']) && isset($_GET['id'])){
		Painel::orderItem('pro_admin_servicos',$_GET['order'],$_GET['id']);

	}


	$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
	$porPagina = 3;
	$servicos = Painel::selectAll('pro_admin_servicos',($paginaAtual -1 ) * 
		$porPagina,$porPagina);
?>

<div class="box-content">
	<h2><i class="fa fa-address-card"></i> Serviços Cadastrados</h2>
	<div class="wraper-table">
		
	
	<table>
		<tr>
			<td>Serviços</td>
			<td>Editar</td>
			<td>Excluir</td>
			<td><i class="fa fa-angle-up"></i></td>
			<td><i class="fa fa-angle-down"></i></td>
		</tr>
		<?php foreach ($servicos as $key => $value) { ?>
		<tr>
			<td><?php echo $value['servico']?></td>
		
			<td><a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL?>editar-servicos?id=<?php echo $value['id']?>"><i class="fa fa-pencil"></i> Editar</a></td>
			<td><a actionBtn="confirme" class="btn delete" href="<?php echo INCLUDE_PATH_PAINEL?>lista-servicos?excluir=<?php echo $value['id']?>"><i class="fa fa-trash"></i> Excluir</a></td>
			<td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL?>lista-servicos?order=up&id=<?php echo $value['id']?>"><i class="fa fa-angle-double-up"></i></a></td>
			<td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL?>lista-servicos?order=down&id=<?php echo $value['id']?>"><i class="fa fa-angle-double-down"></i></a></td>
		</tr>
	<?php }?>
		
	
	</table>
		<div class="paginacao">
					
					<?php

						$totalPagina = ceil(count(Painel::selectAll('pro_admin_servicos')) / $porPagina);

							for ($i=1; $i <= $totalPagina; $i++) { 
								if($i == $paginaAtual)
									echo '<a class="page-select" href="'.INCLUDE_PATH_PAINEL.'lista-servicos?pagina='.$i.'">'.$i.'</a>';	
									else
									echo '<a href="'.INCLUDE_PATH_PAINEL.'lista-servicos?pagina='.$i.'">'.$i.'</a>';
							}



					?>

		</div>
</div>


</div>	