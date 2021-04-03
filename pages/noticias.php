<?php
	$url = explode('/',$_GET['url']);
	if(!isset($url[2])){

		$categoria = MySql::conectar()->prepare("SELECT * FROM pro_portal_categorias WHERE slug =?");
		$categoria->execute(array(@$url[1]));
		$categoria = $categoria->fetch();


?>

<section class="header-noticias">
	<div class="center">
		<h2><i class="fa fa-bell-o" arial-hidden="true"></i></h2>
		<h2>Acompanhe as últimas nóticias do portal</h2>
	</div>
	
</section>

<section class="container-portal">
	<div class="center">
		<div class="sidebar">
			<div class="box-content-sidebar">
				<h3><i class="fa fa-search"></i> Realizar uma busca:</h3>


				<form method="post">
					<input type="text" name="paramentro" placeholder="O que deseja procurar?">
					<input type="submit" name="buscar" value="Pesquisar">
				</form>


			</div>

			<div class="box-content-sidebar">
				<h3><i class="fa fa-list"></i> Selecione a categoria:</h3>
				<form>
					<select>
						<option selected="">Todas as categorias</option>
						<?php 
						$categorias = MySql::conectar()->prepare("SELECT * FROM pro_portal_categorias ORDER BY order_id ASC");
						$categorias->execute();
						$categorias = $categorias->fetchAll();
						foreach ($categorias as $key => $value) {
						?>
						<option <?php if($value['slug'] == @$url[1]) echo 'selected';?> value="<?php echo $value['slug']?>"><?php echo $value['nome']?></option>
						<?php }?>
					</select>
				</form>
			</div>

			<div class="box-content-sidebar">
				<h3><i class="fa fa-user"></i> Sobre o autor:</h3>
				<div class="box-portal">
					<div class="box-img-autor"></div>
					<div class="texto-autor-portal text-center">
						<?php
							$sql = MySql::conectar()->prepare("SELECT * FROM pro_admin_config");
							$sql->execute();
							$infoSite = $sql->fetch();
						?>
						<h3><?php echo $infoSite['nome_autor']?></h3>
						<p><?php echo substr($infoSite['descricao_autor'],0,250).'...'?></p>
					</div>
				</div>
			</div>
			
		</div>

		<div class="conteudo-portal">
			<div class="header-conteudo-portal">
				<?php 
				$porPagina = 2;
				if(!isset($_POST['paramentro'])){ 
					if($categoria['nome'] == ''){
						echo '<h2>Visualizando todos os <span>Posts</span></h2>';
					}else{
						echo '<h2>Visualizando Posts em '.$categoria['nome'].'</h2>';
					}
				}else{
					echo '<h2><i class="fa fa-check"> Busca realizada com sucesso!</i></h2>';
				}
					$query = "SELECT * FROM pro_portal_noticias";
					if($categoria['nome'] != ''){
						$categoria['id'] = (int)$categoria['id'];
					$query.=" WHERE categoria_id = $categoria[id] ";
					}
					if(isset($_POST['paramentro'])){
						if(strstr($query, 'WHERE') !== false){
							$busca = $_POST['paramentro'];
							$query.=" AND titulo LIKE '%$busca%'";
						}else{
							$busca = $_POST['paramentro'];
							$query.=" WHERE titulo LIKE '%$busca%'";
						}
					}


					$query2 = "SELECT * FROM pro_portal_noticias";
					if($categoria['nome'] != ''){
					$categoria['id'] = (int)$categoria['id'];
					$query2.=" WHERE categoria_id = $categoria[id] ";
					}

					if(isset($_POST['paramentro'])){
						if(strstr($query2, 'WHERE') !== false){
							$busca = $_POST['paramentro'];
							$query2.=" AND titulo LIKE '%$busca%'";
						}else{
							$busca = $_POST['paramentro'];
							$query2.=" WHERE titulo LIKE '%$busca%'";
						}
					}

					$totalPagina = MySql::conectar()->prepare($query2);
					$totalPagina->execute();
					$totalPagina = ceil($totalPagina->rowCount() / $porPagina);
					if(!isset($_POST['paramentro'])){

						if(isset($_GET['pagina'])){
							$pagina = (int)$_GET['pagina'];
							if($pagina > $totalPagina){
								$pagina = 1;
							}
							$queryPg = ($pagina - 1) * $porPagina;
							$query.=" ORDER BY order_id ASC LIMIT $queryPg,$porPagina";
						}else{
							$pagina = 1;
							$query.=" ORDER BY order_id ASC LIMIT 0,$porPagina";
						}
				}else{
						$query.=" ORDER BY order_id ASC";
				}


					$sql = MySql::conectar()->prepare($query);
					$sql->execute();
					$noticias = $sql->fetchAll();

				?>

				
			</div>
			<?php foreach ($noticias as $key=>$value) { 
				 $sql = MySql::conectar()->prepare("SELECT slug FROM pro_portal_categorias WHERE id = ? ");
				 $sql->execute(array($value['categoria_id']));
				 $categoriaNome = $sql->fetch()['slug'];
				
			?>
			<div class="box-single-conteudo">
				<h2><?php echo date('d-m-Y',strtotime($value['data'])) ?> - <?php echo $value['titulo']?></h2>
				<p>	<?php echo substr(strip_tags($value['conteudo']),0,500).'...' ?></p>
				<a href="<?php echo INCLUDE_PATH ?>noticias/<?php echo $categoriaNome;?>/<?php echo 
				$value['slug'];?>">Leia mais</a>
			</div>
			<?php }?>

			<?php
			



			
			?>
				
				<div class="paginacao">
						<?php 
						if(!isset($_POST['paramentro'])){
							for ($i=1; $i <= $totalPagina; $i++) { 
								$catStr = $categoria['nome'] ? '/'.$categoria['slug'] : '';
								if($pagina == $i){
									echo '<a class="active-pagina" href="'.INCLUDE_PATH.'noticias'.$catStr.'?pagina='.$i.'">'.$i.'</a>';
								}else{
									echo '<a  href="'.INCLUDE_PATH.'noticias'.$catStr.'?pagina='.$i.'">'.$i.'</a>';
								}
								
								
							}

						}
						?>
					
				</div>
		</div>

		<div class="clear"></div>
		
	</div>
</section>

<?php }else{

	include('noticias_single.php');
}

?>