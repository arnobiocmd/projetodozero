<?php
		if(isset($_GET['id'])){
			$id = intval($_GET['id']);
			$depoimento = Painel::select('pro_admin_depoimentos','id = ?',array($id));

		}else{
			Painel::alert('erro', ' Você precisa Informar um ID valido');
			die();
		}

?>
<div class="box-content">
	<h2><i class="fa fa-pencil"></i> Editar Depoimento</h2>
	<?php
		if(isset($_POST['acao'])){
				if(Painel::update($_POST)){
					Painel::alert('sucesso',' Depoimento atualizado com sucesso!');
					$depoimento = Painel::select('pro_admin_depoimentos','id = ?',array($id));
				}else{
					Painel::alert('erro', ' Erro ao atualizar o depoimento');
				}
				
					
			}
			
				
	?>

	<form method="POST">
		<div class="box-form">
			<label>Nome da pessoa</label>
			<input type="text" name="nome" value="<?php echo $depoimento['nome']?>">
		</div>
		<div class="box-form">
			<label>Depoimento</label>
				<textarea name="depoimento"><?php echo $depoimento['depoimento']?></textarea>
			
		</div>

			<div class="box-form">
			<label>Data</label>
			<input formato="data" type="text" name="data" value="<?php echo $depoimento['data']?>">
		</div>
		<div class="box-form">
			<input type="hidden" name="id" value="<?php echo $id?>">
			<input type="hidden" name="nome_tabela" value="pro_admin_depoimentos">
			<input type="submit" name="acao" value="Cadastrar">
		</div>
	</form>
</div>