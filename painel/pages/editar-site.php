<?php
	
	$site = Painel::select('pro_admin_config',false);
?>

<div class="box-content">
	<h2><i class="fa fa-pencil"></i> Editar Configurações do Site</h2>
	<?php
		if(isset($_POST['acao'])){
				if(Painel::update($_POST,true)){
					Painel::alert('sucesso',' Depoimento atualizado com sucesso!');
					$site = Painel::select('pro_admin_config',false);
				}else{
					Painel::alert('erro', ' Erro ao atualizar o depoimento');
				}		
			}			
	?>
	<form method="POST">
		<div class="box-form">
			<label>Titulo do Site</label>
			<input type="text" name="titulo" value="<?php echo $site['titulo']?>">
		</div>
		<div class="box-form">
			<label>Nome Autor</label>
			<input type="text" name="nome_autor" value="<?php echo $site['nome_autor']?>">	
		</div>
		<div class="box-form">
			<label>Descrição Autor</label>
			<textarea name="descricao_autor"><?php echo $site['descricao_autor']?></textarea>		
		</div>

		<?php 
			for ($i=1; $i <= 3 ; $i++) { 
			
		?>

		<div class="box-form">
			<label>Icone<?php echo $i?></label>
			<input type="text" name="icone<?php echo $i?>" value="<?php echo $site['icone'.$i]?>">
				
		</div>

		<div class="box-form">
			<label>Descrição do Icone<?php echo $i?></label>
			<textarea name="descricao_icone<?php echo $i?>"><?php echo $site['descricao_icone'.$i]?></textarea>		
		</div>

			<?php } ?>
		<div class="box-form">
			<input type="hidden" name="nome_tabela" value="pro_admin_config">
			<input type="submit" name="acao" value="Atualizar">
		</div>
	</form>
</div>