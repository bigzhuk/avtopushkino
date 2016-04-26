<!DOCTYPE html>
<html>
<head>
    <title>Примеры. Изменение размеры карты.</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <!-- Если вы используете API локально, то в URL ресурса необходимо указывать протокол в стандартном виде (http://...)-->
    <script src="//api-maps.yandex.ru/2.1/?load=package.full&lang=ru_RU" type="text/javascript"></script>
    <script src="//yandex.st/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function() {
                ymaps.ready(init);

                var myMap,
                    bigMap = false;

                function init () {
                    myMap = new ymaps.Map('map', {
                        center: [55.755768, 37.617671],
                        zoom: 10
                    }, {
                        // При сложных перестроениях можно выставить автоматическое
                        // обновление карты при изменении размеров контейнера.
                        // При простых изменениях размера контейнера рекомендуется обновлять карту программно.
                        // autoFitToViewport: 'always'
                        /*
                         site_user_id //todo получить из сессии
                         */
                    });
                    $.getJSON("components/coordinates.php", {site_user_id: 101}, function(json) {
                        //alert(json);
                        $.each( json, function( key, val ) {
                            var lat  = (val.lat);
                            var lon  = (val.lon);
                            myMap.geoObjects
                                .add(new ymaps.Placemark([lat, lon], {
                                    balloonContent: 'цвет <strong>воды пляжа бонди</strong>'
                                }, {
                                    preset: 'islands#icon',
                                    iconColor: '#0095b6'
                                }));
                        });
                    });

                }
        });



    </script>
</head>

<style type="text/css">
    html, body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0px;
        font-family: Arial;
        font-size: 14px;
    }

    #container {
        margin: 10px;
    }

    #map {
        width: 1000px;
        height: 800px;
        border: 1px solid black;
        margin: 0;
        padding: 0;
        background-color:#ccc;
        overflow:hidden;
    }

    .smallMap {
        width: 500px !important;
        height: 400px !important;
    }

    #toggler {
        left: 5px;
        top: 5px;
        font-size: 12px;
    }

    #checkbox_block {
        left: 163px;
        top: 8px;
        font-size: 13px;
        text-shadow: 1px 1px 0 #FFF;
    }
</style>
<body>
<div id=container>
    <label for="checkbox">Информировать карту</label><br><br>
    <div id="map" class="smallMap"></div>
</div>
</body>
</html>