<?php
require_once(BASE_PATH.'/admin/models/orders.class.php');
require_once(BASE_PATH.'/admin/models/customers.class.php');
require_once(BASE_PATH.'/admin/models/cars.class.php');
require_once(BASE_PATH.'/admin/models/contracts.class.php');

$order_model = new OrderModel();
$customer_model  = new CustomersModel();
$cars_model = new CarsModel();
$contracts_model = new ContractsModel();

$orders_lines = $order_model->getTableData();
?>
<input type="button" value="Добавить" id="add_order">

<input id="fast_filter_1" type="text">
<input id="clean_filter_1" type="button" value="Сбросить">
<div id="filter_count_1">Показано <span id="filter_count_show_1"><?php echo count($orders_lines); ?></span> из <span id="filter_count_total_1"><?php echo count($orders_lines); ?></span></div>

<table class="orders">
	<thead>
		<td>№ заказа</td>
		<td>Клиент</td>
		<td>№ договора</td>
		<td>№ машины</td>
		<td>Дата добавления</td>
		<td>Пункт отправления</td>
		<td>Пункт назначения</td>
		<td>Статус</td>
		<td>Комментарий</td>
	</thead>

	<tbody>	
		<?php foreach ($orders_lines as $key => $orders_line) { 
			$customer_data  =  $customer_model->getTableDataByField(
		            array('name'),
		            array(
		                array(
		                    'title'=>'id',
		                    'value'=>$orders_line['customer_id']
		                )
		            )
		        );

			$car_data  =  $cars_model->getTableDataByField(
		            array('number'),
		            array(
		                array(
		                    'title'=>'id',
		                    'value'=>$orders_line['car_id']
		                )
		            )
		        );

			$contract_data  =  $contracts_model->getTableDataByField(
		            array('number'),
		            array(
		                array(
		                    'title'=>'id',
		                    'value'=>$orders_line['contract_id']
		                )
		            )
		        );

			$customer_name = isset($customer_data[0]['name'])? $customer_data[0]['name'] : '';
			$car_number = isset($car_data[0]['number'])? $car_data[0]['number'] : '';
			$contract_number = isset($contract_data[0]['number'])? $contract_data[0]['number'] : '';

	        ?>

			<tr class="order_line filter_line_1">
				<td class="id right"><?php echo $orders_line['id']; ?></td>
				<td class="customer_name" id="<?php echo $orders_line['customer_id']; ?>"><?php echo $customer_name; ?></td>
				<td class="contract_number right" id="<?php echo $orders_line['contract_id']; ?>"><?php echo $contract_number; ?></td>
				<td class="car_id right" id="<?php echo $orders_line['car_id']; ?>"><?php echo $car_number; ?></td>
				<td class="date_added right"><?php echo date('d.m.Y', $orders_line['date_added']); ?></td>
				<td class="delivery_from edit"><?php echo $orders_line['delivery_from']; ?></td>
				<td class="delivery_to edit"><?php echo $orders_line['delivery_to']; ?></td>
				<td class="status"><?php echo $orders_line['status']; ?></td>
				<td class="comment_mini"><?php echo $orders_line['comment']; ?></td>
			</tr>
		<?php } ?>
	</tbody>
</table>

<div id="order_editor">
	<div class="mask"></div>
		<div id="order_editor_container">	
			<div class="order_map"></div>
			<div class="kladr">
				<table class="order_editor_table">
					<thead>
						<tr>
							<td colspan="2">№ заказа: <span class="id"></span> customer_id:<span class="customer_id"></span></td>
						</tr>
					</thead>

					<tbody>	
						<tr>
							<td>Клиент:</td>
							<td>
								<select type="text" class="customer_name">
								</select>
							</td>
						<tr>

						<tr>
							<td>№ договора:</td>
							<td>
								<select type="text" class="contract_number">
								</select>
							</td>
						<tr>

						<tr>
							<td>№ машины:</td>
							<td><select type="text" class="car_id">
								</select></td>
						<tr>

						<tr>
							<td>Дата добавления:</td>
							<td><input type="text" class="date_added"></td>
						<tr>
							
						<tr>
							<td colspan="2">Откуда:</td>
						<tr>

						<tr>
							<td>Город:</td>
							<td><input class="delivery_from_0" type="text" name="from_0"></td>
						</tr>

						<tr>
							<td>Улица:</td>
							<td><input class="delivery_from_1" type="text" name="from_1"></td>
						</tr>

						<tr>
							<td>Дом:</td>
							<td><input class="delivery_from_2" type="text" name="from_2"></td>
						</tr>

						<tr>
							<td colspan="2">Куда:</td>
						<tr>

						<tr>
							<td>Город:</td>
							<td><input class="delivery_to_0" type="text" name="to_0"></td>
						</tr>

						<tr>
							<td>Улица:</td>
							<td><input class="delivery_to_1" type="text" name="to_1"></td>
						</tr>

						<tr>
							<td>Дом:</td>
							<td><input class="delivery_to_2" type="text" name="to_2"></td>
						</tr>

						<tr>
							<div id="kladr_autocomplete">
								<ul class="kladr_autocomplete_location" style="display: none;"></ul>
								<div class="spinner kladr_autocomplete_location_spinner" style="display: none;"></div>
								<ul class="kladr_autocomplete_street" style="display: none;"></ul>
								<div class="spinner kladr_autocomplete_street_spinner" style="display: none;"></div>
							</div>
						</td>

						<tr>
							<td>Статус:</td>
							<td>
								<select type="text" class="status">
									<option selected value="0">Новый</option>
									<option value="1">Выполняется</option>
									<option value="2">Завершен</option>
									<option value="3">Отменен</option>
								</select>
							</td>
						<tr>

						<tr>
							<td colspan="2"><textarea class="comment"></textarea></td>
						<tr>

					</tbody>
				</table>
			</div>
		<input type="button" class="update" value="Сохранить">
		<input type="button" class="delete" value="Удалить">
	</div>
</div>

<script>

		$(document).ready(function() {

			$(".date_added").datepicker({ dateFormat: "dd.mm.yy"});

			var avalibleCustomers = $.ajax({
				url: './controllers/customers.class.php',
				type: 'POST',
				dataType: 'json',
				data: {button_click: 'getAutocomplete'},
			})
			.done(function(data) {

				var autocompleteCustomers = Array();
				var autocompleteCustomersIds = Array();


				$(data).each(function(key, val) {
					autocompleteCustomers[key] = val.name;		
					autocompleteCustomersIds[key] = val.id;
				});


				$('.order_editor_table').find('.customer_name').autocomplete({
			 		source: autocompleteCustomers,
			 		select: function(event, ui) {				// Получаем айдишники и имена клиентов 
			 			j = autocompleteCustomers.indexOf(ui.item.label);
			 			customer_id = autocompleteCustomersIds[j];
			 			$('.customer_id').html(customer_id);

			 			var avalibleContracts = $.ajax({
							url: './controllers/contracts.class.php',
							type: 'POST',
							dataType: 'json',
							data: {button_click: 'getAutocomplete', where: customer_id},
						})
						.done(function(data) {

							console.log(data);
							var autocompleteContracts = Array();
							var autocompleteContractsIds = Array();

							$(data).each(function(key, val) {
								autocompleteContracts[key] = val.number;
								autocompleteContractsIds[key] = val.id;
							});
							$('.order_editor_table').find('.contract_number').autocomplete({
						 		source: autocompleteContracts,
						 		select: function(event, ui) {				// Получаем айдишники и имена клиентов 
						 			j = autocompleteContracts.indexOf(ui.item.label);
						 			contract_id = autocompleteContractsIds[j];
						 			//console.log(contract_id);
						 			$('.contract_number').attr('id', contract_id);
						 		},
						 	});
						});

			 		},
			 	});
			});



			

			var avalibleCars = $.ajax({
				url: './controllers/cars.class.php',
				type: 'POST',
				dataType: 'json',
				data: {button_click: 'getAutocomplete'},
			})
			.done(function(data) {
				var autocompleteCars = Array();
				$(data).each(function(key, val) {
					autocompleteCars[key] = val.number;
				});
				$('.order_editor_table').find('.car_id').autocomplete({
			 		source: autocompleteCars
			 	});
			});

			
			

			// var avalibleCars = $.getJSON('./controllers/cars.class.php', {button_click: 'getAutocomplete'}, function(json) {

			  	
			 	//console.log(json.name);
			// });
		});
		
		 

	var container = $('.kladr');
        
        container.find('[name="from_0"]').kladr({
            token: '51dfe5d42fb2b43e3300006e',
            key: '86a2c2a06f1b2451a87d05512cc2c3edfdf41969',
            type: $.kladr.type.city,
            select: function( obj ){
                container.find('[name="from_1"]' ).kladr('parentId', obj.id);
            }
        });

        container.find( '[name="from_1"]' ).kladr({
            token: '51dfe5d42fb2b43e3300006e',
            key: '86a2c2a06f1b2451a87d05512cc2c3edfdf41969',
            type: $.kladr.type.street,
            parentType: $.kladr.type.city
        });

        container.find('[name="to_0"]').kladr({
            token: '51dfe5d42fb2b43e3300006e',
            key: '86a2c2a06f1b2451a87d05512cc2c3edfdf41969',
            type: $.kladr.type.city,
            select: function( obj ){
                container.find('[name="to_1"]' ).kladr('parentId', obj.id);
            }
        });

        container.find( '[name="to_1"]' ).kladr({
            token: '51dfe5d42fb2b43e3300006e',
            key: '86a2c2a06f1b2451a87d05512cc2c3edfdf41969',
            type: $.kladr.type.street,
            parentType: $.kladr.type.city
        });

</script>

