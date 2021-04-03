<div class="box-content">
	<h2><i class="fa fa-slideshare"></i> Cadastrar Categorias</h2>
	<?php

			if(isset($_POST['acao'])){	
			$nome = addslashes($_POST['nome']);
			if($nome == ''){
				Painel::alert('erro',' O nome da Categoria precisa está preenchido.');
			}else{
				$verifica = MySql::conectar()->prepare("SELECT * FROM pro_portal_categorias WHERE nome = ?");
				$verifica->execute(array($_POST['nome']));
				if($verifica->rowCount() == 0){
					$slug = Painel::generateSlug($nome);
				$arr = ['nome'=>$nome,'slug'=>$slug,'order_id'=>'0','nome_tabela'=>'pro_portal_categorias'];
				Painel::insert($arr);
				Painel::alert('sucesso',' Categoria cadastrada com sucesso!');
			}else{
				Painel::alert('erro', ' Já existe uma categoria com esse nome');
				
			   }
			}
			}			

		

?>
	<form method="POST" enctype="multipart/form-data">
		<div class="box-form">
			<label>Nome</label>
			<input type="text" name="nome">
		</div>

		<div class="box-form">
			<input type="submit" name="acao" value="Cadastrar">
		</div>
	</form>
</div>