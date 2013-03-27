$(document).ready(function(){
	menu_toggle();
	$('.bxslider').bxSlider({
	  mode: 'fade'
	});
	slider_width();
	if($('.main .girls').length > 0){
		$('.main .girls').first().css('padding-left','0');
	}
	if($('.main .newest_item').length > 0){
		$('.main .newest_item').last().css('border','none');
		$('.main .newest_item').last().css('padding-bottom','44px');
	}	
	$('.header_menu .submenu ul li a').append('<span class="menu_left"></span><span class="menu_right"></span>');
	//rating
	$(".basic").jRating();
});
function menu_toggle(){
	$('.header_menu ul li a.active').siblings().css('display','block');
	$('.header_menu ul li a.active').children().css('display','block');
	$('.header_menu ul li a').click(function(){
		$('.header_menu ul li a').removeClass('active');
		$(this).addClass('active');
		$('.header_menu ul li a').siblings().css('display','none');
		$('.header_menu ul li a').children().css('display','none');
		if($(this).siblings().length > 0){
			$(this).siblings().css('display','block');
			$(this).children().css('display','block');
		}
	});
}
function slider_width(){
	var items = $('.bx-wrapper .bx-pager-item').length;
	width = 14 * items;
	$('.bx-wrapper .bx-pager').width(width);
}