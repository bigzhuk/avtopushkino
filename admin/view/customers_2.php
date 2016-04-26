<?php
require_once(BASE_PATH.'/admin/models/orders.class.php');
require_once(BASE_PATH.'/admin/models/customers.class.php');
require_once(BASE_PATH.'/admin/models/users.class.php');

$order_model = new OrderModel();
$customer_model  = new CustomersModel();
$users_model  = new UsersModel();
$customers_lines = $customer_model->getTableData();
//var_dump($customers_lines); ?>


<input type="button" value="Добавить" id="add_customer">

<input id="fast_filter_2" type="text">
<input id="clean_filter_2" type="button" value="Сбросить">
<div id="filter_count_2">Показано <span id="filter_count_show_2"><?php echo count($customers_lines); ?></span> из <span id="filter_count_total_2"><?php echo count($customers_lines); ?></span></div>

<table class="customers">
	<thead>
		<td>id</td>
		<td>Клиент</td>
		<td>Комапния</td>
		<td>E-Mail</td>
		<td>Телефон</td>
		<td>Статус</td>
		<td>Комментарий</td>
	</thead>

	<tbody>	
		<?php foreach ($customers_lines as $key => $customers_line) { ?>

			<tr class="customer_line filter_line_2">
				<td class="id right"><?php echo $customers_line['id']; ?></td>
				<td class="name"><?php echo $customers_line['name']; ?></td>
				<td class="company"><?php echo $customers_line['company']; ?></td>
				<td class="email"><?php echo $customers_line['email']; ?></td>
				<td class="phone"><?php echo $customers_line['phone']; ?></td>
				<td class="status"><?php echo $customers_line['status']; ?></td>
				<td class="comment_mini"><?php echo $customers_line['comment']; ?></td>
			</tr>

		<?php } ?>
	</tbody>
</table>

<div id="customers_editor">
	<div class="mask"></div>
		<div id="customers_editor_container">	
				<table class="customers_editor_table">
					<thead>
						<tr>
							<td colspan="2">id: <span class="id"></span></td>
						</tr>
					</thead>

					<tbody>	
						<tr>
							<td>Клиент:</td>
							<td><input type="text" class="name"></td>
						<tr>

						<tr>
							<td>Компания:</td>
							<td><input type="text" class="company"></td>
						<tr>

						<tr>
							<td>E-mail:</td>
							<td><input type="text" class="email"></td>
						<tr>

						<tr>
							<td>Телефон:</td>
							<td><input type="text" class="phone"></td>
						<tr>

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
		<input type="button" class="update" value="Сохранить">
		<input type="button" class="delete" value="Удалить">
        <input type="button" class="send" value="Выслать пароль">
	</div>
</div>

