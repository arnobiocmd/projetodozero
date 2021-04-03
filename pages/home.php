
<section class="banner-principal">
	<?php
		$sql = MySql::conectar()->prepare("SELECT * FROM pro_admin_slides ORDER BY order_id ASC LIMIT 4");
		$sql->execute();
		$slides = $sql->fetchAll();
		foreach ($slides as $key => $value) {
		
	?>
		<div style="background-image: url('<?php echo INCLUDE_PATH_PAINEL?>uploads/<?php echo $value['slide']?>');" class="banner-principal-single"></div>
	

	<?php }?>
		<div class="overley"></div>
		<div class="bollets">
			
		</div>
		<div class="center">
			

			<form class="ajax-form" method="POST">
				<h2>Qual seu melhor e-mail?</h2>
				<input type="email" name="email">
				<input type="hidden" name="identificador" value="form_home">
				<input type="submit" name="acao" value="Cadastrar!">
			</form>
		</div>
	</section>
	<section class="descricao-autor">
		<div class="center">
			<div class="left w100">
				<h2 class="text-center"><img src="<?php echo INCLUDE_PATH?>assets/img/imgava.jpg"><?php echo $infoSite['nome_autor']?></h2>
				<p><?php echo $infoSite['descricao_autor']?>.</p>
			</div>
			
			<div class="clear"></div>
		</div>
	</section>
	<section id="sobre" class="especialidas">
		<div class="center">
			<h2 class="title">Especialidades</h2>
			<div class="w33 left box-especialidades">
				<h3><i class="<?php echo $infoSite['icone1']?>" aria-hidden="true"></i></h3>
				<h4>CSS</h4>
				<p><?php echo $infoSite['descricao_icone1']?></p>
			</div>
			<div class="w33 left box-especialidades">
				<h3><i class="<?php echo $infoSite['icone2']?>" aria-hidden="true"></i></h3>
				<h4>HTML</h4>
				<p><?php echo $infoSite['descricao_icone2']?></p>
			</div>
			<div class="w33 left box-especialidades">
				<h3><i class="<?php echo $infoSite['icone3']?>" aria-hidden="true"></i></h3>
				<h4>APPLE</h4>
				<p><?php echo $infoSite['descricao_icone3']?></p>
			</div>
			<div class="clear"></div>
		</div>
	</section>




	<section class="produtos">
		<div class="center">
			<h2 class="title">Promoção da semana</h2>

			<?php
			$sql = MySql::conectar()->prepare("SELECT * FROM pro_admin_produtos ORDER BY order_id ASC LIMIT 3 ");
			$sql->execute();
			$produtos = $sql->fetchAll();

			foreach ($produtos as $key => $value) {
			
			
			?>

			<div class="w33 left box-produtos">
				<div style="background-image: url('<?php echo INCLUDE_PATH_PAINEL?>uploads/<?php echo $value['foto_produto']?>');" class="box-produtos-imagem">
					
				</div>
				<p><?php echo $value['descricao_produto']?></p>
				<p>Valor R$ <?php echo $value['valor']?></p>
			</div>

			<?php }?>
			
			<div class="clear"></div>
		</div>
	</section>


	<section id="servicos" class="extras">
		<div class="center">
			<div class="left w50 depoimento-container">
			<h2 class="title">Depoimentos</h2>
			<?php
			$sql = MySql::conectar()->prepare("SELECT * FROM pro_admin_depoimentos ORDER BY order_id ASC LIMIT 3");
			$sql->execute();
			$depoimentoSite = $sql->fetchAll();
				foreach ($depoimentoSite as $key => $value) {	
			?>
				<div class="depoimento-single">
					<p class="depoimento-descricao"> <?php echo $value['depoimento']?>
					</p>
					<p class="nome-autor"><?php echo $value['nome']?> - <?php echo $value['data']?> </p>
				</div>
				
			<?php }?>
				
			</div>
			<div class=" left w50 servicos-container">
			<h2 class="title">Serviços</h2>
				<div class="servicos">
					<?php 
						$sql = MySql::conectar()->prepare("SELECT * FROM pro_admin_servicos ORDER BY order_id ASC LIMIT 3");
						$sql ->execute();
						$servicos = $sql->fetchAll();
							foreach ($servicos as $key => $value) {
						
					?>
					<ul>
						<li><?php echo $value['servico']?></li>
					
						</ul>
				
				<?php }?>
				</div>
				
			</div>
			<div class="clear"></div>
		</div>
	</section>