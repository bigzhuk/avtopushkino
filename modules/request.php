<div class="request" style="position: absolute; z-index: 2; width: 249px;">
	<div class="left">
		<div class="title">Онлайн запись</div>
		<div class="kladr">	
			<div class ="address">
			<input class="text_input" type="text" id="phone" name="phone" value="Телефон">
			<input class="text_input" type="text" id="user_name" name="user_name" value="Имя">
			<input class="text_input" type="text" id="car_type" name="car_type" value="Марка авто">
			<input class="text_input" type="text" id="wanted_date" name="wanted_date" value="Желаемая дата">
			</div>
		</div>

		<input type="button" id="submit_distance" value="Записаться">
	</div>
</div>

<script>
	$(document).ready(function() {
		$('#submit_distance').on('click', function () {
			var phone = $('#phone').val();
			var user_name = $('#user_name').val();
			var car_type = $('#car_type').val();
			var wanted_date = $('#wanted_date').val();
			$.ajax({
				async: false,
				url: 'modules/send_email.php',
				type: 'POST',
				dataType: 'html',
				data: {
					phone: phone,
					user_name: user_name,
					car_type: car_type,
					wanted_date: wanted_date,
					mail_secret: 'etyI67siujA'
				},
			}).done(function (data) {
				if (data == '3' || data == '4') {
					alert('Заявка отправлена. Оператор сервиса свяжется с вами в блиажйшее время.');
				}
				else if(data == '1') {
					alert('Заявка не отправлена. Вы неверно заполнили телефон.');
				}
				else if(data == '2' || data == '5') {
					alert('Заявка не отправлена. На сервере проводятся технические работы');
				}
			});
		})
	});
</script>