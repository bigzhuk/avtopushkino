<?php
session_start();
$phone_numbers = ['+7(926)464-98-98, +7(903)167-99-07'];
define ("EMAIL", "<script type=\"text/javascript\">eval(unescape('%64%6f%63%75%6d%65%6e%74%2e%77%72%69%74%65%28%27%3c%61%20%68%72%65%66%3d%22%6d%61%69%6c%74%6f%3a%61%76%74%6f%70%75%73%68%6b%69%6e%6f%40%6d%61%69%6c%2e%72%75%22%3e%61%76%74%6f%70%75%73%68%6b%69%6e%6f%40%6d%61%69%6c%2e%72%75%3c%2f%61%3e%27%29%3b'))</script>");

define("BODY_REPAIR",  "Кузовной ремонт");
define("ELECTRICS",  "Электрика");
define("TRANSMISSION_REPAIR",  "Ремонт трансмиссии");
define("TIRE_SERVICE",  "Шиномонтаж");
define("EVACUATOR",  "Эвакуатор");
define("COMPANY_NAME", "ООО «Авто-Пушкино»");

?>
<div class="header">

	<div class="header_top">
		<div class="center_top" >
			<a class="header_left" href="?page=home">	
				<div style="background: url('images/logo.png') no-repeat scroll center center transparent; margin-left: 10px; margin-top:5px; margin-right: 20px" class="logo"></div>
			</a>

			<div class="phone" style="padding-top:6px">
				8 (499) 394-32-25<br>
				8 (495) 778-75-07<br>
				<span class="mail_header">
					<?= EMAIL ?>
				</span>
			</div>
		</div>
	</div>

	<div class="header_bottom">
		<div class="main_menu">	

			<div class="separator"></div>	

			<div class="main_menu_item">	
				<a href="?page=home" class='button<?php if($_GET['page'] == 'home' || !isset($_GET['page'])){ echo ' active'; }?>'>Главная</a>
			</div>

			<div class="separator"></div>

			<div class="main_menu_item">	
				<a href="?page=service" class='button<?php if($_GET['page'] == 'service'){ echo ' active'; }?>'>Услуги сервиса</a>
				<ul>
					<li><a href="?page=service#service_1"><?= BODY_REPAIR ?></a></li>
					<li><a href="?page=service#service_2"><?= ELECTRICS ?></a></li>
					<li><a href="?page=service#service_3"><?= TRANSMISSION_REPAIR ?></a></li>
					<li><a href="?page=service#service_4"><?= TIRE_SERVICE ?></a></li>
					<li><a href="?page=service#service_5"><?= EVACUATOR ?></a></li>
				</ul>
			</div>

			<div class="separator"></div>

			<div class="main_menu_item">
				<a href="?page=special" class='button<?php if($_GET['page'] == 'special'){ echo ' active'; }?>'>Преимущества</a>
			</div>

			<div class="separator"></div>

			<div class="main_menu_item">
				<a href="?page=contacts" class='button<?php if($_GET['page'] == 'contacts'){ echo ' active'; }?>'>Контакты</a>
			</div>

			<div class="separator"></div>

		</div>
		
	</div>

</div>
