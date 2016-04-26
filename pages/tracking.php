<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.3.1/jquery.maskedinput.min.js"></script>
<script src="//api-maps.yandex.ru/2.1/?load=package.full&lang=ru_RU" type="text/javascript"></script>
<script src="../js/login_substitute.js" type="text/javascript"></script>
<script src="../js/auth.js" type="text/javascript"></script>

<div class="content" style="background: url('./images/auto_hr_3.jpg') no-repeat scroll right bottom #fff;">
	<div class="title">Отслеживание груза</div>
    <div class="left_text">
	<p>
		Грузоперевозки от компании «ВЛ-ТрансЛогистик» — это полный спектр услуг от курьерской доставки до негабаритных перевозок. Мы не понаслышке знаем, что оказание качественных услуг — залог успешного сотрудничества. Сегодня качество грузоперевозок зависит не только от выгодных условий, но и высококлассного сервиса. Для наших клиентов мы предлагаем бесплатныю услугу онлайн-отслеживания транспорта.
	</p>
    <p><b><i><center>Для получения доступа к сервису, свяжитесь с вашим менеджером по телефону: <?php echo PHONE_NUMBER; ?></center></i></b></p>
    </div>
    <?php
    require_once(BASE_PATH.'/admin/models/customers.class.php');
    require_once(BASE_PATH.'/admin/models/orders.class.php');
    if(isset($_POST['send_data']) && isset($_SESSION['user_id']) && $_SESSION['user_id'] > 0 ){
        $_SESSION['car_id'] = (int)($_POST['car_id']);
    }

    function showOrderForm() {

        echo "<span class='error'></span>";

        if(isset($_SESSION['user_id']) && $_SESSION['user_id'] > 0 ) {

            $customer_id = $_SESSION['customer_id'];
            if(empty($customer_id)){
                return null;
            }
            $customer_model = new CustomersModel();
            $customer_data = $customer_model->getTableDataById($customer_id);

            if(empty($customer_id)){
                return null;
            }
            //echo 'Данные пользователя:';
            echo '<div class="rigth_text">Вы вошли как '.$customer_data[0]['name'].'<br/>';

            $orders_model = new OrderModel();
            $orders_data  = $orders_model->getTableDataByField(
                array(
                    'id',
                    'date_added',
                    'delivery_from',
                    'delivery_to',
                    'status',
                    'car_id'
                ),
                array(
                    array(
                    'title'=>'customer_id',
                    'value'=>$customer_id
                    )
                )
            );
            if(count($orders_data)>1) {
                echo '<form action="" method="post">';
                echo "Выберите номер заказа:";
                echo "<select name = 'car_id'>";
                foreach($orders_data as $order) {
                    echo "<option value='".$order['car_id']."'>".$order['id']."</option>";
                }
                echo "</select><br/>";

            }
            else {
                echo "Активный заказ: ".$orders_data[0]['contract_id'];
            }
            echo '<input type="submit" name = "send_data" class="tracking_input " value="Показать авто"><br/>';
            echo '</from>';

            echo '<input type="button" name = "logout" class="tracking_input " type="button" id = "logout" value="Выход"></div>';
        }
        if(empty($_SESSION) || (isset($_SESSION['error']) && $_SESSION['error'] == true)) {
            echo '<div class="rigth_text">
                    <input type="text" name="username" class="tracking_input"  id="username" value="Логин"><br />
                    <input type="password" name="password" class="tracking_input" id="password" value="Пароль"><br />
                    <input type="button" name = "login" class="tracking_input" type="button" id = "login" value="Вход">
                </div>
                <div id="map_demo" style="height:400px; width:950px; margin-top:15px; border-radius: 3px; border: 1px solid #ccc; background: url(/style/demo_map.jpg) center center; clear:both;"></div>
                
                <div class="tooltip" style="margin-top: 15px;">Каждый заказ сопровождается уникальным идентификатором, поэтому несанкционированное слежение за вашим грузом невозможно.</div>
                
                ';
        }

    }
    showOrderForm(); // юзаем функцию чтобы возвращать null если что-то пошло не так. Вообще всю эту хрень надо переписать на ООП, но лень.
    ?>

    <?php
        if( isset($_SESSION['car_id']) &&  $_SESSION['car_id'] > 0) {
    ?>
    <div id="tracking_map" class="tracking_map" style="height:650px;width:950px;">
    </div>

</div>


<script>

    var timer_1 = 60;

    $(document).ready(function () {
        $('#tracking_id').mask("9999–aa—9999", {placeholder: "X"});

        $('.tracking_refresh_start').on('click', function () {
            $(this).removeClass('tracking_refresh_start');
            timer();
            refresh();
        })

        var myMap, bigMap = false;

        ymaps.ready(init2);

        function init2() {
            //$('#map_demo').remove();
            myMap = new ymaps.Map('tracking_map', {
                center: [55.755768, 37.617671],
                zoom: 10
            });

            console.log(myMap);



            $.getJSON("components/coordinates.php", function (json) {
                console.log(json);
                // $(json).each(function(index, el){
                // 	$(this).lat
                // }
                $.each(json, function (key, val) {


                    var lat = (val.lat);
                    var lon = (val.lon);
                    myMap.geoObjects
                        .add(new ymaps.Placemark([lat, lon], {
                            balloonContent: 'Машина №14>'
                        }, {
                            preset: 'islands#icon',
                            iconColor: '#0095b6'
                        }));
                });
            });

        }


    });

    function timer() {
        setTimeout(function () {
            if (timer_1 == 0) {
                refresh();
            }
            timer_1 = timer_1 - 1;
            $('#tracking_refresh').val('Обновить (' + timer_1 + ')');
            timer(timer_1);
        }, 1000);
    }

    function refresh() {
        timer_1 = 60;
        //Обновляем тут
    }

</script>

<?php
    }
?>


