<?php
	include('../config.php');
	$data = [];
	$assunto = "Email enviado pelo contato do site";
	$corpo = '';
	foreach ($_POST as $key => $value) {
	$corpo.=ucfirst($key).": ".$value;
	$corpo.='<hr>';
	}
	$info = ['assunto'=>$assunto,'corpo'=>$corpo];
	$mail = new Email('162.241.2.88','contato@apfweb.com.br','palmeiras2019','Arnobio');
	$mail->addAddress('arnobio@apfweb.com.br','ARNOBIO');
	$mail->formatarEmail($info);
	if($mail->enviarEmail()){
		$data['sucesso'] = true;
	}else{
		$data['erro'] = true;
	}

	

	die(json_encode($data));
?>