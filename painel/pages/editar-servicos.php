<?php
		if(isset($_GET['id'])){
			$id = intval($_GET['id']);
			$servicos = Painel::select('pro_admin_servicos','id = ?',array($id));
		}else{
			Painel::alert('erro', ' Você precisa Informar um ID valido');
			die();
		}

?>
<div class="box-content">
	<h2><i class="fa fa-pencil"></i> Editar Serviços</h2>
	<?php
		if(isset($_POST['acao'])){
					$servico = $_POST['servico'];
					if(Painel::atualizarServicos($servico,$id)){
						Painel::alert('sucesso',' serviço atualizado com sucesso!');
						$servicos = Painel::select('pro_admin_servicos','id = ?',array($id));
					}else{
						Painel::alert('erro',' Erro ao atualizar Serviços');
					}	
			}		
	?>
	<form method="POST">
		<div class="box-form">
			<label>Serviços</label>
				<textarea name="servico"><?php echo $servicos['servico']?></textarea>
		</div>	
		<div class="box-form">
			<input type="hidden" name="id" value="<?php echo $id?>">
			<input type="submit" name="acao" value="Cadastrar">
		</div>
	</form>
</div>