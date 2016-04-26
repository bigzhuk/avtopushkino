<script src="js/kladr.js" type="text/javascript"></script>

<!-- <div class="distance">
	<div class="distance_button_off"></div>
	<input type="submit" id="submit-0_distance" value="Построить маршрут">
	<div class="title">Расчет расстояния</div>
	<input type="text" id="distance_start" value="Москва">
	<input type="text" id="distance_finish" value="Караганда">
	<center>
		<a href="" class="full"><span style="font-size:16px">введите данные</span></a>
	</center>	
</div> -->
		<div id="request_mask" class="mask"></div>

<div class="request" style="position: absolute; z-index: 2; width: 249px;">
	<div id="hidden_map"></div>
		

	<div class="left">
		<div class="title">Онлайн-калькулятор</div>
		<div class="kladr">	
			<div class ="address">
			<input class="text_input" type="text" name="location_1" id="distance_start_town" value="Откуда (город)">
			<input class="text_input" type="text" name="street_1" id="distance_start_street" value="Откуда (улица)">
			<input class="text_input" type="text" name="location_2" id="distance_finish_town" value="Куда (город)">
			<input class="text_input" type="text" name="street_2" id="distance_finish_street" value="Куда (улица)">
			</div>
			<div id="kladr_autocomplete">
				<ul class="kladr_autocomplete_location" style="display: none;"></ul>
				<div class="spinner kladr_autocomplete_location_spinner" style="display: none;"></div>
				<ul class="kladr_autocomplete_street" style="display: none;"></ul>
				<div class="spinner kladr_autocomplete_street_spinner" style="display: none;"></div>
			</div>
		</div>

		<!-- <div class="kladr_2">	
			<div class ="address">
			<input type="text" name="location_2" id="distance_finish_town" value="Москва">
			<input type="text" name="street_2" id="distance_finish_street" value="">
			</div>
			<div id="kladr_autocomplete">
				<ul class="kladr_autocomplete_location" style="display: none; top: 58px; left: 762.5px; width: 300px;"></ul>
				<div class="spinner kladr_autocomplete_location_spinner" style="display: none; top: 34.5px; left: 1042.5px;"></div>
				<ul class="kladr_autocomplete_street" style="display: none; top: 96px; left: 762.5px; width: 300px;"></ul>
				<div class="spinner kladr_autocomplete_street_spinner" style="display: none; top: 72.5px; left: 1042.5px;"></div>
			</div>
		</div> -->
		<div id="distance_result" class="distance_hidden"></div>


		<select style="margin-top:10px; width: 229px" id="distance_mass" class="distance_hidden" >
			<option selected value="1">1 тонна</option>
			<option value="2">1,5 тонны</option>
			<option value="3">3 тонны</option>
			<option value="4">5 тонн</option>
			<option value="5">10 тонн</option>
			<option value="6">20 тонн</option>
		</select>

		<select style="margin-top:10px; width: 229px" id="distance_size" class="distance_hidden" >
			<option selected value="1">от 0 до 7 м</option>
			<option value="2">от 7 до 10 м</option>
			<option value="3">от 10 до 14 м</option>
			<option value="4">от 14 до 18 м</option>
			<option value="5">от 18 до 30 м</option>
			<option value="6">от 30 до 45 м</option>
			<option value="7">от 45 до 82 м</option>
		</select>

		<!-- <input style="margin-top:10px" type="text"  class="distance_hidden text_input" id="distance_mass" value="Масса груза"> -->
		<!-- <input type="text" id="distance_size" class="distance_hidden text_input" value="Объем"> -->
		<div id="price_result" class="distance_hidden"></div>
		<div class="text distance_hidden">Указана приблизительная стоимость! Для точной оценки рекомендуем отправить заявку нашему менеджеру:</div>
		<input type="text" id="email" value="e-mail" class="distance_hidden text_input" >
		<input type="text" id="phone" value="Телефон" class="distance_hidden text_input" >
		<input type="button" id="submit_distance" value="Рассчитать">
        <input type="button" id="send_application" value="Отправить заявку" style="display: none">

	</div>
</div>

<script>
	$(document).ready(function() {

		if ($('#submit_distance').parents('.content_right').length === 0){
			var left = true;
		}

		$('#submit_distance').on('click', function(){

			if ($('#distance_start_town').hasClass('filled') && $('#distance_start_town').hasClass('filled')){

				$('#request_mask').fadeIn(500);



				var start = $('#distance_start_town').val();
				if ($('#distance_start_street').hasClass('filled')){
					start += ' ' + $('#distance_start_street').val();
				}


				finish = $('#distance_finish_town').val();
				if ($('#distance_finish_street').hasClass('filled')){
					finish += ' ' + $('#distance_finish_street').val();
				}
				
				$.ajax({
					async: false,
					url: 'modules/distance_ajax.php',
					type: 'POST',
					dataType: 'html',
					data: {start: start, finish: finish},
				}).done(function(data) {

					$('#hidden_map').html(data);

					ymaps.ready(init);
					if (left){
						$('.request').animate({width: '980', height: '546'},500);
					} else {
						$('.request').animate({width: '980', height: '546', marginLeft: '-730'},500);
					}



					$('.distance_hidden').slideDown(500);
                    $('#submit_distance').val('');
                    $('#submit_distance').addClass('submit_distance_mini');

					$('#send_application').show();
					//$(document).on('click', '#send_application', function(){
                   $('#send_application').on('click', function(){
                           var email = $('#email').val();
                           var phone = $('#phone').val();
                           var city_from = $('#distance_start_town').val();
                           var street_from = $('#distance_start_street').val();
                           var city_to = $('#distance_finish_town').val();
                           var street_to = $('#distance_finish_street').val();
                        $.ajax({
                            async: false,
                            url: 'modules/send_email.php',
                            type: 'POST',
                            dataType: 'html',
                            data: {
                                   email: email,
                                   phone: phone,
                                   city_from: city_from,
                                   street_from:street_from,
                                   city_to: city_to,
                                   street_to: street_to
                            },
                        })
                            .done(function(data) {
                                if(data=='1'){
                                    alert('Заявка отправлена. Оператор свяжется с вами в блиажйшее время.');
                                }
                            });
                    });


				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});

			} else {
				alert('Укажите город отправления и прибытия');
			}
			
		})

		$(document).on('click', '#request_mask', function(){ 		// Отчего-то ругается "TypeError: $(...).on is not a function" Но работает =\
			$('#request_mask').fadeOut(500);
			$('#hidden_map').html('');
			if (left){
				$('.request').animate({width: '249', height: '250'},500);
			} else {
				$('.request').animate({width: '249', height: '250', marginLeft: '0'},500);
			}
			$('.distance_hidden').slideUp(500);
            $('#submit_distance').removeClass('submit_distance_mini');
            $('#submit_distance').val('Рассчитать');
			$('#send_application').hide();
		});

		$(document).on('click', '.distance_button_off', function(){
			$(this).parent().stop().animate({marginLeft: '280px'}, 350,function(){
				//$(this).css('z-index','3').animate({marginLeft: '-30px'}, 350);
			});
			$(this).removeClass('distance_button_off').addClass('distance_button_on');
		});

		$(document).on('click', '.distance_button_on', function(){
			$(this).parent().stop().animate({marginLeft: '-30px'}, 350,function(){
				//$(this).css('z-index','1').animate({marginLeft: '-30px'}, 350);
			});
			$(this).removeClass('distance_button_on').addClass('distance_button_off');
		});

		var container = $('.kladr');
        
        // Автодополнение населённых пунктов
        container.find( '[name="location_1"]' ).kladr({
            token: '51dfe5d42fb2b43e3300006e',
            key: '86a2c2a06f1b2451a87d05512cc2c3edfdf41969',
            type: $.kladr.type.city,
            select: function( obj ) {
                // Изменения родительского объекта для автодополнения улиц
                container.find( '[name="street_1"]' ).kladr('parentId', obj.id);
            }
        });

        // Автодополнение улиц
        container.find( '[name="street_1"]' ).kladr({
            token: '51dfe5d42fb2b43e3300006e',
            key: '86a2c2a06f1b2451a87d05512cc2c3edfdf41969',
            type: $.kladr.type.street,
            parentType: $.kladr.type.city
        });

        container.find( '[name="location_2"]' ).kladr({
            token: '51dfe5d42fb2b43e3300006e',
            key: '86a2c2a06f1b2451a87d05512cc2c3edfdf41969',
            type: $.kladr.type.city,
            select: function( obj ) {
                // Изменения родительского объекта для автодополнения улиц
                container.find( '[name="street_2"]' ).kladr('parentId', obj.id);
            }
        });

        // Автодополнение улиц
        container.find( '[name="street_2"]' ).kladr({
            token: '51dfe5d42fb2b43e3300006e',
            key: '86a2c2a06f1b2451a87d05512cc2c3edfdf41969',
            type: $.kladr.type.street,
            parentType: $.kladr.type.city
        });


	});
</script>


