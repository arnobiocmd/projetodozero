$(function(){

	var open = true;

	var windowSize = $(window)[0].innerWidth;

	if(windowSize <= 768){
		$('.menu').css('width','0');
		open = false;
	}

	$('.menu-btn').click(function(){
		if(open){
			//o menu esta aberto precisamos fechar
			$('.menu').animate({'width':'0'},function(){
				open = false;
			});
			$('.content,header').css('width','100%');
			$('.content,header').animate({'left':'0'}, function(){
				open = false;
			});
		}else{
			//o menu esta fechado precisamos abrir
			$('.menu').css('display','block');
			$('.menu').animate({'width':'300px'},function(){
				open = true;
			});
			$('.content,header').css('width','calc(100% - 300px)');
			$('.content,header').animate({'left':'300px'}, function(){
				open = true;
			});
		}
	})


		$(window).resize(function(){
			windowSize = $(window)[0].innerWidth;
			if(windowSize <= 768){
				$('.menu').css('width','0');
				$('.content,header').css('width','100%').css('left','0');
				open = false;
			}else{
				
				$('.content,header').css('width','calc(100% - 300px)').css('left','300px');
				$('.menu').css('width','300px');
				open = true;
			}
		})

		$('[actionBtn=confirme]').click(function(){
			var txt = confirm("Deseja Realmente Excluir o Registro?")
			if(txt  == true){
				return true;
			}else{
				return false;
			}
		})


	$('[formato=data]').mask('99/99/9999');


})