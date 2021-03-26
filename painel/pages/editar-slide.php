<?php
	if(isset($_GET['id'])){
		$id = intval($_GET['id']);
		$slide = Painel::select('pro_admin_slides','id = ?',array($id));
	}else{
		Painel::alert('erro', ' Você precisa Informar um ID valido');
			die();
	}

?>

<div class="box-content">
	<h2><i class="fa fa-pencil"></i> Editar Slide</h2>
	<?php
		if(isset($_POST['acao'])){
			$nome = addslashes($_POST['nome']);
			$imagem = $_FILES['imagem'];
			$imagem_atual = $_POST['imagem_atual'];

			if($imagem['name'] != ''){
				//fazer uploude imagem
				if(Painel::imagemValida($imagem)){
					Painel::deleteFile($imagem_atual);
					$imagem = Painel::uploudeFile($imagem);
					$arr = ['nome'=>$nome,'slide'=>$imagem,'id'=>$id,'nome_tabela'=>'pro_admin_slides'];
					Painel::update($arr);
					$slide = Painel::select('pro_admin_slides','id = ?',array($id));
					Painel::alert('sucesso',' O slide atualizado com sucesso com imagem!');
				}else{

					Painel::alert('erro',' Não é uma imagem valida');
				}
				
			}else{
				$imagem = $imagem_atual;
				$arr = ['nome'=>$nome,'slide'=>$imagem,'id'=>$id,'nome_tabela'=>'pro_admin_slides'];
					Painel::update($arr);
					$slide = Painel::select('pro_admin_slides','id = ?',array($id));
					Painel::alert('sucesso',' O slide atualizado com sucesso!');
			}

		}

	?>

	<form method="POST" enctype="multipart/form-data">
		<div class="box-form">
			<label>Nome</label>
			<input type="text" name="nome" required value="<?php echo $slide['nome']?>">
		</div>
		<div class="box-form">
			<label>Imagem</label>
			<input type="file" name="imagem">
			<input type="hidden" name="imagem_atual" value="<?php echo $slide['slide']?>">
		</div>
		<div class="box-form">
			<input type="submit" name="acao" value="Atualizar">
		</div>
	</form>
</div>