<?php
require_once(BASE_PATH.'/admin/models/contracts.class.php');
//require_once($_SERVER['DOCUMENT_ROOT'].'/auto/admin/models/customers.class.php');

//$order_model = new OrderModel();
$contracts_model  = new ContractsModel();
$contracts_lines = $contracts_model->getTableData();

//var_dump($cars_lines); ?>

<input type="button" value="Добавить" id="add_contract">

<!-- <input id="fast_filter_2" type="text">
<input id="clean_filter_2" type="button" value="Сбросить">
<div id="filter_count_2">Показано <span id="filter_count_show_2"><?php echo count($customers_lines); ?></span> из <span id="filter_count_total_2"><?php echo count($customers_lines); ?></span></div> -->

<table class="contracts">
	<thead>
		<td>id</td>
		<td>Дата</td>
		<td>Клиент</td>
		<td>Номер договора</td>
	</thead>

	<tbody>	
		<?php foreach ($contracts_lines as $key => $contracts_line) { 

		$customer_data  =  $customer_model->getTableDataByField(
		            array('name'),
		            array(
		                array(
		                    'title'=>'id',
		                    'value'=>$contracts_line['customer_id']
		                )
		            )
		        );

			//var_dump($customer_data);
			$customer_name = isset($customer_data[0]['name'])? $customer_data[0]['name'] : '';
	        ?>

			<tr class="contracts_line filter_line_2">
				<td class="id right"><?php echo $contracts_line['id']; ?></td>
				<td class="contract_sign_date right"><?php echo date('d.m.Y', $contracts_line['contract_sign_date']); ?></td>
				<td class="customer_name" id="<?php echo $contracts_line['customer_id']; ?>"><?php echo $customer_name; ?></td>
				<td class="number"><?php echo $contracts_line['number']; ?></td>
			</tr>

		<?php } ?>
	</tbody>
</table>

<div id="contracts_editor">
	<div class="mask"></div>
		<div id="contracts_editor_container">	
				<table class="contracts_editor_table">
					<thead>
						<tr>
							<td colspan="2">id: <span class="id"></span></td>
						</tr>
					</thead>

					<tbody>	
						<tr>
							<td>Дата:</td>
							<td><input type="text" class="contract_sign_date"></td>
						<tr>

						<tr>
							<td>Клиент:</td>
							<td>
								<select class="customer_name">
								</select>
							</td>
						<tr>

						<tr>
							<td>Номер:</td>
							<td><input type="text" class="number"></td>
						<tr>

					</tbody>
				</table>
		<input type="button" class="update" value="Сохранить">
		<input type="button" class="delete" value="Удалить">
	</div>
</div>

<script>
	$(document).ready(function() {

		$(".contract_sign_date").datepicker({ dateFormat: "dd.mm.yy"});

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

				$('.contracts_editor_table').find('.customer_name').autocomplete({
			 		source: autocompleteCustomers,
			 		select: function(event, ui) {				// Получаем айдишники и имена клиентов 
			 			j = autocompleteCustomers.indexOf(ui.item.label);
			 			customer_id = autocompleteCustomersIds[j];
			 			$('.customer_name').attr('id', customer_id);
			 		},
			 	});
			});
	});
</script>