<?php
	if(isset($_GET['id'])){
		$id = intval($_GET['id']);
		$produtos = Painel::select('pro_admin_produtos','id = ?',array($id));
	}else{
		Painel::alert('erro', ' Você precisa Informar um ID valido');
			die();
	}

?>

<div class="box-content">
	<h2><i class="fa fa-pencil"></i> Editar Produtos</h2>
	<?php
		if(isset($_POST['acao'])){
			$nome = addslashes($_POST['descricao_produto']);
			$valor = str_replace(',','.',addslashes($_POST['valor']));
			$valor = floatval($valor);
			$imagem = $_FILES['imagem'];
			$imagem_atual = $_POST['imagem_atual'];

			if($imagem['name'] != ''){
				//fazer uploude imagem
				if(Painel::imagemValida($imagem)){
					Painel::deleteFile($imagem_atual);
					$imagem = Painel::uploudeFile($imagem);
					$arr = ['descricao_produto'=>$nome,'valor'=>$valor,'foto_produto'=>$imagem,'id'=>$id,'nome_tabela'=>'pro_admin_produtos'];
					Painel::update($arr);
					$produtos = Painel::select('pro_admin_produtos','id = ?',array($id));
					Painel::alert('sucesso',' O produto atualizado com sucesso com imagem!');
				}else{

					Painel::alert('erro',' Não é uma imagem valida');
				}
				
			}else{
				$imagem = $imagem_atual;
					$arr = ['descricao_produto'=>$nome,'valor'=>$valor,'foto_produto'=>$imagem,'id'=>$id,'nome_tabela'=>'pro_admin_produtos'];
				Painel::update($arr);
					$produtos = Painel::select('pro_admin_produtos','id = ?',array($id));
					Painel::alert('sucesso',' O produto foi atualizado com sucesso!');
			}

		}

	?>

	<form method="POST" enctype="multipart/form-data">
		<div class="box-form">
			<label>Nome</label>
			<input type="text" name="descricao_produto" value="<?php echo $produtos['descricao_produto']?>">
		</div>
		<div class="box-form">
			<label>Preço</label>
			<input type="text" name="valor" pattern="[0-9,.]{1,}" value="<?php echo $produtos['valor']?>">
		</div>
		<div class="box-form">
			<label>Imagem</label>
			<input type="file" name="imagem">
			<input type="hidden" name="imagem_atual" value="<?php echo $produtos['foto_produto']?>">
		</div>
		<div class="box-form">
			<input type="submit" name="acao" value="Atualizar">
		</div>
	</form>
</div>