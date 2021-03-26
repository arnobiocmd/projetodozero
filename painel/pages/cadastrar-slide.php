<div class="box-content">
	<h2><i class="fa fa-slideshare"></i> Cadastrar Slide</h2>
	<?php

			if(isset($_POST['acao'])){	
			$imagem = $_FILES['imagem'];
			$nome = addslashes($_POST['nome']);
			if($nome == ''){
				Painel::alert('erro',' O nome precisa está preenchido.');
			}else if($imagem['name'] == ''){
				Painel::alert('erro',' Você precisa selecionar uma Imagem.');
			}else  if(Painel::imagemValida($imagem) == false){
				Painel::alert('erro',' Essa não é uma imagem válida.');
			}else{
				//posemos fazer o inser no banco
				//include('../classes/lib/WideImage.php');
				$imagem = Painel::uploudeFile($imagem);
				//WideImage::load('uploads/'.$imagem)->resize(100)->saveToFile('uploads/'.$imagem);
				$arr = ['nome'=>$nome,'slide'=>$imagem,'order_id'=>'0','nome_tabela'=>'pro_admin_slides'];
				Painel::insert($arr);
				Painel::alert('sucesso',' Usuário cadastrado com sucesso!');
				
			}			

		}

	?>
	<form method="POST" enctype="multipart/form-data">
		<div class="box-form">
			<label>Nome</label>
			<input type="text" name="nome">
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