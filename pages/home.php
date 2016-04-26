	</div>
	<?php 
		include('modules/main_banner.php');
	?>
	<div class="container">
	<div class="home">


	<div class="content_right">
		<?php include('modules/service.php'); ?>
		<div id="map" class="smallMap"></div>
		<?php include('modules/partners.php'); ?>
	</div>

	<div style="margin-right: 265px;">	
		<div class="content_left">
			<?php include('modules/request.php'); ?>
		</div>

		<a class="banner_center" style="background:url('./images/banner_1.jpg')">
		<div class="text" href="">Ночные перевозки стали ещё доступнее!</div>
		</a>

		<div class="content" style="background: url('./images/auto_hr_1.jpg') no-repeat scroll right bottom #fff;">
			<div class="title">Почему «ВЛ-ТрансЛогистик» - лучший выбор?</div>
			<div class="img_left" img="images/image_3.jpg"></div>
			<p>Автосервис сегодня - это авто-клиника, куда мы несемся, едва наш любимец зачихает или поранится. А если случается авария, то обрываем телефон: "Где найти автосервис поприличней?" В какой отрасли в первую очередь находят применение самые последние научные разработки и изобретения? Конечно, в авто-индустрии, от которой ни на шаг не отстает автосервис! Сегодня не говорят: "Найти неисправность". В ходу выражение: "Диагностика и осмотр".</p>
			<p>Рассыпался ШРУС? Разбитые сайлентблоки? Немудрено на российских-то дорогах! Наш автосервис Авто-Пушкино с радостью поможет Вам. В распоряжении профессионалов подъёмники и компьютерные стенды для диагностики и ремонта подвески машин всех марок. Автосервис Пушкино  не только определяет и устраняет проблему, но и осуществляет все регулировки до заводских параметров.</p>
			<p>Слова: "Автосервис", "Автомобиль" и "Электроника" в 21 веке стали чуть ли не синонимами. Автосервис, который не работает с электрикой - не автосервис! Бортовой компьютер, электропроводка, всевозможные датчики, все эти сложные системы диагностирует, ремонтирует и устанавливает Автосервис Авто-Пушкино.</p>
			<p>Одним из шедевров механики, несомненно, является автоматическая коробка передач (АКПП). Наш автосервис уделяет АККП особое внимание. Весьма капризный агрегат, между прочим, который требует постоянного внимания к себе, выход из строя которого ставит под угрозу само существование автомобиля как средства передвижения, надолго переводя его в разряд недвижимости. Автосервис Авто-Пушкино  - это то место, где квалифицированно и с гарантией обслуживают и заменяют масло в АКПП, что весьма немаловажно для её надёжной работы.</p>
			<p>Автосервис Пушкино  занимается обслуживанием, наладкой и ремонтом топливных систем всех видов, которые, хоть и используют разное топливо, но имеют один общий узел - форсунку, которая, в свою очередь, имеет свойство засоряться по той простой причине, что через неё проходит топливо. Автосервис в Пушкино  располагает стендом для ультразвуковой промывки форсунок, и проверки их на соответствие нормам, ибо только на нём можно безболезненно и без повреждений довести их до высокой степени чистоты. Особенно это касается инжекторных двигателей, обслуживанием и наладкой которых должен заниматься исключительно автосервис.</p>
			<p>Наш автосервис устанавливает любое дополнительное оборудование строго в соответствии с инструкциями изготовителей. Это позволяет автовладельцу наслаждаться им в полном объёме.</p>
			<p>Конечно, автосервис - не клиника, а слесари - не врачи. Есть клятва Гиппократа и никто пока не придумал клятвы Механика. Но принципы, на которых основывается Автосервис Пушкино: "Не поломай!" и "Неисправность проще предупредить, чем устранить", - уже созвучны медицине, а опыт, высококвалифицированные специалисты, совершенное оборудование и любовь к четырёхколёсным существам делают настоящие чудеса. Автосервис Авто-Пушкино  - курорт для железного друга.</p>
		</div>
	</div>
<?php 
	include('modules/specials.php');
?>
	<div class="content" style="min-height: 0">
		<div class="news">
			<div class="title">Первый снег<span class="time">9 октября</div>
			<p class="description">
				По прогнозу синоптиков, в ближайшее время в столице выпадет первый снег, а значит, повысится аварийность на дорогах и число мелких аварий может возрасти в разы. В результате ситуация с пробками в Москве может незначительно усугубиться...
			</p>
		</div>
		<hr>	
		<div class="news">
			<div class="title">Новые знаки с подсветкой<span class="time">22 сентября</div>
			<p class="description">
				Столичные власти сообщили, что до конца 2014 года в Москве на всей протяженности МКАДа и ТТК будут установлены новые дорожные знаки с подсветкой обозначения.
			</p>
		</div>
		<a href="?page=news">Все новости</a>
	</div>

	
	<div style="clear:both;"></div>

</div>



<script>
$(document).ready(function() {
	ymaps.ready(init);
	
});
</script>