<?php
		if(isset($_GET['id'])){
			$id = intval($_GET['id']);
			$categoria = Painel::select('pro_portal_categorias','id = ?',array($id));

		}else{
			Painel::alert('erro', ' Você precisa Informar um ID valido');
			die();
		}

?>
<div class="box-content">
	<h2><i class="fa fa-pencil"></i> Editar Depoimento</h2>
	<?php
		if(isset($_POST['acao'])){
				$slug = Painel::generateSlug($_POST['nome']);
				$arr = array_merge($_POST,array('slug'=>$slug));
				$verifica = MySql::conectar()->prepare("SELECT * FROM pro_portal_categorias WHERE nome = ? AND id != ?");
				$verifica->execute(array($_POST['nome'],$id));

				if($verifica->rowCount() == 1){
					Painel::alert('erro',' Ja existe uma Categoria com esse nome!');
				}else{
						if(Painel::update($arr)){
					Painel::alert('sucesso',' A categoria foi atualizado com sucesso!');
					$categoria = Painel::select('pro_portal_categorias','id = ?',array($id));
				}else{
					Painel::alert('erro', ' Erro ao atualizar o dcategoria');
				}

			}
				
		}		
	?>
	<form method="POST">
		<div class="box-form">
			<label>Categoria</label>
			<input  type="text" name="nome" value="<?php echo $categoria['nome']?>">
		</div>

		<div class="box-form">
			<input type="hidden" name="id" value="<?php echo $id?>">
			<input type="hidden" name="nome_tabela" value="pro_portal_categorias">
			<input type="submit" name="acao" value="Editar">
		</div>
	</form>
</div>