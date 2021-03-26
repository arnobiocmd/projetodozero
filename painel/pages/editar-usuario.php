<div class="box-content">
	<h2><i class="fa fa-pencil"></i> Editar Usuário</h2>
	<?php
		if(isset($_POST['acao'])){
			$nome = addslashes($_POST['nome']);
			$senha = addslashes($_POST['senha']);
			$imagem = $_FILES['imagem'];
			$imagem_atual = $_POST['imagem_atual'];

			$usuario = new Usuario();

			if($imagem['name'] != ''){
				//fazer uploude imagem
				if(Painel::imagemValida($imagem)){
					$imagem = Painel::uploudeFile($imagem);
					Painel::deleteFile($imagem_atual);
					if($usuario->AtualizarUsuario($senha,$nome,$imagem)){
						$_SESSION['img'] = $imagem;
					Painel::alert('sucesso',' Usuário atualizado com sucesso com imagem!');
					}else{
					Painel::alert('erro',' Erro ao atualizar o Usuario com imagem');
					}

				}else{
					Painel::alert('erro',' Não é uma imagem valida');
				}
				
			}else{
				$imagem = $imagem_atual;

				if($usuario->AtualizarUsuario($senha,$nome,$imagem)){
					Painel::alert('sucesso',' Usuário atualizado com sucesso!');
				}else{
					Painel::alert('erro',' Erro ao atualizar o Usuario');
				}
			}

		}

	?>

	<form method="POST" enctype="multipart/form-data">
		<div class="box-form">
			<label>Nome</label>
			<input type="text" name="nome" required value="<?php echo $_SESSION['nome']?>">
		</div>
		<div class="box-form">
			<label>Senha</label>
			<input type="password" name="senha" required value="<?php echo $_SESSION['password']?>">
		</div>
		<div class="box-form">
			<label>Imagem</label>
			<input type="file" name="imagem">
			<input type="hidden" name="imagem_atual" value="<?php echo $_SESSION['img']?>">
		</div>
		<div class="box-form">
			<input type="submit" name="acao" value="Atualizar">
		</div>
	</form>
</div>