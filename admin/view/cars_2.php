<?php
require_once(BASE_PATH.'/admin/models/cars.class.php');

$cars_model  = new CarsModel();
$cars_lines = $cars_model->getTableData();

//var_dump($cars_lines); ?>

<input type="button" value="Добавить" id="add_car">

<!-- <input id="fast_filter_2" type="text">
<input id="clean_filter_2" type="button" value="Сбросить">
<div id="filter_count_2">Показано <span id="filter_count_show_2"><?php echo count($customers_lines); ?></span> из <span id="filter_count_total_2"><?php echo count($customers_lines); ?></span></div> -->

<table class="cars">
	<thead>
		<td>id</td>
		<td>Водитель</td>
		<td>Телефон</td>
		<td>Номер</td>
	</thead>

	<tbody>	
		<?php foreach ($cars_lines as $key => $cars_line) { ?>

			<tr class="cars_line filter_line_2">
				<td class="id right"><?php echo $cars_line['id']; ?></td>
				<td class="name"><?php echo $cars_line['name']; ?></td>
				<td class="phone"><?php echo $cars_line['phone']; ?></td>
				<td class="number"><?php echo $cars_line['number']; ?></td>
			</tr>

		<?php } ?>
	</tbody>
</table>

<div id="cars_editor">
	<div class="mask"></div>
		<div id="cars_editor_container">	
				<table class="cars_editor_table">
					<thead>
						<tr>
							<td colspan="2">id: <span class="id"></span></td>
						</tr>
					</thead>

					<tbody>	
						<tr>
							<td>Водитель:</td>
							<td><input type="text" class="name"></td>
						<tr>

						<tr>
							<td>Телефон:</td>
							<td><input type="text" class="phone"></td>
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

