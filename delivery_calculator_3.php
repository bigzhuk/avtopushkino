<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Добавление маршрута на карту - API Яндекс.Карт 2.х</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <script src="http://yandex.st/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>

    <script src="http://api-maps.yandex.ru/2.1/?load=package.full&lang=ru-RU"
            type="text/javascript"></script>
    <script type="text/javascript">
        var myMap, route;


        // Как только будет загружен API и готов DOM, выполняем инициализацию
        ymaps.ready(init);

        function init () {
            myMap = new ymaps.Map("map", {
                center: [55.755768, 37.617671],
                zoom: 10,
                type: 'yandex#map',
                behaviors: ['scrollZoom', 'drag']
            });


            $('#search_route').submit(function () {
                var start = $("#start").val();
                var end = $("#end").val();
                ymaps.route([
                    // Список точек, которые необходимо посетить
                    [start], [end]], {
                    // Опции маршрутизатора
                    mapStateAutoApply: true // автоматически позиционировать карту
                }).then(function (router) {
                    route && myMap.geoObjects.remove(route);
                    route = router;
                    myMap.geoObjects.add(route);
                    var distance = Math.round(router.getLength() / 1000);
                    $("#distance").text(distance);

                }, function (error) {
                    alert("Возникла ошибка: " + error.message);
                });
                return false;
            });
        }


    </script>
</head>

<body>
<form id="search_route">
    <b>Начало: </b>
    <input id="start" type="text" value="Москва" style="width: 360px;"><br />
    <b>Конец:</b>
    <input id="end" type="text" value="Санкт-Петербург" style="width: 260px;">
    <input type="submit" value="Найти"/>
</form>
<div id="distance"></div>
<br />
<div id="map" style="width:800px;height:600px"></div>
</body>
</html>