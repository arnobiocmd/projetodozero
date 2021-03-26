$(function(){
	$('.menu-mobile').click(function(){
		var listaMenu = $('.menu-mobile').find('ul');
		
		if(listaMenu.is(':hidden') == true){
			var icone = $('.menu-btn').find('i');
			icone.removeClass('fa-bars');
			icone.addClass('fa-times');
			listaMenu.slideToggle(600);
		}else{
			var icone = $('.menu-btn').find('i');
			icone.removeClass('fa-times');
			icone.addClass('fa-bars');
			listaMenu.slideToggle(600);
			
		}
	})

	if($('target').length > 0){
		var elemento = '#'+$('target').attr('target');
		var divScroll = $(elemento).offset().top;
		$('html,body').animate({'scrollTop':divScroll},2000);
	}
	carregaPagina();
	function carregaPagina(){
		$('[realtime]').click(function(){
			var pagina = $(this).attr('realtime');
			$('.principal').hide();
			$('.principal').load(include_path+'pages/'+pagina+'.php');

			setTimeout(function(){
			initialize();
			addMarker(-11.883488,-55.479697,'',"Minha casa",undefined,false);
			},1000);
			$('.principal').fadeIn(1000);
			window.history.pushState('','',pagina);
			return false;


		})
	}
	//carregaDinamico();	
	function carregaDinamico(){
		var atual = - 1;
		var maximo = $('.box-especialidades').length - 1;
		var time;
		var derlay = 3;

		$('.box-especialidades').hide();
		time = setInterval(carregaBox,derlay*1000);
		function carregaBox(){
			atual++;
			if(atual > maximo){
				clearInterval(time);
				return false;
			}

		$('.box-especialidades').eq(atual).fadeIn(1000);	
		}

		
	}

})