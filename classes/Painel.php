<?php

class Painel
{	
	public static $cargos = [
			'0'=>'Normal',
			'1'=>'Sub Administrador',
			'2'=>'Administrador'
		];
	
	public static function logado(){
		return isset($_SESSION['logged']) ? true : false;
	} 

	public static function loggout(){
		setcookie('lembrar',true,time() - 1, '/');
		session_destroy();
		header('Location: '.INCLUDE_PATH_PAINEL);
		die();
	}

	public static function carregarPagina(){
		if(isset($_GET['url'])){
			$url = explode('/', $_GET['url']);
			if(file_exists('pages/'.$url[0].'.php')){
				include('pages/'.$url['0'].'.php');
			}else{
				header('Location: '.INCLUDE_PATH_PAINEL);
				die();
			}
		}else{
			include('pages/home.php');	
		}
	}

	public static function listaUsuariosOnline(){
		self::limparUsuariosOline();
		$sql = MySql::conectar()->prepare("SELECT * FROM pro_admin_online");
		$sql->execute();
		return $sql->fetchAll();
	}

	private static function limparUsuariosOline(){
		$data = date('Y-m-d H:i:s');
		$sql = MySql::conectar()->exec("DELETE FROM pro_admin_online WHERE ultima_acao < '$data' - INTERVAL 1 MINUTE");
	}

	public static function alert($tipo,$mensagem){
		if($tipo == 'sucesso'){
			echo '<div class="box-alert sucesso"><i class="fa fa-check"></i>'.$mensagem.'</div>';
		}else if($tipo == 'erro'){
			echo '<div class="box-alert erro"><i class="fa fa-times"></i>'.$mensagem.'</div>';
		}
	} 

	public static function imagemValida($imagem){
		if($imagem['type'] == 'image/jpeg' ||
		$imagem['type'] == 'image/png' ||
		$imagem['type'] == 'image/jpg'){

		$tamanho = intval($imagem['size'] /1024);
		if($tamanho < 300)
			return true;
		else
			return false;
		}else{
			return false;
		}
			
	}

	public static function uploudeFile($file){
		$formatoAquivo = explode('.',$file['name']);
		$nomeAquivo = uniqid().'.'.$formatoAquivo[count($formatoAquivo) - 1];
		if(move_uploaded_file($file['tmp_name'],BASE_DIR_PAINEL.'/uploads/'.$nomeAquivo)){
			return $nomeAquivo;
		}else{
			return false;
		}
	}

	public static function deleteFile($file){
		@unlink('uploads/'.$file);
	}


	public static function insert($arr){
		$certo = true;
		$nome_tabela = $arr['nome_tabela'];
		$query = "INSERT INTO $nome_tabela VALUES (null";
		foreach ($arr as $key => $value) {
			$nome = $key;
			$valor = $value;
			if($nome == 'acao' || $nome == 'nome_tabela'){
				continue;
			}
			if($valor == ''){
				$certo = false;
				break;
			}

			$query.=",?";
			$paramentros[] = $valor;
		}
		$query.=")";
		if($certo == true){
			$sql = MySql::conectar()->prepare($query);
			$sql->execute($paramentros);
			$lastId = MySql::conectar()->lastInsertId();
			$sql = MySql::conectar()->prepare("UPDATE $nome_tabela SET order_id = ? WHERE id = $lastId");
			$sql->execute(array($lastId));
		}
		
		return $certo;

	}


	public static function update($arr,$sigle = false){
		$primeiro = false;
		$certo = true;
		$nome_tabela = $arr['nome_tabela'];
		$query = "UPDATE $nome_tabela SET ";
		foreach ($arr as $key => $value) {
			$nome = $key;
			$valor = $value;
			if($nome == 'acao' || $nome == 'nome_tabela' || $nome == 'id')
				continue;
			if($valor == ''){
				$certo = false;
				break;
			}
			if($primeiro == false){
				$primeiro = true;
				$query.="$nome=?";
			}else{
				$query.=",$nome=?";
			}
			$paramentros[] = $value;
		}
		
		if($certo == true){
			if($sigle == false){
			$paramentros[] = $arr['id'];
			$sql = MySql::conectar()->prepare($query.'WHERE id = ?');
			$sql->execute($paramentros);
			}else{
			$sql = MySql::conectar()->prepare($query);
			$sql->execute($paramentros);	
			}
			
		}
		
		return $certo;

	}

	public static function selectAll($tabela,$start = null,$end = null){
		if($start == null && $end == null){
			$sql = MySql::conectar()->prepare("SELECT * FROM $tabela ORDER BY order_id ASC");
			
		}else{
			$sql = MySql::conectar()->prepare("SELECT * FROM $tabela ORDER BY order_id ASC LIMIT $start,$end");
			
		}
		$sql->execute();
		return $sql->fetchAll();
	}


	public static function excluir($tabela, $id){
		$sql = MySql::conectar()->prepare("DELETE FROM $tabela WHERE id = $id");
		$sql->execute();
	}

	public static function redirect($url){
		echo '<script>location.href="'.$url.'"</script>';
		die();
	}

		public static function select($table,$query = '',$arr = ''){
			if($query != false){
			$sql = MySql::conectar()->prepare("SELECT * FROM $table WHERE $query");
			$sql->execute($arr);
	
		}else{
			$sql = MySql::conectar()->prepare("SELECT * FROM $table");
			$sql->execute();
		}
			
			return $sql->fetch();
		}

	public static function orderItem($tabela,$orderType,$idItem){
			if($orderType == 'up'){
				$infoItemAtual = Painel::select($tabela,'id=?',array($idItem));
				$order_id = $infoItemAtual['order_id'];
				$itemBefore = MySql::conectar()->prepare("SELECT * FROM $tabela WHERE order_id < 
					$order_id ORDER BY order_id DESC LIMIT 1");
				$itemBefore->execute();
					if($itemBefore->rowCount() == 0)
						return;
				$itemBefore = $itemBefore->fetch();
				Painel::update(array('nome_tabela'=>$tabela,'id'=>$itemBefore['id'],'order_id'=>
					$infoItemAtual['order_id']));
				Painel::update(array('nome_tabela'=>$tabela,'id'=>$infoItemAtual['id'],'order_id'=>
					$itemBefore['order_id']));
			}else if($orderType == 'down'){
				$infoItemAtual = Painel::select($tabela,'id=?',array($idItem));
				$order_id = $infoItemAtual['order_id'];
				$itemBefore = MySql::conectar()->prepare("SELECT * FROM $tabela WHERE order_id > 
					$order_id ORDER BY order_id ASC LIMIT 1");
				$itemBefore->execute();
					if($itemBefore->rowCount() == 0)
						return;
				$itemBefore = $itemBefore->fetch();
				Painel::update(array('nome_tabela'=>$tabela,'id'=>$itemBefore['id'],'order_id'=>$infoItemAtual['order_id']));
				Painel::update(array('nome_tabela'=>$tabela,'id'=>$infoItemAtual['id'],'order_id'=>$itemBefore['order_id']));
			}
		}

		public static function atualizarServicos($servico,$id){
			$sql = MySql::conectar()->prepare("UPDATE pro_admin_servicos SET servico = ? WHERE id = ?");
			if($sql->execute(array($servico,$id))){
				return true;
			}else{
				return false;
			}
		}
	}

	
	
