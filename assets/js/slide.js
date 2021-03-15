$(function(){
	var curSlide = 0;
	var maxSlide = $('.banner-principal-single').length - 1;
	var delay = 3000;


	changeSlide();
	initSlide();

	function initSlide(){
		$('.banner-principal-single').hide();
		$('.banner-principal-single').eq(0).show();
		for (var i = 0; i < maxSlide+1; i++) {
			var content = $('.bollets').html();
			if(i == 0)
			content+='<span class="select-bollets"></span>';
			else
				content+='<span></span>';
			$('.bollets').html(content);
		}
	}

	function changeSlide(){
		setInterval(function(){
			$('.banner-principal-single').eq(curSlide).stop().fadeOut(2000);
			curSlide++;
			if(curSlide > maxSlide)
			curSlide = 0;
			$('.banner-principal-single').eq(curSlide).stop().fadeIn(2000);
			$('.bollets span').removeClass('select-bollets');
			$('.bollets span').eq(curSlide).addClass('select-bollets');
		},delay);
		
	}
	$('body').on('click','.bollets span',function(){
			var currentBollets = $(this);
			$('.banner-principal-single').eq(curSlide).stop().fadeOut(1000);
			curSlide = currentBollets.index();
			$('.banner-principal-single').eq(curSlide).stop().fadeIn(1000);
			$('.bollets span').removeClass('select-bollets');
			currentBollets.addClass('select-bollets');
			
		})
})