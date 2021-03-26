

<div class="box-content">
	<h2><i class="fa fa-address-card"></i> Cadastrar Serviços</h2>
	<?php
		if(isset($_POST['acao'])){
			if(Painel::insert($_POST)){
					Painel::alert('sucesso',' Serviço cadastrado com sucesso!');
				}else{
					Painel::alert('erro',' Campos vazios não são permitidos.');
				}	
			}
			
				
	?>

	<form method="POST" enctype="multipart/form-data">
		<div class="box-form">
			<label>Serviços</label>
				<textarea name="depoimento"></textarea>
			
		</div>
		<div class="box-form">
			<input type="hidden" name="order_id" value="0">
			<input type="hidden" name="nome_tabela" value="pro_admin_servicos">
			<input type="submit" name="acao" value="Cadastrar">
		</div>
	</form>
</div>