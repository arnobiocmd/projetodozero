$(function(){
	$('body').on('submit','form',function(e){
		var form = $(this).serialize();
		$.ajax({
			beforeSend:function(){
				$('.loader-ajax').fadeIn();
			},
			url:include_path+'ajax/formulario.php',
			type:'POST',
			dataType:'json',
			data:form
		}).done(function(data){
			if(data.sucesso){
				$('.loader-ajax').fadeOut();
				$('.sucesso').fadeIn();
				setTimeout(function(){
				$('.sucesso').fadeOut()	;
				},3000);
				
			}else{
				$('.loader-ajax').fadeOut();
				$('.erro').fadeIn();
				setTimeout(function(){
				$('.erro').fadeOut();	
				},3000);
				
			}
		});
		e.preventDefault();
	})
})