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
})