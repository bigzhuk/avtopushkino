//Стили, эффекты, динамика.

$(document).ready(function() {

	ResizeWindow();

	$('.special_image').on('mouseover', function(){
		$(this).parent().find('.special_text').stop().slideDown(200);
	})

	$('.special_image').on('mouseleave', function(){
		$(this).parent().find('.special_text').stop().delay(200).slideUp(500);
	})

	$('.request_button').on('click', function(){				// Форма заявки
		$('.bg_mask').fadeIn('300');
		$('.request').fadeIn('300');
	})

	$('#request_submit').on('click', function(){
		$('.bg_mask').fadeOut('300');
		$('.request').fadeOut('300');
	})

	$('.bg_mask').on('click', function(){
		$('.bg_mask').fadeOut('300');
		$('.request').fadeOut('300');
	})

	$( "#tabs" ).tabs({});							// Вкладки page = price

	$('.main_menu_item').on('mouseenter', function(){
		$(this).find('ul').stop().fadeIn(150);
	})

	$('.main_menu_item').on('mouseleave', function(){
		$(this).find('ul').stop().fadeOut(150);
	})


	$('td').each(function(){									// Разбиваем числа по разрядам, без пробелов
		$(this).html($(this).text().replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '<span style="margin-right:0.2em">$1</span>'));
	});

	$('.img_right,.img_left').each(function(){							// Танго с бубном для теней в изображениях
		$(this).css('backgroundImage','url(' + $(this).attr('img') + ')');
		$(this).append('<img src='+$(this).attr('img')+'>');
	});

	//$('.inactive_q').on('click', function(){
	$(document).on('click', '.inactive_q',function(){
		$('.question').each(function(){
			$(this).removeClass('active_q');
			$(this).addClass('inactive_q');
			$(this).find('.answer').stop().slideUp(500);
		})
		$(this).removeClass('inactive_q');
		$(this).addClass('active_q');
		$(this).find('.answer').stop().slideDown(500);
	})

	$(document).on('click', '.active_q',function(){
		$('.question').each(function(){
			$(this).removeClass('active_q');
			$(this).addClass('inactive_q');
			$(this).find('.answer').stop().slideUp(500);
		})
	})

	$('#distance_start_town').val('Откуда (город)');
	$('#distance_start_street').val('Откуда (улица)');
	$('#distance_finish_town').val('Куда (город)');
	$('#distance_finish_street').val('Куда (улица)');

	$('.text_input').each(function(index, el) {
		$(el).attr('default_text', $(el).val());
		$(el).on('focus', function(){
			if($(this).val() == $(this).attr('default_text')){
				$(this).val('').addClass('filled');	
			}
		})

		$(el).on('blur', function(){
			if($(this).val() == '' || $(this).val() == $(this).attr('default_text')){
				$(this).val($(this).attr('default_text')).removeClass('filled');
			}
		})

	});	

	$('.main_menu_item').find('a').on('click',function(){
		var val = ($(this).attr('href')).split('#');
		$('.ui-tabs-anchor[href=#' + val[1] + ']').click();
	});


});

$(window).resize(function(){
	ResizeWindow();
})

function ResizeWindow(){										// Центрирование элементов при ресайзе
		$('.center_h').each(function(){
			$(this).css('left',($(window).width() - $(this).width())/2);
		})
		$('.center_v').each(function(){
			$(this).css('top',($(window).height() - $(this).height())/2);
		})
	}