<?php
$usuariosOline = Painel::listaUsuariosOnline();


$contadorVisitasTotal = MySql::conectar()->prepare("SELECT * FROM pro_admin_visitas");
$contadorVisitasTotal->execute();
$contadorVisitasTotal = $contadorVisitasTotal->rowCount();

$contadorVisitasHoje = MySql::conectar()->prepare("SELECT * FROM pro_admin_visitas WHERE dia = ?");
$contadorVisitasHoje->execute(array(date('Y-m-d')));
$contadorVisitasHoje = $contadorVisitasHoje->rowCount();

?>

<div class="box-content w100">
			<h2><i class="fa fa-home"></i> Painel de Controle - <?php echo NOME_EMPRESA?></h2>
			<div class="box-metricas">
				<div class="box-metricas-single">
					<div class="box-metricas-wraper">
						<h2>Usuarios Online</h2>
						<p><?php echo count($usuariosOline)?></p>
					</div>
				</div>
				<div class="box-metricas-single">
					<div class="box-metricas-wraper">
						<h2>Total de Visitas</h2>
						<p><?php echo $contadorVisitasTotal?></p>
					</div>
				</div>
				<div class="box-metricas-single">
					<div class="box-metricas-wraper">
						<h2>Visitas Hoje</h2>
						<p><?php echo $contadorVisitasHoje?></p>
					</div>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<div class="box-content w100">
			<h2><i class="fa fa-rocket"></i> Usuario Online no Site</h2>
			<div class="tabela-response">
				<div class="row">
					<div class="col">
						<span>IP</span>
					</div>
					<div class="col">
						<span>Ultima Ação</span>
					</div>
						<div class="clear"></div>
				</div>
			<?php
				foreach ($usuariosOline as $key => $value) {
				
			 ?>
				<div class="row">
					<div class="col">
						<span><?php echo $value['ip']?></span>
					</div>
					<div class="col">
						<span><?php echo date('d/m/Y H:i:s', strtotime($value['ultima_acao'])) ?></span>
					</div>
						<div class="clear"></div>
				</div>
			<?php }?>
			</div>
		</div>

		<div class="box-content w100">
			<h2><i class="fa fa-rocket"></i> Usuario do Painel</h2>
			<div class="tabela-response">
				<div class="row">
					<div class="col">
						<span>Nome</span>
					</div>
					<div class="col">
						<span>Cargo</span>
					</div>
						<div class="clear"></div>
				</div>
			<?php
				$usuariosPainel = MySql::conectar()->prepare("SELECT * FROM pro_admin_usuario");
				$usuariosPainel->execute();
				if($usuariosPainel->rowCount() > 0){
					$usuariosPainel = $usuariosPainel->fetchAll();
				}

				foreach ($usuariosPainel as $key => $value) {
				
			 ?>
				<div class="row">
					<div class="col">
						<span><?php echo $value['nome']?></span>
					</div>
					<div class="col">
						<span><?php echo pegarCargo($value['cargo']) ?></span>
					</div>
						<div class="clear"></div>
				</div>
			<?php }?>
			</div>
		</div>
		<!--<div class="box-content w50 left">
			
		</div>
		<div class="box-content w50 rigth">
			
		</div>-->