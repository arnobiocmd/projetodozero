<?php verificarPermissaoPagina(2)?>

<div class="box-content">
	<h2><i class="fa fa-user-plus"></i> Adicionar Usuário</h2>
	<?php
		if(isset($_POST['acao'])){	
		 
			$login = addslashes($_POST['login']);
			$senha = addslashes($_POST['senha']);
			$imagem = $_FILES['imagem'];
			$nome = addslashes($_POST['nome']);
			$cargo = addslashes($_POST['cargo']);
			$usuario = new Usuario();	

			if($login == ''){
				Painel::alert('erro',' Você precisa add um Login.');
			}else if($senha == ''){
				Painel::alert('erro',' Você precisa add uma Senha.');
			}else if($nome == ''){
				Painel::alert('erro',' Você precisa add um Nome.');
			}else if($cargo == ''){
				Painel::alert('erro',' Você precisa add um Cargo.');
			}else if($imagem['name'] == ''){
				Painel::alert('erro',' Você precisa selecionar uma Imagem.');
			}else if($cargo > $_SESSION['cargo']){
				Painel::alert('erro',' Você precisa selecionar um cargo menor que o seu.');
			}else if(Painel::imagemValida($imagem) == false){
				Painel::alert('erro',' Essa nãe é uma imagem válida.');
			}else if(Usuario::userExiste($login)){
				Painel::alert('erro',' Usuario ja existe, por favor escolha outro Nome para o Login.');
			}else{
				//posemos fazer o inser no banco
				$imagem = Painel::uploudeFile($imagem);
				if($usuario->adicionarUsuario($login,$senha,$imagem,$nome,$cargo)){
					Painel::alert('sucesso',' Usuário cadastrado com sucesso!');
				}else{
					Painel::alert('erro',' Ocorreu um erro ao cadastrar o Usuario!');
				}
				
			}
				
				

		}

	?>

	<form method="POST" enctype="multipart/form-data">
		<div class="box-form">
			<label>Login</label>
			<input type="text" name="login">
		</div>
		<div class="box-form">
			<label>Nome</label>
			<input type="text" name="nome">
		</div>
		<div class="box-form">
			<label>Senha</label>
			<input type="password" name="senha" >
		</div>
		<div class="box-form">
			<label>Cargo</label>
			<select name="cargo">
			<?php foreach (Painel::$cargos as $key => $value) {
				if($key < $_SESSION['cargo'])  echo '<option value="'.$key.'">'.$value.'</option>';
			}
			?>	
			</select>
		</div>
		<div class="box-form">
			<label>Imagem</label>
			<input type="file" name="imagem">
		</div>
		<div class="box-form">
			<input type="submit" name="acao" value="Adicionar">
		</div>
	</form>
</div>