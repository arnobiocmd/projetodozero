<div class="box-content">
	<h2><i class="fa fa-pencil"></i> Cadastrar Notícia</h2>
	<?php

			if(isset($_POST['acao'])){
			$categoria_id = $_POST['categoria_id'];
			$titulo = $_POST['titulo'];
			$conteudo = $_POST['conteudo'];	
			$capa = $_FILES['capa'];
			
			if($titulo == '' || $conteudo == ''){
				Painel::alert('erro', 'Campos Vazios não são permitidos');
			}else if($capa['tmp_name'] == ''){
				Painel::alert('erro', 'Precisa selecinar uma imagem');
			}else{
				if(Painel::imagemValida($capa)){
					$verifica = MySql::conectar()->prepare("SELECT * FROM pro_portal_noticias WHERE titulo = ? AND categoria_id = ?");
					$verifica->execute(array($titulo,$categoria_id));
					if($verifica->rowCount() == 0){
						$imagem = Painel::uploudeFile($capa);
						$slug = Painel::generateSlug($titulo);
						$arr = ['categoria_id'=>$categoria_id,'data'=>date('Y-m-d'),'titulo'=>$titulo,'conteudo'=>$conteudo,'capa'=>$imagem,'slug'=>$slug,'order_id'=>'0','nome_tabela'=>'pro_portal_noticias'];
					if(Painel::insert($arr))
						Painel::redirect(INCLUDE_PATH_PAINEL.'cadastrar-noticias?sucesso');
						//Painel::alert('sucesso', 'O cadastro da Notícia foi realizado com sucesso');
					}else{
						Painel::alert('erro','Já existe uma noticia com esse nome');
					}
					

				}else{
					Painel::alert('erro', 'Selecione uma Imagem valida');
				}
				
			}
					

		}

		if(isset($_GET['sucesso']) && !isset($_POST['acao'])){
			Painel::alert('sucesso', 'O cadastro foi realizado com sucesso!');
		}

	?>
	<form method="POST" enctype="multipart/form-data">
		<div class="box-form">
			<label>Categoria</label>
			<select name="categoria_id">
				<?php
				$categoria = Painel::selectAll('pro_portal_categorias');
				foreach ($categoria as $key => $value) {
				?>
				<option <?php if($value['id'] == @$_POST['categoria_id']) echo 'selected';?> value="<?php echo $value['id']?>"><?php echo $value['nome']?></option>
			<?php }?>
			</select>
		</div>
		<div class="box-form">
			<label>Titulo</label>
			<input type="text" name="titulo" value="<?php recoverPost('titulo')?>">
		</div>
		<div class="box-form">
			<label>Conteudo</label>
			<textarea class="tinymce" name="conteudo"><?php recoverPost('conteudo')?></textarea>
		</div>
	
		<div class="box-form">
			<label>Imagem</label>
			<input type="file" name="capa">
		</div>
		<div class="box-form">
			<input type="hidden" name="order_id" value="0">
			<input type="hidden" name="nome_tabela" value="pro_portal_noticias">
			<input type="submit" name="acao" value="Adicionar">
		</div>
	</form>
</div>