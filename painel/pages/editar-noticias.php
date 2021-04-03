<?php
	if(isset($_GET['id'])){
		$id = intval($_GET['id']);
		$slide = Painel::select('pro_portal_noticias','id = ?',array($id));
	}else{
		Painel::alert('erro', ' Você precisa Informar um ID valido');
			die();
	}

?>

<div class="box-content">
	<h2><i class="fa fa-pencil"></i> Editar Noticias</h2>
	<?php
		if(isset($_POST['acao'])){
			$categoria_id = $_POST['categoria_id'];
			$titulo = addslashes($_POST['titulo']);
			$conteudo = addslashes($_POST['conteudo']);
			$imagem = $_FILES['capa'];
			$imagem_atual = $_POST['imagem_atual'];
			$verificar = MySql::conectar()->prepare("SELECT id FROM pro_portal_noticias WHERE titulo = ? AND categoria_id = ? AND id != ?");
			$verificar->execute(array($titulo,$_POST['categoria_id'],$id));
			if($verificar->rowCount() == 0){

			if($imagem['name'] != ''){
				//fazer uploude imagem
				if(Painel::imagemValida($imagem)){
					Painel::deleteFile($imagem_atual);
					$imagem = Painel::uploudeFile($imagem);
					$slug = Painel::generateSlug($titulo);
	$arr = ['categoria_id'=>$categoria_id,'data'=>date('Y-m-d'),'titulo'=>$titulo,'conteudo'=>$conteudo,'capa'=>$imagem,'slug'=>$slug,'id'=>$id,'nome_tabela'=>'pro_portal_noticias'];
					Painel::update($arr);
					$slide = Painel::select('pro_portal_noticias','id = ?',array($id));
					Painel::alert('sucesso',' A Noticia atualizado com sucesso com imagem!');
				}else{

					Painel::alert('erro',' Não é uma imagem valida');
				}
				
			}else{
				$imagem = $imagem_atual;

				$slug = Painel::generateSlug($titulo);
				$arr = ['categoria_id'=>$categoria_id,'data'=>date('Y-m-d'),'titulo'=>$titulo,'conteudo'=>$conteudo,'capa'=>$imagem,'slug'=>$slug,'id'=>$id,'nome_tabela'=>'pro_portal_noticias'];
					Painel::update($arr);
					$slide = Painel::select('pro_portal_noticias','id = ?',array($id));
					Painel::alert('sucesso',' A Noticia foi atualizado com sucesso!');
			}


		}else{
			Painel::alert('erro',' Ja existe uma noticia com esse nome');
		}

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
				<option <?php if($value['id'] == $slide['categoria_id']) echo 'selected' ?> value="<?php echo $value['id']?>"><?php echo $value['nome']?></option>
			<?php }?>
			</select>
		</div>
		<div class="box-form">
			<label>Titulo</label>
			<input type="text" name="titulo" required value="<?php echo $slide['titulo']?>">
		</div>
		<div class="box-form">
			<label>Conteudo</label>
			<textarea class="tinymce" name="conteudo"><?php echo $slide['conteudo']?></textarea>
		</div>
		<div class="box-form">
			<label>Imagem</label>
			<input type="file" name="capa">
			<input type="hidden" name="imagem_atual" value="<?php echo $slide['capa']?>">
		</div>
		<div class="box-form">
			<input type="hidden" name="order_id" value="0">
			<input type="hidden" name="nome_tabela" value="pro_portal_noticias">
			<input type="submit" name="acao" value="Atualizar">
		</div>
	</form>
</div>