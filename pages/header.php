<?php
session_start();
define('PHONE_NUMBER', '8 (499) 394-32-25');
define("BASE_PATH", "/var/www/user/data/www/vl-tl.ru");
?>
<div class="header">

	<div class="header_top">
		<div class="center_top" >
			<a class="header_left" href="?page=home">	
				<div style="background: url('images/logo.png') no-repeat scroll center center transparent; margin-left: 10px; margin-top:5px; margin-right: 20px" class="logo"></div>
				<!-- <div class="logo_text">ВЛ-ТрансЛогистик</div>
				<div class="slogan">Талант в искусстве перевозок!</div> -->
			</a>
			
			<!-- <a class="header_right_mask" href="?page=tracking">
				<div><span style="font-weight: 900">Новинка!</span><br>Онлайн-мониторинг<br> вашего груза на карте.</div>
			</a>
			<a class="header_right" href="?page=tracking">
				<div><span style="font-weight: 900">Новинка!</span><br>Онлайн-мониторинг<br> вашего груза на карте.</div>
			</a>
 -->
			<div class="phone" style="padding-top:6px">
				<!-- <a class="recall">Заказать обратный звонок</a><br> -->
				8 (499) 394-32-25<br>
				8 (495) 778-75-07<br>
				<span class="mail_header"><script type="text/javascript">eval(unescape('%64%6f%63%75%6d%65%6e%74%2e%77%72%69%74%65%28%27%3c%61%20%68%72%65%66%3d%22%6d%61%69%6c%74%6f%3a%69%6e%66%6f%40%76%6c%2d%74%6c%2e%72%75%22%3e%69%6e%66%6f%40%76%6c%2d%74%6c%2e%72%75%3c%2f%61%3e%27%29%3b'))</script></span>
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
				<a href="?page=service" class='button<?php if($_GET['page'] == 'service'){ echo ' active'; }?>'>Услуги</a>
				<ul>
					<li><a href="?page=service#service_1">Грузоперевозки</a></li>
					<li><a href="?page=service#service_2">Переезды</a></li>
					<li><a href="?page=service#service_3">Малогабаритный груз</a></li>
					<li><a href="?page=service#service_4">Логистика под ключ</a></li>
					<li><a href="?page=service#service_5">Негабаритный груз</a></li>
				</ul>
			</div>

			<div class="separator"></div>

			<!-- <div class="main_menu_item">
				<a href="?page=price" class='button<?php if($_GET['page'] == 'price'){ echo ' active'; }?>'>Цены</a>
				<ul>
					<li><a href="?page=price#price_1">Грузоперевозки</a></li>
					<li><a href="?page=price#price_2">Переезды</a></li>
					<li><a href="?page=price#price_3">Малогабаритный груз</a></li>
					<li><a href="?page=price#price_4">Логистика под ключ</a></li>
					<li><a href="?page=price#price_5">Негабаритный груз</a></li>
				</ul>
			</div>
 -->

			<!-- <div class="main_menu_item">
				<a href="?page=autopark" class='button<?php if($_GET['page'] == 'autopark'){ echo ' active'; }?>'>Автопарк</a>
			</div> -->

			<!-- <div class="separator"></div> -->

			<div class="main_menu_item">
				<a href="?page=special" class='button<?php if($_GET['page'] == 'special'){ echo ' active'; }?>'>Вакансии</a>
			</div>

			<div class="separator"></div>

			<div class="main_menu_item">
				<a href="?page=special" class='button<?php if($_GET['page'] == 'special'){ echo ' active'; }?>'>Эвакуатор</a>
			</div>

			<div class="separator"></div>

			<!-- <div class="main_menu_item">
				<a href="?page=documents" class='button<?php if($_GET['page'] == 'documents'){ echo ' active'; }?>'>Информация</a>
				<ul>
					<li><a href="?page=documents#documents_1">Законодательство РФ</a></li>
					<li><a href="?page=documents#documents_2">Уставные документы</a></li>
					<li><a href="?page=documents#documents_3">Частые вопросы</a></li>
					<li><a href="?page=news">Новости</a></li>

				</ul>
			</div> -->

			<!-- <div class="separator"></div> -->

			<div class="main_menu_item">
				<a href="?page=contacts" class='button<?php if($_GET['page'] == 'contacts'){ echo ' active'; }?>'>Контакты</a>
			</div>

			<div class="separator"></div>

			<!-- <div class="main_menu_item">
				<a href="?page=about" class='button<?php if($_GET['page'] == 'about' || $_GET['page'] == 'partners'){ echo ' active'; }?>'>О компании</a>
				<ul>
					<li><a href="?page=about">О нас</a></li>
					<li><a href="?page=partners">Наши партнеры</a></li>
				</ul>
			</div>

			<div class="separator"></div>	 -->

			<!-- <div class="main_menu_item">	
				<a href="?page=tracking" class='button<?php if($_GET['page'] == 'tracking' || !isset($_GET['tracking'])){ echo ' tracking'; }?>'>Мониторинг</a>
			</div>

			<div class="separator"></div> -->

		</div>
		
	</div>

</div>