<?php

/*
class Email{
	
	
	
	
	 function __construct()
	{
		
			$mail = new PHPMailer;

			$mail ->isSMTP();                                      
			$mail ->Host = '162.241.2.88';  				  
			$mail ->SMTPAuth = true;                              
			$mail ->Username = 'contato@apfweb.com.br';                 
			$mail ->Password = 'palmeiras2019';                           
			$mail ->SMTPSecure = 'ssl';                            
			$mail ->Port = 465;                                    

			$mail ->setFrom('contato@apfweb.com.br', 'Arnobio');
			$mail ->addAddress('arnobio@apfweb.com.br','ARNOBIO');
			$mail ->isHTML(true);                                 
			$mail ->CharSet = 'UTF-8';

	
			
		
			$mail ->Subject = 'assunto email';
			$mail ->Body    = 'corpo meu  <b>email</b';
			$mail ->AltBody = 'corpo do meu email';
		

		
			if(!$mail->send()){
				echo "message coult not be sent";
				//echo "Mailer erro ". $mail->ErrorInfo;
			}else{
				echo "message has bem sent";
			}
		
}

}


*/



class Email{
	
	private $mailer;
	
	
	public function __construct($host, $username, $senha,$name)
	{
			$this->mailer = new PHPMailer;

			$this->mailer->isSMTP();                                      
			$this->mailer->Host = $host;  				  
			$this->mailer->SMTPAuth = true;                              
			$this->mailer->Username = $username;                 
			$this->mailer->Password = $senha;                           
			$this->mailer->SMTPSecure = 'ssl';                            
			$this->mailer->Port = 465;                                    

			$this->mailer->setFrom($username,$name);
			$this->mailer->isHTML(true);                                 
			$this->mailer->CharSet = 'UTF-8';

		}

		public function addAddress($email, $nome) {
			$this->mailer->addAddress($email,$nome);
		}
		public function formatarEmail($info){
			$this->mailer->Subject = $info['assunto'];
			$this->mailer->Body    = $info['corpo'];
			$this->mailer->AltBody = strip_tags($info['corpo']);
		}
		public function enviarEmail() {
			if($this->mailer->send()){
				return true;
			}else{
				return false;
			}
		}
   }



?>