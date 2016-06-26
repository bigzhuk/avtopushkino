<div class="content_left">
		<?php include('modules/service.php'); ?>
		<?php include('modules/request.php'); ?>
</div>
<div class="content" style="background: url('./images/auto_hr_2.jpg') no-repeat scroll right bottom #fff;">
<div class="title">Контакты</div>
	<p>
		<b><?= COMPANY_NAME ?></b>
	</p>
	<p>
		141207, г.Пушкино, ул. Авиационная, д.15.<br>
		Тел.: <?= implode(', ', $phone_numbers)?> <span style="float:right">Круглосуточная поддержка:</span><br>
		Время работы офиса: 9:00 до 18:00. <span style="float:right">E-mail: <?= EMAIL ?></span>
	</p>
	<div class="contacts_map">
		<script type="text/javascript" charset="utf-8" src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=kwjt6Ik07vIu2EGweoed4rg2ytfhyX9r&width=685&height=513"></script>
	</div>
</div>
