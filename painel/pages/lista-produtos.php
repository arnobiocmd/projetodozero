<?php
	if(isset($_GET['excluir'])){
		$idExcluir = intval($_GET['excluir']);
		$selectProduto = MySql::conectar()->prepare("SELECT foto_produto FROM pro_admin_produtos WHERE id = ?");
		$selectProduto->execute(array($_GET['excluir']));
		$imagem = $selectProduto->fetch()['foto_produto'];
		Painel::deleteFile($imagem);
		Painel::excluir('pro_admin_produtos',$idExcluir);
		Painel::redirect(INCLUDE_PATH_PAINEL.'lista-produtos');
	}else if(isset($_GET['order']) && isset($_GET['id'])){
		Painel::orderItem('pro_admin_produtos',$_GET['order'],$_GET['id']);

	}

	$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
	$porPagina = 3;
	$produtos = Painel::selectAll('pro_admin_produtos',($paginaAtual -1 ) * 
		$porPagina,$porPagina);
?>

<div class="box-content">
	<h2><i class="fa fa-slideshare"></i> Produtos Cadastrados</h2>
	<div class="wraper-table">
		
	
	<table>
		<tr>
			<td>Titulo</td>
			<td>Preço</td>
			<td>Slide</td>
			<td>Editar</td>
			<td>Excluir</td>
			<td><i class="fa fa-angle-up"></i></td>
			<td><i class="fa fa-angle-down"></i></td>
		</tr>
		<?php foreach ($produtos as $key => $value) { ?>
		<tr>
			<td><?php echo $value['descricao_produto']?></td>
			<td><?php echo $value['valor']?></td>
			<td><img style="width: 80px;height: 80px;" src="<?php echo INCLUDE_PATH_PAINEL?>/uploads/<?php echo $value['foto_produto']?>"></td>
			<td><a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL?>editar-produtos?id=<?php echo $value['id']?>"><i class="fa fa-pencil"></i> Editar</a></td>
			<td><a actionBtn="confirme" class="btn delete" href="<?php echo INCLUDE_PATH_PAINEL?>lista-produtos?excluir=<?php echo $value['id']?>"><i class="fa fa-trash"></i> Excluir</a></td>
			<td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL?>lista-produtos?order=up&id=<?php echo $value['id']?>"><i class="fa fa-angle-double-up"></i></a></td>
			<td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL?>lista-produtos?order=down&id=<?php echo $value['id']?>"><i class="fa fa-angle-double-down"></i></a></td>
		</tr>
	<?php }?>
		
	
	</table>
		<div class="paginacao">
					
					<?php

						$totalPagina = ceil(count(Painel::selectAll('pro_admin_produtos')) / $porPagina);

							for ($i=1; $i <= $totalPagina; $i++) { 
								if($i == $paginaAtual)
									echo '<a class="page-select" href="'.INCLUDE_PATH_PAINEL.'lista-produtos?pagina='.$i.'">'.$i.'</a>';	
									else
									echo '<a href="'.INCLUDE_PATH_PAINEL.'lista-produtos?pagina='.$i.'">'.$i.'</a>';
							}



					?>

		</div>
</div>


</div>	