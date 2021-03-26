

<div class="box-content">
	<h2><i class="fa fa-address-card"></i> Adicionar Depoimento</h2>
	<?php
		if(isset($_POST['acao'])){
			if(Painel::insert($_POST)){
					Painel::alert('sucesso',' Depoimento cadastrado com sucesso!');
				}else{
					Painel::alert('erro',' Campos vazios não são permitidos.');
				}	
			}
			
				
	?>

	<form method="POST" enctype="multipart/form-data">
		<div class="box-form">
			<label>Nome da pessoa</label>
			<input type="text" name="nome">
		</div>
		<div class="box-form">
			<label>Depoimento</label>
				<textarea name="depoimento"></textarea>
			
		</div>

			<div class="box-form">
			<label>Data</label>
			<input formato="data" type="text" name="data">
		</div>
		<div class="box-form">
			<input type="hidden" name="order_id" value="0">
			<input type="hidden" name="nome_tabela" value="pro_admin_depoimentos">
			<input type="submit" name="acao" value="Cadastrar">
		</div>
	</form>
</div>