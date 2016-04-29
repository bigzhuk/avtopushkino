<!-- <span class="todo"> #Отформатировать списки. Добавить перекрестные ссылки на договора. Информация о пропуск в ТТК, охрана груза, <br>страхование (АльфаСтрахование, Ренессанс, ВСК-страхование, Росгосстрах). Сделать значёк внимание ярче.</span> -->

<div class="content" style="background: url('./images/auto_hr_3.jpg') no-repeat scroll right bottom #fff;">

	<p style="margin-bottom: 25px">Автосервис <?= COMPANY_NAME ?> предоставляет услуги  кузовного ремонта, ремонта КПП и любых иных
        виов работ с автомобилем по оптимальным ценам.
        Мы обеспечиваем проведение работ любого уровня сложности, предоставляем гарантию в зависимости от вида работ. Например,
        гарантия на покарску детали составляет 10 лет.
        Работая более 15 лет в области ремонта и технического обслуживания автомобилей, мы гарантируем отличный результа и разумные сроки.
        Мы работаем только с качественными и проверенными материалами, полностью соблюдая технологии и регламент работ в соотвествии
        с заводсткими техническими требованиями.</p>

	<div id="tabs">
		<ul class="tabs">
			<li><a href="#service_1" id="colored_tabs_1"><?= BODY_REPAIR ?></a></li>
			<li><a href="#service_2" id="colored_tabs_2"><?= ELECTRICS ?></a></li>
			<li><a href="#service_3" id="colored_tabs_3"><?= TRANSMISSION_REPAIR ?></a></li>
			<li><a href="#service_4" id="colored_tabs_4"><?= TIRE_SERVICE ?></a></li>
			<li><a href="#service_5" id="colored_tabs_5"><?= EVACUATOR ?></a></li>
		</ul>


		<div id="service_1">
			<hr class="blue" style="margin-bottom: 2px">
			<div class="service_header_image" style="background-image:url('images/main_banner_1.jpg')"></div>
			<hr class="blue">
            <div class="service_title" id="s1">Кузовной ремонт: заводское качество</div>
			<p>
                Мы осуществляем грузоперевозки по всей России (в отдельных случаях по странам СНГ), но концентриуемся на
                Москве и Московской области. Москва и Московская область это самый густонаселенный район РФ,
                тут проживает каждый 7-ой житель России, что составляет без малого 20 миллионов человек.
                Именно на рынке Москвы и области наши позиции наиболее крепки и успешны.
            </p>
            <div class="img_right" img="images/image_3.jpg"></div>

			<p>
                Предположим, Вы столкнулись с необходимостью по перевозке груза,
                или собрались переехать в новый офис. Как считаете, что вызовет у Вас наибольшие трудности
                в данном процессе? Перевозка антикварной утвари или оргтехники с мебелью из Вашего офиса?
                Сохранение раритетного пианино? А может быть транспортировка сейфа,
                который весит 850кг? Скорее всего, ни то, ни другое, ни третье... Самые большие трудности у Вас возникнут
                с поиском специалистов, которые смогут осуществить выше описанное, качественно,
                оперативно и комплексно.
            </p>
            <div class="img_left" img="images/moscow.jpg"></div>

            <p>
                Вот уже более трёх лет мы на деле доказываем выскоий уровень наших услуг и сервиса!
                <a href="?page=autopark">Современный автомобильный</a> парк грузоподъемностью от 0,5 до 20
                тонн позволяет предложить Вам наиболее дешевый способ грузоперевозки на автомобилях, как отечественных,
                так и зарубежных. Наша техника имеет все необходимые документы и пропуска на въезд в центр Москвы,
                будь то заказ газели или перевозка на еврофуре. Если будет необходимо мы предоставим вам наших грузчиков.
                А наш <a href="">сервис онлайн отслеживания грузов</a> не имеет аналогов.
                Эти и другие преимущества мы ежедневно используем в работе на благо клиентов.
                Просто позвоните нам и убедитесь сами.
            </p>

            <p>Кроме прочего своим клиентам мы можем предложить гарантию сохранности груза: нашими основными партнерами в страховании груза являются <i>АльфаСтрахование, Росгосстрах, Ренессанс и ВСК–страхование</i>. В отдельных случаях мы предоставляем сопровождение и охрану груза — вы можете не беспокоиться, доверяя нам самое ценное.</p>
            <p>
                В грузоперевозках мы с успехом решаем задачи любой сложности. А умение справляться с такими
                распространенными ситуациями как, например, переезд, давно доведено в нашей компании до автоматизма.
                Отлаженность в работе позволяет нам выполнять заказы в кратчашие сроки и по привлекательным ценам:
            </p>

			<table class="price_3 red_table">

                <thead>
                    <tr>
                        <td>Модель автомобиля</td>
                        <td>Цена в час, руб.</td>
                        <td>Время работы</td>
                        <td>Минимальная стоимость</td>
                        <td>Выезд за МКАД, руб./км</td>
                        <td>Грузоподьемность, тонн</td>
                        <td>Объем, м3</td>
                        <td>Число европаллет</td>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td><a href="/index.php?padge=autopark#car_1">Hyundai Porter</a></td>
                        <td>470</td>
                        <td>4+1</td>
                        <td>2400</td>

                        <td>15</td>
                        <td>1</td>
                        <td>8</td>
                        <td>3</td>
                    </tr>

                    <tr>
                        <td><a href="/index.php?padge=autopark#car_2">Газель</a></td>
                        <td>540</td>
                        <td>4+1</td>
                        <td>2400</td>
                        <td>17</td>
                        <td>1,5</td>
                        <td>8 – 10</td>
                        <td>4</td>
                    </tr>

                    <tr>
                        <td><a href="/index.php?padge=autopark#car_3">Газель удлиненная</a></td>
                        <td>600</td>
                        <td>4+1</td>
                        <td>2700</td>
                        <td>19</td>
                        <td>1,5</td>
                        <td>12 – 14</td>
                        <td>6</td>
                    </tr>

                    <tr>
                        <td><a href="/index.php?padge=autopark#car_4">Hyundai, Foton, Baw</a></td>
                        <td>650</td>
                        <td>7+1</td>
                        <td>5500</td>
                        <td>22</td>
                        <td>3</td>
                        <td>14 – 18</td>
                        <td>6 — 8</td>
                    </tr>

                    <tr>
                        <td><a href="/index.php?padge=autopark#car_5">Hyundai, Isuzu</a></td>
                        <td>800</td>
                        <td>7+1</td>
                        <td>6500</td>
                        <td>25</td>
                        <td>5</td>
                        <td>24</td>
                        <td>10 – 14</td>
                    </tr>

                    <tr>
                        <td><a href="/index.php?padge=autopark#car_6">Mercedes, Volvo, Man</a></td>
                        <td>1000</td>
                        <td>7+1</td>
                        <td>8000</td>
                        <td>27</td>
                        <td>10</td>
                        <td>36 – 40</td>
                        <td>16 – 22</td>
                    </tr>

                    <tr>
                        <td><a href="/index.php?padge=autopark#car_7">Еврофура</a></td>
                        <td>1400</td>
                        <td>7+1</td>
                        <td>11200</td>
                        <td>35</td>
                        <td>20</td>
                        <td>82</td>
                        <td>32</td>
                    </tr>

                </tbody>

                <tfoot>
                </tfoot>

            </table>
            <div class="tooltip" style="margin-bottom: 20px">Обращаем Ваше внимание, что тарифы могут меняться, поэтому более точную информацию по стоимости Вы всегда можете получить у наших менеджеров по телефону, или оставив заявку на сайте.</div>
            <p> 
            Вы можете ознакомиться с нашим <a href="downloads/dogovor_perevozki.doc">договором на перевозку груза</a> и образцом договора на оказание <a href="downloads/dogovor_teu.doc">транспортно-экспедиторских услуг</a>.
            </p>

           



			
            <p class="service_footer"  id="s1">За профессиональной консультацией и оперативным расчётом цены обратитесь по телефону: 8 (499) 394-32-25.</p>
		</div>

		<div id="service_2">
            <hr class="blue" style="margin-bottom: 2px">
                <div class="service_header_image" style="background-image:url('images/main_banner_2.jpg')"></div>
            <hr class="blue">

            <div class="service_title" id="s2">Переезды любой сложности: от квартиры до склада</div>

            <p>
                Итак, Вы столкнулись с необходимостью переехать. Большинство жителей России ассоциируют переезд со
                стихийным бедствием, но мы поможем Вам справиться с этой ситуацией без нервных затрат
                и имущественных потерь.
            </p>
            <p>
                Совместно с Вами мы разработаем график переезда, учитывая все ваши пожелания.
                Согласуем дату и время Вашего переезда, адреса загрузки и выгрузки.
                Опытный персонал, современные и качественные упаковочные материалы, специализированный мебельный транспорт,
                индивидуальный подход – вот далеко не полный список наших преимуществ.
            </p>
             <center>
                <table class="price_3 yellow_table">

                    <thead>
                        <tr>
                            <td></td>
                            <td>1-комнатная квартира</td>
                            <td>2-комнатная квартира</td>
                            <td>3-комнатная квартира</td>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td class="font-weight: bold">Время переезда:</td>
                            <td>5 ч.</td>
                            <td>7 ч.</td>
                            <td>10 ч.</td>
                        </tr>

                        <tr>
                            <td class="font-weight: bold">Стоимость переезда:</td>
                            <td>7000</td>
                            <td>11000</td>
                            <td>14000</td>
                        </tr>
                    </tbody>
                </table>
            </center>
            <p>
                Если вам нужны грузчики,
                наша компания пердоставит их в необходимом количестве всего за 250 рублей в час.
                Полная стоимость переезда небольшого офиса обойдется вам примерно в 7000 рублей.
                За эти деньги вы получите: услуги по планированию переезда, круглосуточную подачу транспорта,
                проведение погрузочно-разгрузочных работ, услуги по специальной упаковке ценных вещей,
                которая исключит их повреждение при транспортировке,
                а также соблюдение кратчайших сроков.
                В большинстве случаев при перезде по Москве мы укладываемся в 1 день.
                Многие компании пишут о выполнении всех работ в срок.
                Мы же не только обещаем, но и выполняем это обещание. Ведь деловая репутация — важнейший актив нашей компании.</p>
                </p>Доверяя нам переезд, можете быть спокойны — всё Ваше имущество доедет до нового места
                в целости и сохранности, вовремя и без проишествий.
            </p>

            <p>Вот несколько советов переезжающим:</p>
            <ul class="list">
                <li style="margin-bottom: 10px;">Начните готовиться за пару недель до выбранной даты. Перед тем, как заказать квартирный переезд составьте список вещей и нарисуйте план расстановки мебели в новом доме.</li>
                <li style="margin-bottom: 10px;">Измерьте ширину коридоров, дверей и лестниц, удостоверьтесь в возможности использования лифта.</li>
                <li style="margin-bottom: 10px;">Перебирая вещи, постарайтесь избавиться от тех, что Вам в действительности не нужны. Это позволит сэкономить место в автомобиле, а, следовательно, и деньги.</li>
                <li style="margin-bottom: 10px;">Не пренебрегайте упаковкой, потому что именно от неё зависит, переживут ли Ваши вещи увлекательное путешествие по Москве.</li>
                <li style="margin-bottom: 10px;">Деньги, ключи, документы и предметы гигиены лучше сложите отдельно, чтобы они всегда оставались под рукой.</li>
                <li style="margin-bottom: 10px;">Позаботьтесь о детях и домашних животных – на время переезда отправьте их в гости, к друзьям или родственникам, а после непременно устройте новоселье!</li>
            </ul>

            <p class="service_footer"  id="s2">Точный расчёт цены за переезд вы можете узнать по телефону: 8 (499) 394-32-25.</p>
		</div>

		<div id="service_3">
            <hr class="blue" style="margin-bottom: 2px">
            <div class="service_header_image" style="background-image:url('images/main_banner_3.jpg')"></div>
            <hr class="blue">

            <div class="service_title" id="s3">Малогабаритный груз: оперативная доставка от двери до двери</div>

            <p>
                Приоритетным направлением в перевозке малогабаритных грузов для нас является Москва и Московская область.
                В автопарке нашей компании есть фуры и даже спецтехника для <a href="?page=service#tab_5">перевозки «негабарита»</a>.
                Но для перевозки малогабаритных грузов мы используем транспорт грзоподъемностью строго от 1 до 5 тонн.
                Таким образом, используя возможности, которые предоставляет наличие большого автопарка,
                мы избавляем наших клиентов от необходимости переплачивать,
                предоставляя транспорт, наиболее точно подходящий для решения именно Вашей задачи.
            </p>
            <p>
                При этом доставкой малогабаритных грузов у нас занимаются исключительно профессиональные водители.
                Большой опыт работы — это гарантия того, что на пути следования не возникнет трудностей, а,
                значит, товары будут доставлены в пункт назначения точно в срок.
                В работе мы опираемся на наши традиционные преимущества: <a href="?page=price">сбалансированная цена</a>,
                <a href="">сервис онлайн отслеживания грузов</a>,
                высокое качество услуг и безукоризненное соблюдение сроков.
            </p>
            <p class="service_footer"  id="s3">Точный расчёт цен за доставку малогабаритных грузов вы можете узнать по телефону: 8 (499) 394-32-25.</p>
        </div>
            
		<div id="service_4">
            <hr class="blue" style="margin-bottom: 2px">
            <div class="service_header_image" style="background-image:url('images/main_banner_4.jpg')"></div>
            <hr class="blue">

            <div class="service_title" id="s4">Логистика под ключ: готовое решение для вашей компании</div>
            <div class="img_right" img="images/image_5.jpg"></div>

            <p>
                Наряду с традиционным услугами такими как переезд, перевозка малогабаритных или негабаритных грузов
                наша компания предоставляет набирающую популярность услугу: «логистика под ключ».
                Эта услуга заинтересует владельцев компаний, где  логистика не является профильным направлением деятельности, но
                в работе которых постоянно приходится сталкиваться с перевозоками.
                Например, у Вас сеть магазинов, и вам нужно ежедневно развозить свежие продукты по "точкам".
                Или Вы — директор частной школы, которому необходимо организовать ежедневную доставку своих учеников.
                В обоих случаях содержание своего автопарка будет для Вас непрофильным активом - дорогим и обременительным
                предприятием. Куда выгоднее перепоручить решение Ваших транспортных задач профессиональной логистической
                компании.<br/><br/>

                Преимущества решения «Логистика под ключ»:
                <ul class="list">
                    <li>Возможность сосредоточиться на своем бизнесе</li>
                    <li>Упрощение ведения бухгалтерии в частности расчета аммортизации</li>
                    <li>Полная загрузка персонала (Вам не нужно нанимать водителей в штат, если доставка необходима только утром и вечером)</li>
                    <li>Остуствие сложностей с ремонтом автопарка</li>
                    <li>Избавление от непрофильных активов и нецелевых трат</li>
                    <li><a href="index.php?page=tracking">Cервис онлайн отслеживания транспорта</a></li>

                </ul>
                
            </p>
            <p class="service_footer" id="s4">Узнайте подробности предложения и получите специальные условия для Вас у нашего специалиста <br>по телефону: 8 (499) 394-32-25.</p>
		</div>

		<div id="service_5">
            <hr class="blue" style="margin-bottom: 2px">
            <div class="service_header_image" style="background-image:url('images/main_banner_5.jpg')"></div>
            <hr class="blue">
            <div class="service_title" id="s5">Негабаритный груз: профессиональный подход к нестандартным задачам</div>
           
            <div class="img_right" img="images/image_4.jpg"></div>
            <p>
                Негабаритным считается груз, который отвечает любому из следующих параметров:
                <ul class="list">    
                    <li>Ширина груза первышает 2,5 м</li>
                    <li>Высота груза первышает 4 м от поверхности дороги</li>
                    <li>Длина груза первышает 20 м с учётом транспортного средства</li>
                </ul>
            </p>

            <p>Примером такого груза может служить строительная и промышленная техника, негабаритный транспорт, разборные дома, памятники, катера и прочее.
                Компания <i><?= COMPANY_NAME ?></i> располагает собственным разнообразным и современным автопарком,
                позволяющим осуществлять перевозку негабаритного груза  по доступной цене.
                Мы осуществляем перевозки негабаритного груза по всем регионам России, а также странам СНГ.</p>

            <p>Помимо самой перевозки негабаритного груза, мы оказываем и другие услуги связанные с
                перевозкой: помощь в оформлении сопроводительных документов и обеспечение сопровождением.
                Наши услуги отличает высокий профессиональный уровень и точное соответствие всем российским и международным нормам.
                Мы всегда исполняем заказ в срок. А для того, чтобы быть уверенным, что с грузом ничего не случиться,
                на протяжении всего маршрута, Вы можете воспользоваться нашим бесплатным <a href="index.php?page=tracking">сервисом онлайн отслеживания транспорта</a>.
                Доверяя такую сложную и отвественную задачу, как перевозка негабаритного груза нам, Вы доверяете профессионалам своего дела.
            </p>
            <p class="service_footer" id="s5">Расчёт цены от специалиста по крупногабаритным перевозкам по телефону: 8 (499) 394-32-25.</p>
		</div>

	</div>

</div>

<?php 
    include('modules/agents.php');
?>